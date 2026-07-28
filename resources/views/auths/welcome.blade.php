@extends('layouts.app')

@section('title', 'Selamat Datang | PresensiHub')

@section('content')
<!-- Memanggil Style PBL Samuel -->
<link rel="stylesheet" href="{{ asset('style/style_samuel.css') }}">

<!-- NAVIGASI UTAMA -->
<nav class="fixed top-0 left-0 right-0 w-full z-50 pbl-glass-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-3 w-1/4">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                    <i class="bi bi-person-check-fill text-white"></i>
                </div>
                <span class="font-extrabold text-lg tracking-tight uppercase text-slate-800">
                    Presensi<span class="text-indigo-600">Hub</span>
                </span>
            </div>
            
            <!-- Menu Tengah -->
            <div class="hidden md:flex flex-1 justify-center items-center space-x-10">
                <a href="{{ route('welcome') }}" class="text-sm font-bold text-indigo-600 transition">Beranda</a>
                <a href="{{ route('about') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Hubungi Kami</a>
            </div>

            <!-- Menu Kanan -->
            <div class="hidden md:flex items-center justify-end space-x-6 w-1/4">
                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Login</a> 
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg text-xs font-bold shadow-lg hover:bg-indigo-700 transition">Daftar Sekarang</a>
            </div>

            <!-- Tombol Mobile -->
            <div class="md:hidden flex flex-1 justify-end items-center">
                <button id="mobile-menu-button" class="text-slate-600 hover:text-indigo-600 focus:outline-none">
                    <i class="bi bi-list text-3xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="hidden bg-white/95 border-b border-slate-100 px-6 py-6 space-y-4 shadow-xl">
        <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pb-1 border-b border-slate-100">Menu</div>
        <a href="{{ route('welcome') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Beranda</a>
        <a href="{{ route('about') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Tentang Kami</a>
        <a href="{{ route('contact') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Hubungi Kami</a>
        <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pt-2 pb-1 border-b border-slate-100">Akun</div>
        <a href="{{ route('login') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Login</a>
        <a href="{{ route('register') }}" class="block bg-indigo-600 text-white text-center px-5 py-3 rounded-xl text-sm font-bold shadow-lg">Daftar Sekarang</a>
    </div>
</nav>

<!-- KONTEN UTAMA -->
<main class="relative pt-32 md:pt-40 pb-20 px-4 sm:px-6 z-10">
    <!-- Ornamen Background -->
    <div class="absolute top-20 right-0 w-48 md:w-80 h-48 md:h-80 bg-indigo-200 rounded-full blur-[80px] md:blur-[120px] opacity-40 -z-10"></div>
    <div class="absolute bottom-10 left-10 w-40 md:w-64 h-40 md:h-64 bg-blue-200 rounded-full blur-[70px] md:blur-[100px] opacity-30 -z-10"></div>

    <div class="max-w-6xl mx-auto text-center">
        <!-- Badge -->
        <div class="inline-block bg-white/80 border border-indigo-100 px-4 py-1.5 rounded-full mb-6 shadow-sm">
            <span class="text-indigo-600 text-[10px] md:text-xs font-bold uppercase tracking-widest italic">Digital Presence Solution</span>
        </div>

        <!-- Judul Utama -->
        <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6 tracking-tight">
            Sistem Terintegrasi<br class="hidden md:block">
            <span class="text-indigo-600">Kehadiran Karyawan</span>
        </h1>

        <!-- Deskripsi -->
        <p class="text-slate-500 text-sm md:text-lg mb-10 max-w-2xl mx-auto leading-relaxed px-4">
            Platform manajemen kehadiran terpadu untuk memantau produktivitas, mengelola perizinan, dan laporan secara akurat.
        </p>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16 md:mb-20 px-4">
            <a href="{{ route('login') }}" class="w-full sm:w-auto bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-2xl hover:bg-indigo-700 transition transform hover:-translate-y-1 text-center">
                Mulai Absensi
            </a>
            <a href="#features" class="w-full sm:w-auto bg-white/80 border border-slate-200 px-8 py-4 rounded-2xl font-bold text-slate-700 hover:bg-slate-50 transition text-center shadow-sm">
                Pelajari Fitur
            </a>
        </div>  

        <!-- SEKSI PREMIUM: BOX HITAM (KIRI) & FLOWBITE CAROUSEL DENGAN CLASS CSS (KANAN) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 overflow-hidden rounded-[2.5rem] pbl-premium-card mb-28 text-left">
            
            <!-- Sisi Kiri: Hitam Premium -->
            <div class="lg:col-span-5 p-8 md:p-12 flex flex-col justify-between text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.15),transparent_50%)]"></div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full text-indigo-300 text-xs font-medium mb-6">
                        <span class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></span>
                        <span>Polibatam Ecosystem</span>
                    </div>
                    <h3 class="text-2xl font-black tracking-tight leading-snug mb-4">
                        Mendukung Efisiensi & <br><span class="text-indigo-400">Teknologi Modern</span>
                    </h3>
                    <p class="text-slate-400 text-xs leading-relaxed mb-8">
                        Integrasi sistem cerdas untuk memantau aktivitas absensi civitas secara *real-time* berbasis komputasi awan lokal PT Arthur Teknik Indoprima.
                    </p>
                </div>

                <!-- Deretan Statistik -->
                <div class="grid grid-cols-3 gap-4 border-t border-white/10 pt-6 relative z-10">
                    <div>
                        <div class="text-2xl font-black text-indigo-400 italic">99%</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Akurasi</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-blue-400 italic">24/7</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Akses</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-emerald-400 italic">Secure</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Cloud</div>
                    </div>
                </div>
            </div>

            <!-- Sisi Kanan: Slider Gambar Bergeser Otomatis via CSS Class -->
            <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-full min-h-[380px]">
                <div id="image-carousel" class="relative w-full h-full" data-carousel="slide" data-carousel-interval="4000">
                    <div class="relative h-full overflow-hidden">
                        <!-- Gambar 1 memanggil Class CSS -->
                        <div class="hidden duration-1000 ease-in-out h-full" data-carousel-item>
                            <div class="w-full h-full pbl-hero-gedung"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                        </div>
                        <!-- Gambar 2 memanggil Class CSS -->
                        <div class="hidden duration-1000 ease-in-out h-full" data-carousel-item>
                            <div class="w-full h-full pbl-hero-tech"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                        </div>
                    </div>

                    <!-- Indikator Bullets -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    </div>

                    <!-- Navigasi Manual -->
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bagian Fitur Layanan Bawah dengan Efek Glow Custom CSS -->
        <div id="features" class="pt-4 scroll-mt-24">
            <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-12 text-center">Semua yang Anda Butuhkan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <div class="bg-blue-50/40 p-6 md:p-8 rounded-3xl border border-blue-100 shadow-sm pbl-hover-glow">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-blue-200"><i class="bi bi-clock"></i></div>
                    <h3 class="text-base font-black text-blue-900 mb-2">Check-in & Check-out</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Karyawan absen hanya dengan satu klik. Sistem otomatis mencatat waktu dan mendeteksi keterlambatan.</p>
                </div>
                <div class="bg-indigo-50/40 p-6 md:p-8 rounded-3xl border border-indigo-100 shadow-sm pbl-hover-glow">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-indigo-200"><i class="bi bi-bar-chart-line"></i></div>
                    <h3 class="text-base font-black text-indigo-900 mb-2">Rekap PDF Otomatis</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Unduh laporan kehadiran dalam format PDF lengkap dengan tabel dan statistik visual.</p>
                </div>
                <div class="bg-emerald-50/40 p-6 md:p-8 rounded-3xl border border-emerald-100 shadow-sm pbl-hover-glow">
                    <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-emerald-200"><i class="bi bi-shield-check"></i></div>
                    <h3 class="text-base font-black text-emerald-900 mb-2">Pengajuan Izin Digital</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Karyawan dapat mengajukan cuti atau izin sakit dengan lampiran surat dokter secara digital.</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => { menu.classList.toggle('hidden'); });
</script>
@endpush