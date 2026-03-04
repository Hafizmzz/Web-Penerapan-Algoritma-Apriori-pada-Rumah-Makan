<div class="m-6 flex items-center justify-center bg-gray-100">
    <div class="card bg-white shadow-md rounded-lg p-6 max-w-7xl w-full">
        <h4 class="text-lg font-bold text-gray-700 mb-4 text-center">Data Penjualan</h4>
        <p class="mb-4 flex gap-4">
            <a class="btn btn-info text-white" href="javascript:void(0)">
                <i class="mdi mdi-plus-box-multiple-outline"></i> Tambah Penjualan Baru
            </a>
            <a class="btn btn-success text-white" href="javascript:void(0)">
                <i class="mdi mdi-file-import-outline"></i> Data Penjualan
            </a>
        </p>

        <div class="table-responsive">
            <table class="table-auto w-full text-black border-collapse border" id="tblDataPenjualan">
                <thead class="bg-info text-white text-left">
                    <tr>
                        <th class="p-4 border">No</th>
                        <th class="p-4 border">Nomor Faktur</th>
                        <th class="p-4 border">Total Produk</th>
                        <th class="p-4 border">Total Kuantitas</th>
                        <th class="p-4 border">Total Harga</th>
                        <th class="p-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPenjualan as $penjualan)
                    <tr>
                        <td class="p-4 border">{{ $loop->iteration }}</td>
                        <td class="p-4 border">F-{{ $penjualan->no_faktur }}</td>
                        <td class="p-4 border">{{ $penjualan->hitungTransaksi($penjualan->no_faktur) }}</td>
                        <td class="p-4 border">{{ $penjualan->hitungTotalQt($penjualan->no_faktur) }}</td>
                        <td class="p-4 border">Rp. {{ number_format($penjualan->getTotalHarga($penjualan->no_faktur)) }}</td>
                        <td class="p-4 border">
                            <a class="btn btn-warning btn-sm waves-effect waves-light text-white" href="javascript:void(0)" @click="detailAtc('{{ $penjualan->no_faktur }}')">
                                <i class="mdi mdi-folder-edit-outline"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>