<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-6xl h-[80vh] flex flex-col">
        <!-- Header -->
        <div class="mb-4 text-center">
            <h1 class="text-2xl font-bold text-gray-700">Detail Penjualan</h1>
            <p class="text-gray-500">No Faktur: <strong>{{ $kdFaktur }}</strong></p>
        </div>

        <!-- Table -->
        <div class="overflow-y-auto flex-grow">
            <table id="tblDetailPenjualan" class="table-auto w-full border border-gray-200">
                <thead class="bg-info text-white">
                    <tr>
                        <th class="border border-gray-200 p-2 text-center">No</th>
                        <th class="border border-gray-200 p-2 text-left">Kd Produk</th>
                        <th class="border border-gray-200 p-2 text-left">Nama Produk</th>
                        <th class="border border-gray-200 p-2 text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPenjualan as $penjualan)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 text-slate-900">
                        <td class="border border-gray-200 p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-200 p-2">{{ substr($penjualan->kd_barang, 0, 5) }}</td>
                        <td class="border border-gray-200 p-2">{{ $penjualan->dataProduk($penjualan->kd_barang)->nama_produk }}</td>
                        <td class="border border-gray-200 p-2 text-center">{{ $penjualan->qt }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tblDetailPenjualan').DataTable({
            responsive: true,
            paging: false, // Menonaktifkan pagination agar semua data terlihat
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
            },
        });
    });
</script>
