@extends('auths.karyawan_dashboard')

@section('karyawan_content')
<!-- Memuat Font Awesome untuk Ikon jika belum ada di template utama -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="flex justify-center items-center py-6 font-sans text-gray-800">
    <div class="w-full max-w-xl space-y-5 px-4">

        <!-- 1. Card Header Profil -->
        <div class="bg-white p-5 rounded-2xl shadow-xs border border-gray-100 flex items-center gap-4 relative">
            <div class="relative">
                <!-- Placeholder Foto Utama -->
                <div class="w-20 h-20 rounded-full bg-amber-100 border border-gray-200 flex items-center justify-center overflow-hidden">
                    <span class="text-amber-700 font-bold text-xs text-center p-1">Waspresso</span>
                </div>
                <!-- Ikon Kamera Kecil -->
                <button type="button" class="absolute bottom-0 right-0 bg-blue-600 text-white p-1.5 rounded-full text-xs flex items-center justify-center border-2 border-white cursor-pointer hover:bg-blue-700 transition">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            
            <div>
                <h2 class="text-xl font-bold text-gray-900">Samuel Ambar Pasaribu</h2>
                <p class="text-gray-500 text-sm capitalize">manager</p>
                <div class="flex gap-2 mt-2">
                    <span class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-2.5 py-1 rounded-md border border-emerald-100">Karyawan</span>
                    <span class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-2.5 py-1 rounded-md border border-emerald-100">Aktif</span>
                </div>
            </div>
        </div>

        <!-- 2. Card Informasi Pekerjaan -->
        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 space-y-4">
            <h3 class="font-bold text-gray-900 text-base mb-1">Informasi Pekerjaan</h3>
            
            <!-- Email -->
            <div class="bg-gray-50 p-3 rounded-xl flex items-start gap-3 border border-gray-50">
                <div class="text-gray-400 mt-0.5 w-5 text-center">
                    <i class="far fa-envelope"></i>
                </div>
                <div>
                    <label class="block text-xs text-gray-400 font-medium">Email</label>
                    <span class="text-sm font-semibold text-gray-800 break-all">pasaribusamuelambar@gmail.com</span>
                </div>
            </div>

            <!-- Jabatan -->
            <div class="bg-gray-50 p-3 rounded-xl flex items-start gap-3 border border-gray-50">
                <div class="text-gray-400 mt-0.5 w-5 text-center">
                    <i class="far fa-building"></i>
                </div>
                <div>
                    <label class="block text-xs text-gray-400 font-medium">Jabatan</label>
                    <span class="text-sm font-semibold text-gray-800 capitalize">manager</span>
                </div>
            </div>

            <!-- Divisi -->
            <div class="bg-gray-50 p-3 rounded-xl flex items-start gap-3 border border-gray-50">
                <div class="text-gray-400 mt-0.5 w-5 text-center">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div>
                    <label class="block text-xs text-gray-400 font-medium">Divisi</label>
                    <span class="text-sm font-semibold text-gray-800">IT & Teknologi</span>
                </div>
            </div>

            <!-- No HP -->
            <div class="bg-gray-50 p-3 rounded-xl flex items-start gap-3 border border-gray-50">
                <div class="text-gray-400 mt-0.5 w-5 text-center">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <label class="block text-xs text-gray-400 font-medium">No. HP / WhatsApp</label>
                    <span class="text-sm font-semibold text-gray-800">082170378193</span>
                </div>
            </div>
        </div>

        <!-- 3. Card Edit Kontak -->
        <form action="#" method="POST" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 space-y-4">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-gray-900 text-base mb-1">Edit Kontak</h3>
            
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-gray-700 flex items-center gap-1.5">
                    <i class="fas fa-phone-alt text-gray-400 text-[11px]"></i> No. HP / WhatsApp
                </label>
                <input type="text" name="no_hp" value="082170378193" class="w-full text-sm px-3 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-800">
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-gray-700 flex items-center gap-1.5">
                    <i class="fas fa-map-marker-alt text-gray-400 text-[11px]"></i> Alamat
                </label>
                <input type="text" name="alamat" value="perumahan parisa indah blok a3 no 17" class="w-full text-sm px-3 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-800 capitalize">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-xl flex items-center justify-center gap-2 cursor-pointer transition shadow-xs">
                <i class="far fa-save"></i> Simpan Perubahan
            </button>
        </form>

        <!-- 4. Card Ganti Password -->
        <form action="#" method="POST" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 space-y-4">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-gray-900 text-base mb-1 flex items-center gap-2">
                <i class="fas fa-key text-gray-400 text-sm"></i> Ganti Password
            </h3>
            
            <div class="bg-blue-50 text-blue-600 text-xs p-3 rounded-xl border border-blue-100 leading-relaxed">
                Password baru Anda akan tersimpan otomatis di sistem dan dapat dipantau oleh admin.
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-gray-700">
                    Password Baru <span class="text-gray-400 font-normal">(min. 8 karakter)</span>
                </label>
                <div class="relative">
                    <input type="password" name="password" placeholder="Masukkan password baru..." class="w-full text-sm pl-3 pr-10 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-800">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="far fa-eye text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-gray-700">
                    Konfirmasi Password Baru
                </label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru..." class="w-full text-sm px-3 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-800">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-xl flex items-center justify-center gap-2 cursor-pointer transition shadow-xs">
                <i class="fas fa-key text-xs"></i> Perbarui Password
            </button>
        </form>

    </div>
</div>
@endsection