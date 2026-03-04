@include('layout.headerAuth')
<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen" id="divLogin">
        <div class="card shadow-lg bg-white w-full max-w-sm rounded-lg">
            <div class="card-body p-6">
                <div class="text-center mb-4">
                    <h1 class="text-2xl font-bold text-center mb-6 text-slate-800">Masuk</h1>
                </div>
                <form @submit.prevent="loginAtc">
                    <label for="txtUsername" class="block font-medium text-black mb-1">Nama Pengguna</label>
                    <div class="mb-4 input input-bordered bg-white flex items-center gap-2 font-medium border border-gray-300 rounded-md px-3 py-2">
                        <input type="text" id="txtUsername" placeholder="Masukkan Nama Pengguna" class="grow focus:outline-none text-slate-800" required>
                    </div>
                    <label for="txtPassword" class="block font-medium text-black mb-1">Kata Sandi</label>
                    <div class="mb-6 input input-bordered bg-white flex items-center gap-2 font-medium border border-gray-300 rounded-md px-3 py-2">
                        <input type="password" id="txtPassword" placeholder="Masukkan Kata Sandi" class="grow focus:outline-none text-slate-800" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-md font-medium">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    @include('layout.footerAuth')
