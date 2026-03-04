<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\M_Pengujian;
use App\Models\M_Penjualan;
use App\Models\M_Produk;
use App\Models\M_Support;
use App\Models\M_Nilai_Kombinasi;
use Illuminate\Support\Facades\Log;

class C_Apriori extends Controller
{
    public function setupPerhitunganApriori()
    {
        return view('main.apriori.setup');
    }

    public function prosesAnalisaApriori(Request $request)
    {
        $minSupp = $request->support;
        $minConfidence = $request->confidence;

        // Insert data pengujian
        $kdPengujian = Str::uuid();

        M_Pengujian::create([
            'kd_pengujian' => $kdPengujian,
            'nama_penguji' => $request->nama,
            'min_supp' => $minSupp,
            'min_confidence' => $minConfidence
        ]);

        // Hitung total faktur
        $totalFaktur = M_Penjualan::distinct()->count('no_faktur');

        // Cari nilai support berdasarkan jumlah faktur yang mengandung produk A
        $dataProduk = M_Produk::all();
        foreach ($dataProduk as $produk) {
            $kdProduk = $produk->kd_produk;

            // Hitung jumlah faktur yang mengandung produk ini
            $jumlahFakturDenganProduk = M_Penjualan::where('kd_barang', $kdProduk)
                ->distinct()
                ->count('no_faktur');

            // Hitung support
            $nSupport = ($jumlahFakturDenganProduk / $totalFaktur) * 100;

            // Simpan ke tabel support
            M_Support::create([
                'kd_pengujian' => $kdPengujian,
                'kd_produk' => $kdProduk,
                'support' => $nSupport
            ]);
        }

        // **Kombinasi 2 itemset**
        $qProdukA = M_Support::where('kd_pengujian', $kdPengujian)
            ->where('support', '>=', $minSupp)
            ->get();

        if ($qProdukA->isEmpty()) {
            return response()->json(['error' => 'Data transaksi tidak memenuhi nilai minimal support']);
        }

        $produkList = $qProdukA->pluck('kd_produk')->toArray();

        for ($i = 0; $i < count($produkList); $i++) {
            for ($j = $i + 1; $j < count($produkList); $j++) {
                $kdProdukA = $produkList[$i];
                $kdProdukB = $produkList[$j];

                // Cek apakah kombinasi sudah ada
                $cekKombinasi = M_Nilai_Kombinasi::where('kd_pengujian', $kdPengujian)
                    ->where(function ($query) use ($kdProdukA, $kdProdukB) {
                        $query->where('kd_barang_a', $kdProdukA)->where('kd_barang_b', $kdProdukB);
                    })
                    ->exists();

                if (!$cekKombinasi) {
                    M_Nilai_Kombinasi::create([
                        'kd_pengujian' => $kdPengujian,
                        'kd_kombinasi' => Str::uuid(),
                        'kd_barang_a' => $kdProdukA,
                        'kd_barang_b' => $kdProdukB,
                        'jumlah_transaksi' => 0,
                        'support' => 0,
                        'confidence' => 0,
                        'expected_confidence' => 0,
                        'lift_ratio' => 0
                    ]);
                }
            }
        }

        // **Perhitungan Support dan Confidence**
        $nilaiKombinasi = M_Nilai_Kombinasi::where('kd_pengujian', $kdPengujian)->get();

        $hasValidConfidence = false;
        foreach ($nilaiKombinasi as $nk) {
            $kdKombinasi = $nk->kd_kombinasi;
            $kdBarangA = $nk->kd_barang_a;
            $kdBarangB = $nk->kd_barang_b;

            // Hitung jumlah faktur yang mengandung kombinasi A dan B
            $jumlahFakturDenganKombinasi = M_Penjualan::where('kd_barang', $kdBarangA)
                ->whereExists(function ($query) use ($kdBarangB) {
                    $query->selectRaw(1)
                        ->from('tbl_penjualan as p2')
                        ->whereColumn('p2.no_faktur', 'tbl_penjualan.no_faktur')
                        ->where('p2.kd_barang', $kdBarangB);
                })
                ->distinct()
                ->count('no_faktur');

            // Hitung support untuk kombinasi
            $supportAB = ($jumlahFakturDenganKombinasi / $totalFaktur) * 100;

            // Ambil nilai support produk A
            $supportA = M_Support::where('kd_pengujian', $kdPengujian)
                ->where('kd_produk', $kdBarangA)
                ->value('support'); 

            // Hitung jumlah faktur yang mengandung Produk B
            $jumlahFakturProdukB = M_Penjualan::where('kd_barang', $kdBarangB)
                ->distinct()
                ->count('no_faktur');

            // Hitung confidence dengan validasi agar tidak membagi dengan nol
            $confidence = ($supportA > 0) ? ($supportAB / $supportA) * 100 : 0;
            // Jika confidence memenuhi syarat, tandai
            if ($confidence >= $minConfidence) {
                $hasValidConfidence = true;
            }
            $expectedConfidence = ($jumlahFakturProdukB  / $totalFaktur) * 100;
            $liftRatio = ($expectedConfidence > 0) ? ($confidence / $expectedConfidence) : 0;

            // Update nilai kombinasi
            M_Nilai_Kombinasi::where('kd_kombinasi', $kdKombinasi)
                ->update([
                    'jumlah_transaksi' => $jumlahFakturDenganKombinasi,
                    'support' => $supportAB,
                    'confidence' => $confidence,
                    'expected_confidence' => $expectedConfidence,
                    'lift_ratio' => $liftRatio
                ]);
        }

        if (!$hasValidConfidence) {
            return response()->json(['error' => 'Data transaksi tidak memenuhi nilai minimal confidence']);
        }

        return response()->json([
            'status' => 'sukses',
            'kdPengujian' => $kdPengujian,
        ]);
    }

    // Fungsi untuk testing otomatis
    public function testAutomatedApriori()
    {
        // Rentang nilai untuk testing (1 hingga 100)
        $minValues = range(1, 100, 20);
        $results = [];

        // Loop untuk setiap kombinasi nilai min supp dan min con
        foreach ($minValues as $minSupp) {
            foreach ($minValues as $minConfidence) {
                // Kirim request untuk testing analisa dengan nilai min supp dan min con yang berbeda
                $response = $this->prosesAnalisaApriori(new Request([
                    'support' => $minSupp,
                    'confidence' => $minConfidence,
                    'nama' => 'Tester' // Nama penguji bisa diubah
                ]));

                // Simpan hasil dalam array (bisa disimpan di database atau file log)
                $results[] = [
                    'min_supp' => $minSupp,
                    'min_confidence' => $minConfidence,
                    'status' => $response->getData()->status ?? 'error',
                    'message' => $response->getData()->error ?? 'Success'
                ];
            }
        }

        // Output hasil test (bisa disesuaikan: simpan ke database, log file, atau tampilkan)
        Log::info('Hasil Tes Apriori:', $results);
        return response()->json($results);
    }

    public function hasilAnalisa(Request $request, $kdPengujian)
    {
        $dataPengujian = M_Pengujian::where('kd_pengujian', $kdPengujian)->first();

        // Hitung total faktur
        $totalFaktur = M_Penjualan::distinct()->count('no_faktur');

        // Ambil data support
        $dataSupportProduk = M_Support::where('kd_pengujian', $kdPengujian)->get();

        foreach ($dataSupportProduk as $support) {
            $support->jumlah_faktur = M_Penjualan::where('kd_barang', $support->kd_produk)
                ->distinct()
                ->count('no_faktur');
        }

        // Seleksi item yang memenuhi minimum support
        $dataMinSupp = $dataSupportProduk->where('support', '>=', $dataPengujian->min_supp);

        // Ambil semua kombinasi itemset
        $dataKombinasiItemset = M_Nilai_Kombinasi::where('kd_pengujian', $kdPengujian)
            ->with(['produkA', 'produkB'])
            ->get();

        // Seleksi kombinasi yang memenuhi minimum confidence
        $dataMinConfidence = $dataKombinasiItemset->where('confidence', '>=', $dataPengujian->min_confidence);

        return view('main.apriori.hasilAnalisa', [
            'dataSupport' => $dataSupportProduk,
            'totalFaktur' => $totalFaktur,
            'dataPengujian' => $dataPengujian,
            'dataMinSupport' => $dataMinSupp,
            'dataKombinasiItemset' => $dataKombinasiItemset,
            'dataLiftRatio' => $dataKombinasiItemset,
            'dataMinConfidence' => $dataMinConfidence,
            'kdPengujian' => $kdPengujian
        ]);
    }

    public function truncateDatabase()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('tbl_nilai_kombinasi')->truncate();
            DB::table('tbl_support')->truncate();
            DB::table('tbl_pengujian')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return response()->json(['status' => 'sukses', 'message' => 'Data berhasil dibersihkan']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
