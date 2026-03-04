<div class="card bg-gray-100">
    <div class="card-body p-6 flex flex-col md:flex-row gap-6">
        <!-- Main Content -->
        <div class="flex-grow">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Total Data Penjualan -->
                <div class="card bg-info text-white shadow-md px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">Total Data Penjualan</h2>
                            <p class="text-3xl font-bold mt-2">{{ $totalPenjualan }}</p>
                        </div>
                        <i class="fa-solid fa-file-invoice text-5xl opacity-50"></i>
                    </div>
                </div>

                <!-- Total Produk -->
                <div class="card bg-accent text-white shadow-md px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">Total Produk</h2>
                            <p class="text-3xl font-bold mt-2">{{ $totalProduk }}</p>
                        </div>
                        <i class="fa-solid fa-file-lines text-5xl opacity-50"></i>
                    </div>
                </div>
            </div>

            <!-- Transaksi Terakhir -->
            <div class="card bg-white shadow-md rounded-lg mt-6">
                <div class="card-body">
                    <h2 class="text-lg font-bold text-gray-700 mb-4">Transaksi Terakhir</h2>
                    <table class="table-auto w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-info">
                                <th class="p-4 border text-white">ID Transaksi</th>
                                <th class="p-4 border text-white">Waktu Transaksi</th>
                                <th class="p-4 border text-white">Total Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiTerakhir as $tt)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'hover:bg-gray-200 bg-gray-100' : 'hover:bg-gray-300' }}">
                                <td class="p-4 border text-black">{{ substr($tt->no_faktur, 0, 5) }}</td>
                                <td class="p-4 border text-black">{{ $tt->getCreatedAt($tt->no_faktur) }}</td>
                                <td class="p-4 border text-black">{{ $tt->hitungTotalQt($tt->no_faktur) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="card bg-white shadow-md rounded-lg w-full md:w-1/3 self-start">
            <div class="card-body">
                <h2 class="text-lg font-bold text-gray-700">Algoritma Apriori</h2>
                <p class="text-gray-600">
                    Algoritma Apriori adalah salah satu algoritma pada data mining untuk mencari 
                    <strong>frequent item/itemset</strong> pada transaksional database.
                </p>
                <ul class="list-disc list-outside text-gray-600 mt-4">
                    <p><strong>Komponen Algoritma Apriori:</strong></p>
                    <li>
                        <strong>Support:</strong> 
                        Mengacu pada persentase popularitas rata-rata item apa pun yang ada di kumpulan data.
                    </li>
                    <li class="mt-2">
                        <strong>Confidence:</strong> 
                        Merupakan persentase kemungkinan pelanggan membeli dua item yang berkaitan secara bersamaan.
                    </li>
                    <li class="mt-2">
                        <strong>Lift:</strong> 
                        Mengukur rasio antara <em>support</em> dan <em>confidence</em>.
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</div>