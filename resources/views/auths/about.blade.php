@extends('layouts.app')

@section('title', 'Tentang Kami | PresensiHub')

@section('content')
<!-- Memanggil Custom Style Kreasi PBL -->
<link rel="stylesheet" href="{{ asset('style/style_samuel.css') }}">

<nav class="fixed top-0 left-0 right-0 w-full z-50 pbl-glass-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center space-x-3 w-1/4">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                    <i class="bi bi-person-check-fill text-white"></i>
                </div>
                <span class="font-extrabold text-lg tracking-tight uppercase text-slate-800">
                    Presensi<span class="text-indigo-600">Hub</span>
                </span>
            </div>
            
            <div class="hidden md:flex flex-1 justify-center items-center space-x-10">
                <a href="{{ route('welcome') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Beranda</a>
                <a href="{{ route('about') }}" class="text-sm font-bold text-indigo-600 transition border-b-2 border-indigo-600 pb-1">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Hubungi Kami</a>
            </div>

            <div class="hidden md:flex items-center justify-end space-x-6 w-1/4">
                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Login</a> 
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg text-xs font-bold shadow-lg hover:bg-indigo-700 transition">Daftar Sekarang</a>
            </div>

            <div class="md:hidden flex flex-1 justify-end items-center">
                <button id="mobile-menu-button" class="text-slate-600 hover:text-indigo-600 focus:outline-none">
                    <i class="bi bi-list text-3xl"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden bg-white/95 border-b border-slate-100 px-6 py-6 space-y-4 shadow-xl">
        <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pb-1 border-b border-slate-100">Menu</div>
        <a href="{{ route('welcome') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Beranda</a>
        <a href="{{ route('about') }}" class="block text-base font-semibold text-indigo-600 transition">Tentang Kami</a>
        <a href="{{ route('contact') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Hubungi Kami</a>
        <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pt-2 pb-1 border-b border-slate-100">Akun</div>
        <a href="{{ route('login') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Login</a>
        <a href="{{ route('register') }}" class="block bg-indigo-600 text-white text-center px-5 py-3 rounded-xl text-sm font-bold shadow-lg">Daftar Sekarang</a>
    </div>
</nav>

<section class="w-full pt-36 pb-24 px-4 sm:px-6 lg:px-8 flex items-center justify-center relative z-10 min-h-[calc(100vh-80px)]">
    <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-300 rounded-full blur-[100px] opacity-20 -z-10"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-blue-300 rounded-full blur-[100px] opacity-20 -z-10"></div>

    <div class="max-w-5xl w-full grid grid-cols-1 lg:grid-cols-12 gap-0 overflow-hidden bg-white/50 backdrop-blur-md rounded-[2.5rem] border border-slate-200/60 shadow-2xl shadow-indigo-100/40">
        
        <!-- Sisi Kiri: Carousel Menggunakan Background CSS -->
        <div class="lg:col-span-5 relative h-64 sm:h-80 lg:h-full min-h-[350px] bg-slate-900">
            <div id="about-carousel" class="relative w-full h-full" data-carousel="slide" data-carousel-interval="4000">
                <div class="relative h-full overflow-hidden">
                    <div class="hidden duration-1000 ease-in-out h-full" data-carousel-item>
                        <div class="w-full h-full pbl-hero-gedung"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>
                    </div>
                    <div class="hidden duration-1000 ease-in-out h-full" data-carousel-item>
                        <div class="w-full h-full pbl-hero-tech"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>
                    </div>
                </div>

                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-2">
                    <button type="button" class="w-2.5 h-2.5 rounded-full bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/50" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 p-8 sm:p-12 md:p-16 flex flex-col justify-center text-left bg-gradient-to-br from-white/80 to-slate-50/50">
            <div class="inline-block border border-indigo-100 px-3 py-1 rounded-full mb-5 w-max pbl-team-badge">
                <span class="text-[10px] font-black uppercase tracking-widest">Academic PBL Project</span>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 tracking-tight leading-tight">
                Tentang <span class="bg-gradient-to-r from-indigo-600 to-indigo-800 bg-clip-text text-transparent">PresensiHub</span>
            </h2>
            
            <p class="text-slate-600 text-sm md:text-base leading-relaxed mb-5 font-medium">
                Situs web ini dikembangkan secara terintegrasi untuk memenuhi luaran tugas utama mata kuliah <span class="text-slate-800 font-bold">Project-Based Learning (PBL)</span>. Kami bertekad untuk menghadirkan kemudahan dalam mengelola manajemen waktu serta memantau produktivitas karyawan secara efisien.
            </p>
            
            <p class="text-slate-500 text-xs md:text-sm leading-relaxed mb-8 border-l-4 border-indigo-500 pl-4 bg-indigo-50/40 py-2.5 rounded-r-xl">
                Aplikasi ini dirancang dengan penuh dedikasi oleh kelompok mahasiswa program studi <span class="font-semibold text-slate-700">Informatika Malam-B</span> menggunakan keunggulan arsitektur modern dari framework <span class="font-bold text-indigo-600">Laravel</span> dan utilitas <span class="font-bold text-indigo-600">Tailwind CSS</span>.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('welcome') }}" class="bg-slate-900 text-white text-center px-6 py-3.5 rounded-xl font-bold text-xs shadow-lg hover:bg-slate-800 transition duration-200">
                    <i class="bi bi-arrow-left mr-2"></i>Kembali ke Beranda
                </a>
                <a href="{{ route('contact') }}" class="bg-indigo-600 text-white text-center px-6 py-3.5 rounded-xl font-bold text-xs shadow-lg hover:bg-indigo-700 transition duration-200">
                    Hubungi Pengembang<i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    if(btn && menu) {
        btn.addEventListener('click', () => { menu.classList.toggle('hidden'); });
    }
</script>
@endpush