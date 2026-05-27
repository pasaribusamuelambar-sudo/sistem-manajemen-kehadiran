<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#fcfdfe] text-slate-900 overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/70 backdrop-blur-lg border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-11 h-11 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <i class="bi bi-person-check-fill text-white text-xl"></i>
                </div>
                <span class="font-extrabold text-xl tracking-tight uppercase text-slate-800">Presensi<span class="text-indigo-600">Hub</span></span>
            </div>
            <div class="hidden md:flex space-x-10 font-semibold text-sm text-slate-600 uppercase tracking-widest">
                <a href="{{ route('welcome') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                <a href="{{ route('about') }}" class="text-indigo-600">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-600 transition-colors">Kontak Kami</a>
            </div>
        </div>
    </nav>

    <section class="pt-40 pb-24 px-6 min-h-screen flex items-center">
        <div class="max-w-3xl mx-auto text-center bg-white border border-slate-100 shadow-xl shadow-slate-100/50 rounded-[2.5rem] p-10 md:p-16">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Tentang <span class="text-indigo-600">Kami</span></h1>
            <p class="text-slate-600 text-base md:text-lg leading-relaxed mb-6">
                Website ini dikembangkan secara terintegrasi untuk memenuhi luaran tugas **Project Based Learning (PBL)**. 
                Kami bertekad mempermudah pengelolaan manajemen waktu dan produktivitas karyawan melalui sistem presensi digital modern.
            </p>
            <p class="text-slate-500 text-sm mb-10">
                Dikembangkan dengan penuh dedikasi oleh mahasiswa Informatika menggunakan framework Laravel dan Tailwind CSS.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('welcome') }}" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-slate-800 transition">Kembali ke Beranda</a>
                <a href="{{ route('contact') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-indigo-700 transition">Hubungi Pengembang</a>
            </div>
        </div>
    </section>

</body>
</html>