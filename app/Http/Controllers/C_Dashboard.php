<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\M_Produk;
use App\Models\M_Penjualan;

class C_Dashboard extends Controller
{
    public function dashboard()
    {
        return view('main.dashboard');
    }
    public function berandaPage()
    {
        $totalProduk = M_Produk::count();
        $totalPenjualan = M_Penjualan::count();
        $transaksiTerakhir = M_Penjualan::distinct() -> take (5) -> get(['no_faktur']);
        $dr = [
            'totalProduk' => $totalProduk,
            'totalPenjualan' => $totalPenjualan,
            'transaksiTerakhir' => $transaksiTerakhir
        ];
        return view('main.berandaPage', $dr);
    }

    public function infoAplikasi()
    {
        return view('main.infoAplikasi');
    }

    function setAwal()
    {
        $dataAwal = array();
        $dr = ['respon' => $dataAwal];
        return Response::json($dr);
    }
}
