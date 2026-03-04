<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Beranda - Aplikasi Analisa Penjualan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta content="Themesdesign" name="author" />
    <!-- font Awesome Icon -->
    <link rel="shortcut icon" href="{{ asset('ladun/apaxy/') }}/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- slick css -->
    <link href="{{ asset('ladun/apaxy/') }}/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('ladun/apaxy/') }}/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('ladun/apaxy/') }}/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

    <!-- Bootstrap Css
    <link href="{{ asset('ladun/apaxy/') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- DataTables -->
    <!-- <link href="{{ asset('ladun/apaxy/') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('ladun/apaxy/') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('ladun/apaxy/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('ladun/apaxy/css/datatables.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('ladun/base/css/main.css') }}">

    <!-- Responsive datatable examples -->
    <!-- <link href="{{ asset('ladun/apaxy/') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- Icons Css -->
    <link href="{{ asset('ladun/apaxy/') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <!-- <link href="{{ asset('ladun/apaxy/') }}/css/app.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{ asset('ladun/apaxy/') }}/css/app.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="content" class="bg-gray-100 font-nunitosans flex flex-col ml-0 transition-all duration-300">

    <header class="bg-white shadow p-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-800">
            Selamat datang, Admin!
        </h1>
        <div class="flex items-center space-x-4">
            <i class="fa-solid fa-user text-slate-800"></i>
            <span class="text-slate-800 font-medium text-lg">Admin</span>
        </div>
    </header>

    <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-[#213555] text-white shadow-lg z-40 flex flex-col justify-between transform -translate-x-full transition-transform duration-300">
    <div class="p-4">
        <h2 class="text-xl font-bold p-4 text-white">RM Nasi Uduk Hj Atiyah</h2> <!-- Ukuran font diperbesar -->
        <ul class="mt-10">
            <li class="mb-4 hover:bg-[#3E5879] rounded-md p-2">
                <a href="javascript:void(0)" onclick="renderPage('dashboard/beranda', 'Dashboard')" class="flex items-center gap-2 p-2 text-lg">Beranda</a> <!-- Ukuran font diperbesar -->
            </li>
            <li class="mb-4 hover:bg-[#3E5879] rounded-md p-2 flex flex-col">
                <a href="javascript:void(0)" onclick="renderPage('app/penjualan/data', 'Penjualan')" class="p-2 text-lg">Data Penjualan</a> <!-- Ukuran font diperbesar -->
            </li>
            <li class="mb-4 hover:bg-[#3E5879] rounded-md p-2">
                <a href="javascript:void(0)" onclick="renderPage('app/apriori/setup', 'Proses Apriori')" class="flex items-center gap-2 p-2 text-lg">Proses Apriori</a> <!-- Ukuran font diperbesar -->
            </li>
        </ul>
    </div>
    <div class="p-4">
        <!-- Button Logout -->
        <button type="submit" class="btn btn-error w-full p-2 rounded-md text-white text-lg"> <!-- Ukuran font diperbesar -->
            <a class="dropdown-item" href="{{ url('/auth/logout') }}">
                <i class="mdi mdi-logout font-size-16 align-middle mr-2"></i> Keluar
            </a>
        </button>
    </div>
</div>

<div id="hover-zone" class="fixed top-0 left-0 h-full w-4 bg-transparent z-50"></div>

@section('css')
<style>
    table#tblDataPenjualan {
        table-layout: fixed;
        word-wrap: break-word;
    }
</style>
@endsection
