<style !important>
    table#tblDataPenjualan {
        table-layout: fixed !important;
        width: 100% !important;
    }

    table#tblDataPenjualan th, table#tblDataPenjualan td {
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    table#tblDataPenjualan thead th {
        text-align: left !important;
    }

    table#tblDataPenjualan tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Warna terang untuk baris ganjil */
    }

    table#tblDataPenjualan tbody tr:nth-child(even) {
        background-color: #e6e6e6; /* Warna gelap untuk baris genap */
    }

    table#tblDataPenjualan tbody tr:hover {
        background-color: #d3d3d3; /* Warna saat baris dihover */
    }
</style>

<div class="row" id="divDataPenjualan">
@include('main.penjualan.dataPenjualan')
@include('main.penjualan.modal')
</div>

<script type="module">
    import Penjualan from '/ladun/base/js/penjualan.js'; // Gunakan path absolut
    
    Penjualan.mounted(); // Panggil fungsi mounted
</script>
