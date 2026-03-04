<div class="col-lg-12">
    <div class="card bg-gray-100 shadow-md rounded-lg p-6">
        <div class="card-body">
            <div class="card bg-white shadow-md rounded-lg p-6 mb-6">
                <h4 class="header-title text-lg font-bold text-black mb-6 text-center">
                    Hasil Analisa Apriori
                </h4>
                <h5 class="text-base font-semibold text-black mb-2">
                    1. Data Support Produk
                </h5>
                <div class="table-responsive">
                    <table class="table mb-0 border text-black" id="tblDataSupport">
                        <thead class="bg-info text-white text-left">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Kd Produk</th>
                                <th class="border">Nama Produk</th>
                                <th class="border">Total Transakasi</th>
                                <th class="border">Perhitungan Support</th>
                                <th class="border">Support (%)</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @foreach($dataSupport as $supp)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-200' }}">
                                <td class="border">{{ $loop->iteration }}</td>
                                <td class="border">{{ substr($supp->kd_produk, 0, 5) }}</td>
                                <td class="border">{{ $supp->dataProduk($supp->kd_produk)->nama_produk }}</td>
                                <td class="border">{{ $supp->jumlah_faktur }}</td>
                                <td class="border">( {{ $supp->jumlah_faktur }} / {{ $totalFaktur }} ) * 100</td>
                                <td class="border">{{ number_format($supp->support, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h5 class="text-base font-semibold text-black mt-8 mb-2">
                    2. Item yang memenuhi syarat minimum support {{ $dataPengujian->min_supp }}%
                </h5>
                <div class="table-responsive">
                    <table class="table mb-0 border text-black" id="tblDataSupportMin">
                        <thead class="bg-info text-white text-left">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Kd Produk</th>
                                <th class="border">Nama Produk</th>
                                <th class="border">Support (%)</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @foreach($dataMinSupport as $minSupp)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-200' }}">
                                <td class="border">{{ $loop->iteration }}</td>
                                <td class="border">{{ substr($minSupp->kd_produk, 0, 5) }}</td>
                                <td class="border">{{ $minSupp->dataProduk($minSupp->kd_produk)->nama_produk }}</td>
                                <td class="border">{{ number_format($minSupp->support, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h5 class="text-base font-semibold text-black mt-8 mb-2">3. Kombinasi 2 Itemset</h5>
                <div class="table-responsive">
                    <table class="table mb-0 border text-black" id="tblKombinasiItemset">
                        <thead class="bg-info text-white text-left">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Kd Kombinasi</th>
                                <th class="border">Produk A</th>
                                <th class="border">Produk B</th>
                                <th class="border">Jumlah Transaksi Kombinasi</th>
                                <th class="border">Support (%)</th>
                                <th class="border">Confidence (%)</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @foreach($dataKombinasiItemset as $dki)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-200' }}">
                                <td class="border">{{ $loop->iteration }}</td>
                                <td class="border">{{ substr($dki->kd_kombinasi, 0, 5) }}</td>
                                <td class="border">{{ $dki->produkA->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                <td class="border">{{ $dki->produkB->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                <td class="border">{{ $dki->jumlah_transaksi }}</td>
                                <td class="border">{{ number_format($dki->support, 2) }}</td>
                                <td class="border">{{ number_format($dki->confidence, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <h5 class="text-base font-semibold text-black mt-8 mb-2">
                    4. Kombinasi yang memenuhi minimum confidence > {{ $dataPengujian->min_confidence }}%
                </h5>
                <div class="table-responsive">
                    <table class="table mb-0 border text-black" id="tblMinConfidence">
                        <thead class="bg-info text-white text-left">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Kd Kombinasi</th>
                                <th class="border">Produk A</th>
                                <th class="border">Produk B</th>
                                <th class="border">Jumlah Transaksi Kombinasi</th>
                                <th class="border">Support (%)</th>
                                <th class="border">Confidence (%)</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @foreach($dataMinConfidence as $dmc)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-200' }}">
                                <td class="border">{{ $loop->iteration }}</td>
                                <td class="border">{{ substr($dmc->kd_kombinasi, 0, 5) }}</td>
                                <td class="border">{{ $dmc->produkA->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                <td class="border">{{ $dmc->produkB->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                <td class="border">{{ $dmc->jumlah_transaksi }}</td>
                                <td class="border">{{ number_format($dmc->support, 2) }}</td>
                                <td class="border">{{ number_format($dmc->confidence, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Hasil Lift Ratio -->
                <h5 class="text-base font-semibold text-black mt-8 mb-2">5. Hasil Lift Ratio</h5>
                <div class="table-responsive">
                    <table class="table mb-0 border text-black" id="tblLiftRatio">
                        <thead class="bg-info text-white text-left">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Pola</th>
                                <th class="border">Lift Ratio</th>
                                <th class="border">Korelasi</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @foreach($dataLiftRatio as $dlr)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-200' }}">
                                <td class="border">{{ $loop->iteration }}</td>
                                <td class="border">
                                    Apabila pelanggan membeli <b>{{ $dlr->produkA->nama_produk }}</b>, 
                                    maka pelanggan juga akan membeli <b>{{ $dlr->produkB->nama_produk }}</b>
                                </td>
                                <td class="border">{{ number_format($dlr->lift_ratio, 2) }}</td>
                                <td class="border {{ $dlr->lift_ratio < 1 ? 'text-error' : ($dlr->lift_ratio == 1 ? 'text-neutral' : 'text-success') }}">
                                    {{ $dlr->lift_ratio < 1 ? 'Negatif' : ($dlr->lift_ratio == 1 ? 'Independen' : 'Positif') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTables untuk setiap tabel
        $('#tblDataSupport, #tblDataSupportMin, #tblKombinasiItemset, #tblMinConfidence, #tblPolaHasil, #tblLiftRatio').DataTable({
            responsive: true,
            paging: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "Cari:", // Tombol pencarian
                lengthMenu: "Tampilkan _MENU_ entri per halaman", // Pilihan jumlah entri
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri", // Informasi halaman
                infoEmpty: "Tidak ada data yang tersedia", // Jika tabel kosong
                infoFiltered: "(difilter dari _MAX_ total entri)", // Informasi filter
                zeroRecords: "Tidak ditemukan data yang cocok", // Jika tidak ada pencocokan
                paginate: {
                    first: "Awal", // Tombol halaman pertama
                    last: "Akhir", // Tombol halaman terakhir
                    next: "Berikutnya", // Tombol halaman berikutnya
                    previous: "Sebelumnya" // Tombol halaman sebelumnya
                },
                emptyTable: "Tidak ada data pada tabel" // Jika tabel kosong
            },
            scrollX: true // Aktifkan scroll horizontal
        });
    });
</script>