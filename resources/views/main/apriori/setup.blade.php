<div class="mb-9 bg-gray-100">
    <div class="card bg-white shadow-md rounded-lg p-6 w-full max-w-lg mx-auto mt-10">
        <div class="text-center text-lg font-bold text-gray-700 mb-4">Proses Apriori</div>
        <div class="card-body" id="divFormSupp">
            <div class="form-group mb-4">
                <label for="txtNama" class="block font-medium text-gray-700 mb-2">Nama Penguji</label>
                <input
                    type="text"
                    id="txtNama"
                    class="form-control border border-gray-300 rounded-md w-full p-2 bg-white text-black"
                    placeholder="Masukkan nama penguji"
                    value="Bu Putri Hayati">
            </div>
            <div class="form-group mb-4">
                <label for="txtSupport" class="block font-medium text-gray-700 mb-1">Min. Support</label>
                <small class="text-sm text-gray-500">Semakin rendah nilai support akan semakin banyak proses yang mengakibatkan proses apriori menjadi lama</small>
                <select id="txtSupport" class="form-control border border-gray-300 rounded-md w-full p-2 mt-2 bg-white text-black"">
                    <?php
                    $x = 1;
                    for ($x; $x <= 100; $x++) { ?>
                        <option value=" <?= $x; ?>"><?= $x; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="txtConfidence" class="block font-medium text-gray-700 mb-1">Min. Confidence</label>
                <select id="txtConfidence" class="form-control border border-gray-300 rounded-md w-full p-2 bg-white text-black"">
                    <?php
                    $x = 1;
                    for ($x; $x <= 100; $x++) { ?>
                        <option value=" <?= $x; ?>"><?= $x; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group mb-4 mx-auto">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md cursor-pointer" onclick="mulaiTruncateDanAnalisa()">Mulai Analisa Penjualan</a>
            </div>
        </div>
        <div id="divLoadingPengujian" class="text-center mb-48 hidden">
            <img src="{{ asset('ladun/base/loading.svg') }}" class="mx-auto">
            <p class="text-sm text-gray-600 mt-auto">Memproses apriori, akan memakan waktu sesuai dengan banyaknya data yang diproses</p>
        </div>
    </div>
</div>

<script>
    var rProsesApriori = server + "app/apriori/analisa/proses";

    document.querySelector("#txtNama").focus();

    function mulaiTruncateDanAnalisa() {
        // Memulai truncate database terlebih dahulu
        axios.post('/truncate-database')
            .then(function(response) {
                // Langsung menampilkan konfirmasi untuk melanjutkan analisis
                confirmQuest('info', 'Konfirmasi', 'Mulai analisa penjualan ?', prosesAnalisa);
            })
            .catch(function(error) {
                console.error("Error Response:", error.response?.data || error);
                pesanUmumApp('error', 'Gagal', 'Terjadi kesalahan dalam membersihkan database.');
            });
    }


    function prosesAnalisa() {
        let nama = document.querySelector("#txtNama").value;
        let support = document.querySelector("#txtSupport").value;
        let confidence = document.querySelector("#txtConfidence").value;
        let ds = {
            'support': support,
            'confidence': confidence,
            'nama': nama
        };

        $("#divFormSupp").hide();
        $("#divLoadingPengujian").show();
        axios.post(rProsesApriori, ds)
        .then(function(res) {
            // Cek apakah ada error pada respons
            if (res.data.error) {
                pesanUmumApp('error', 'Gagal', res.data.error);  // Menampilkan pesan error
                $("#divFormSupp").show();
                $("#divLoadingPengujian").hide();
            } else {
                let kdPengujian = res.data.kdPengujian;
                console.log("Kode Pengujian:", kdPengujian);
                pesanUmumApp('success', 'Sukses', 'Proses analisa apriori selesai');
                renderPage('app/apriori/analisa/hasil/' + kdPengujian, 'Hasil Analisa');
            }
        })
        .catch(function(error) {
            console.error("Error Response:", error.response?.data || error);
            pesanUmumApp('error', 'Gagal', 'Terjadi kesalahan dalam proses analisa');
            $("#divFormSupp").show();
            $("#divLoadingPengujian").hide();
        });
    }
</script>