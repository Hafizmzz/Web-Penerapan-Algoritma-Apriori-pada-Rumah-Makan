<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\M_Produk;

class M_Nilai_Kombinasi extends Model
{
    protected $table = "tbl_nilai_kombinasi";

    protected $fillable = [
        'kd_pengujian',
        'kd_kombinasi',
        'kd_barang_a',
        'kd_barang_b',
        'jumlah_transaksi',
        'support',
        'confidence',
        'expected_confidence',
        'lift_ratio'
    ];

    public function dataProduk($kdProduk)
    {
        return M_Produk::where('kd_produk', $kdProduk) -> first();
    }


    public function produkA()
    {
        return $this->belongsTo(M_Produk::class, 'kd_barang_a', 'kd_produk');
    }
    
    public function produkB()
    {
        return $this->belongsTo(M_Produk::class, 'kd_barang_b', 'kd_produk');
    }
    
}
