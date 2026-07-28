@extends('layouts.app')

@section('title', 'Tim Pengembang | PresensiHub')

@section('content')
<link rel="stylesheet" href="{{ asset('style/style_samuel.css') }}">

<style>
    /* Animasi Efek Berkilau Memanjang (Shimmer Glow Move) */
    @keyframes shimmerGlow {
        0% { transform: translate(-30%, -30%) rotate(0deg); }
        50% { transform: translate(-20%, -20%) rotate(180deg); }
        100% { transform: translate(-30%, -30%) rotate(360deg); }
    }

    /* Efek Pantulan Cahaya Glossy pada Kartu */
    .pbl-card-shine {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle 130px at var(--x, 0px) var(--y, 0px), rgba(255,255,255,0.25), transparent 80%);
        z-index: 15;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .group:hover .pbl-card-shine {
        opacity: 1;
    }

    /* Transformasi Dasar Kartu 3D */
    .pbl-interactive-card {
        transition: transform 0.15s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.3s ease;
        transform-style: preserve-3d;
        will-change: transform;
    }
    
    .pbl-moving-border {
        position: relative;
        overflow: hidden;
    }

    /* Custom Moving Border per Admin dengan Variasi Warna Request */
    .border-admin-1::before {
        content: '';
        position: absolute;
        inset: -20px;
        background: conic-gradient(from 0deg, #38bdf8, #0ea5e9, #0284c7, #bae6fd, #38bdf8);
        animation: shimmerGlow 6s linear infinite;
        z-index: 0;
    }

    .border-admin-2::before {
        content: '';
        position: absolute;
        inset: -20px;
        background: conic-gradient(from 0deg, #fb923c, #f97316, #ea580c, #ffedd5, #fb923c);
        animation: shimmerGlow 6s linear infinite;
        z-index: 0;
    }

    .border-admin-3::before {
        content: '';
        position: absolute;
        inset: -20px;
        background: conic-gradient(from 0deg, #4ade80, #22c55e, #16a34a, #dcfce7, #4ade80);
        animation: shimmerGlow 6s linear infinite;
        z-index: 0;
    }
</style>

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
                <a href="{{ route('about') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-sm font-bold text-indigo-600 transition border-b-2 border-indigo-600 pb-1">Hubungi Kami</a>
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
        <a href="{{ route('about') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Tentang Kami</a>
        <a href="{{ route('contact') }}" class="block text-base font-semibold text-indigo-600 transition">Hubungi Kami</a>
        <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pt-2 pb-1 border-b border-slate-100">Akun</div>
        <a href="{{ route('login') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Login</a>
        <a href="{{ route('register') }}" class="block bg-indigo-600 text-white text-center px-5 py-3 rounded-xl text-sm font-bold shadow-lg">Daftar Sekarang</a>
    </div>
</nav>

<section class="w-full pt-32 pb-28 px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.08),transparent_50%)] -z-10"></div>

    <div class="max-w-7xl mx-auto">
        
        <!-- CAROUSEL SLIDER RAPI & PROPORSIONAL -->
        <div class="max-w-4xl mx-auto mb-12 relative rounded-[2rem] overflow-hidden shadow-2xl shadow-indigo-100 border border-slate-100 bg-slate-950">
            <div id="carouselSlider" class="flex transition-transform duration-700 ease-in-out w-full h-[280px] md:h-[420px]">
                
                <!-- SLIDE GEDUNG -->
                <div class="w-full flex-shrink-0 relative h-full bg-slate-900">
                    <div class="w-full h-full pbl-hero-gedung"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent flex items-end p-8">
                        <p class="text-white font-bold text-lg md:text-xl tracking-tight">Kampus Politeknik Negeri Batam</p>
                    </div>
                </div>

                <!-- SLIDE ADMIN 1 -->
                <div class="w-full flex-shrink-0 relative h-full bg-slate-900 flex items-center justify-center overflow-hidden">
                    <img src="https://lh3.googleusercontent.com/d/1Zc4ZY6L29f2ikjoZ3p0YrSvsQ4FZ62ls" alt="Samuel Ambar Pasaribu" class="h-full w-auto max-w-full object-contain py-2 shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent flex items-end p-8 pointer-events-none">
                        <p class="text-white font-bold text-lg md:text-xl tracking-tight">Samuel Ambar Pasaribu - Admin 1</p>
                    </div>
                </div>

                <!-- SLIDE ADMIN 2 -->
                <div class="w-full flex-shrink-0 relative h-full bg-slate-900 flex items-center justify-center overflow-hidden">
                    <img src="https://lh3.googleusercontent.com/d/1wbxZMJ1jD8DGH8uB8nMMRIXEnpZsBhOu" alt="Aditya Rizki Kurniawan" class="h-full w-auto max-w-full object-contain py-2 shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent flex items-end p-8 pointer-events-none">
                        <p class="text-white font-bold text-lg md:text-xl tracking-tight">Aditya Rizki Kurniawan - Admin 2</p>
                    </div>
                </div>

                <!-- SLIDE ADMIN 3 -->
                <div class="w-full flex-shrink-0 relative h-full bg-slate-900 flex items-center justify-center overflow-hidden">
                    <img src="https://lh3.googleusercontent.com/d/1IN2blydy_2cpU4iRJHADdRKNp5pfs7gk" alt="Muhammad Hoirul Farhan" class="h-full w-auto max-w-full object-contain py-2 shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent flex items-end p-8 pointer-events-none">
                        <p class="text-white font-bold text-lg md:text-xl tracking-tight">Muhammad Hoirul Farhan - Admin 3</p>
                    </div>
                </div>

            </div>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                <button onclick="goToSlide(0)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-white transition-all duration-300"></button>
                <button onclick="goToSlide(1)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/50 transition-all duration-300"></button>
                <button onclick="goToSlide(2)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/50 transition-all duration-300"></button>
                <button onclick="goToSlide(3)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/50 transition-all duration-300"></button>
            </div>
        </div>

        <div class="text-center mb-20 flex flex-col items-center justify-center">
            <div class="inline-flex items-center justify-center border px-5 py-1.5 rounded-full mb-4 pbl-team-badge">
                <span class="text-[10px] font-black uppercase tracking-widest">PBL Project Team</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">
                Tim <span class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">Pengembang Sistem</span>
            </h2>
            <div class="w-full max-w-xs border-t border-slate-200/80 my-2 mx-auto"></div>
            <p class="text-slate-500 font-bold tracking-widest uppercase text-[11px] mt-2">
                Informatika Malam-B • Politeknik Negeri Batam
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-12">
            
            <!-- ADMIN 1 -->
            <div class="pbl-interactive-card group relative rounded-[2.5rem] p-[3px] pbl-moving-border border-admin-1 bg-slate-100 shadow-lg hover:shadow-sky-200/60">
                <div class="pbl-card-shine"></div>
                <div class="relative bg-white rounded-[2.4rem] p-8 flex flex-col items-center text-center h-full z-10 transition-transform duration-300 group-hover:bg-slate-50/50">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mb-6 overflow-hidden border-4 border-sky-50 shadow-md group-hover:scale-105 group-hover:border-sky-400 transition-all duration-300 relative flex-shrink-0">
                        <img src="https://lh3.googleusercontent.com/d/1Zc4ZY6L29f2ikjoZ3p0YrSvsQ4FZ62ls" alt="Samuel Ambar Pasaribu" class="w-full h-full object-cover object-top">
                    </div>
                    
                    <h3 class="text-lg font-black text-slate-800 mb-1 uppercase tracking-tight group-hover:text-sky-500 transition-colors">SAMUEL AMBAR PASARIBU</h3>
                    <p class="text-sky-600 text-[10px] font-black uppercase tracking-widest mb-5 px-3 py-1 bg-sky-50 rounded-full italic">Admin 1</p>
                    
                    <div class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 mb-6 group-hover:bg-white transition-colors">
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">NIM Mahasiswa</p>
                        <p class="text-sm font-extrabold text-slate-700 tracking-wide">3312511048</p> 
                    </div>
                    
                    <div class="grid grid-cols-4 gap-2.5 w-full mt-auto relative z-20">
                        <a href="https://wa.me/6282170378193" target="_blank" class="bg-emerald-500 text-white p-3 rounded-xl hover:bg-emerald-600 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:pasaribusamuelambar@gmail.com" class="bg-sky-500 text-white p-3 rounded-xl hover:bg-sky-600 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-envelope-fill"></i></a>
                        <a href="https://www.instagram.com/s13samuel.a.pasaribu0307" target="_blank" class="bg-gradient-to-tr from-yellow-500 via-pink-500 to-purple-500 text-white p-3 rounded-xl hover:opacity-90 hover:scale-110 transition text-base flex items-center justify-center duration-150"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="bg-slate-900 text-white p-3 rounded-xl hover:bg-slate-800 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- ADMIN 2 (POSISI FOTO DISESUAIKAN PERSIS DI TENGAH) -->
            <div class="pbl-interactive-card group relative rounded-[2.5rem] p-[3px] pbl-moving-border border-admin-2 bg-slate-100 shadow-lg hover:shadow-orange-200/60">
                <div class="pbl-card-shine"></div>
                <div class="relative bg-white rounded-[2.4rem] p-8 flex flex-col items-center text-center h-full z-10 transition-transform duration-300 group-hover:bg-slate-50/50">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mb-6 overflow-hidden border-4 border-orange-50 shadow-md group-hover:scale-105 group-hover:border-orange-400 transition-all duration-300 relative flex-shrink-0">
                        <img src="https://lh3.googleusercontent.com/d/1wbxZMJ1jD8DGH8uB8nMMRIXEnpZsBhOu" alt="Aditya Rizki Kurniawan" class="w-full h-full object-cover object-[center_20%]">
                    </div>
                    
                    <h3 class="text-lg font-black text-slate-800 mb-1 uppercase tracking-tight group-hover:text-orange-500 transition-colors">ADITYA RIZKI KURNIAWAN</h3>
                    <p class="text-orange-600 text-[10px] font-black uppercase tracking-widest mb-5 px-3 py-1 bg-orange-50 rounded-full italic">Admin 2</p>
                    
                    <div class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 mb-6 group-hover:bg-white transition-colors">
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">NIM Mahasiswa</p>
                        <p class="text-sm font-extrabold text-slate-700 tracking-wide">3312511054</p>
                    </div>
                    
                    <div class="grid grid-cols-4 gap-2.5 w-full mt-auto relative z-20">
                        <a href="#" target="_blank" class="bg-emerald-500 text-white p-3 rounded-xl hover:bg-emerald-600 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:adityarizki.kurniawan@gmail.com" class="bg-orange-500 text-white p-3 rounded-xl hover:bg-orange-600 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-envelope-fill"></i></a>
                        <a href="#" target="_blank" class="bg-gradient-to-tr from-yellow-500 via-pink-500 to-purple-500 text-white p-3 rounded-xl hover:opacity-90 hover:scale-110 transition text-base flex items-center justify-center duration-150"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="bg-slate-900 text-white p-3 rounded-xl hover:bg-slate-800 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- ADMIN 3 -->
            <div class="pbl-interactive-card group relative rounded-[2.5rem] p-[3px] pbl-moving-border border-admin-3 bg-slate-100 shadow-lg hover:shadow-emerald-200/60">
                <div class="pbl-card-shine"></div>
                <div class="relative bg-white rounded-[2.4rem] p-8 flex flex-col items-center text-center h-full z-10 transition-transform duration-300 group-hover:bg-slate-50/50">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mb-6 overflow-hidden border-4 border-emerald-50 shadow-md group-hover:scale-105 group-hover:border-emerald-400 transition-all duration-300 relative flex-shrink-0">
                        <img src="https://lh3.googleusercontent.com/d/1IN2blydy_2cpU4iRJHADdRKNp5pfs7gk" alt="Muhammad Hoirul Farhan" class="w-full h-full object-cover object-top">
                    </div>
                    
                    <h3 class="text-lg font-black text-slate-800 mb-1 uppercase tracking-tight group-hover:text-emerald-500 transition-colors">MUHAMMAD HOIRUL FARHAN</h3>
                    <p class="text-emerald-600 text-[10px] font-black uppercase tracking-widest mb-5 px-3 py-1 bg-emerald-50 rounded-full italic">Admin 3</p>
                    
                    <div class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 mb-6 group-hover:bg-white transition-colors">
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">NIM Mahasiswa</p>
                        <p class="text-sm font-extrabold text-slate-700 tracking-wide">3312511034</p>
                    </div>
                    
                    <div class="grid grid-cols-4 gap-2.5 w-full mt-auto relative z-20">
                        <a href="#" target="_blank" class="bg-emerald-500 text-white p-3 rounded-xl hover:bg-emerald-600 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:muhammad.hoirul.farhan@gmail.com" class="bg-emerald-500 text-white p-3 rounded-xl hover:bg-emerald-600 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-envelope-fill"></i></a>
                        <a href="#" target="_blank" class="bg-gradient-to-tr from-yellow-500 via-pink-500 to-purple-500 text-white p-3 rounded-xl hover:opacity-90 hover:scale-110 transition text-base flex items-center justify-center duration-150"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="bg-slate-900 text-white p-3 rounded-xl hover:bg-slate-800 hover:scale-110 transition text-base flex items-center justify-center shadow-md duration-150"><i class="bi bi-github"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // MOBILE NAVBAR TOGGLE
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    if(btn && menu) {
        btn.addEventListener('click', () => { menu.classList.toggle('hidden'); });
    }

    // AUTOMATIC CAROUSEL LOOPER
    let currentSlide = 0;
    const totalSlides = 4;
    const slider = document.getElementById('carouselSlider');
    const dots = document.querySelectorAll('.carousel-dot');

    function updateCarousel() {
        if(slider) {
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
            dots.forEach((dot, index) => {
                if(index === currentSlide) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white', 'w-6');
                } else {
                    dot.classList.remove('bg-white', 'w-6');
                    dot.classList.add('bg-white/50');
                }
            });
        }
    }

    setInterval(() => {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }, 4000);

    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        updateCarousel();
    }

    updateCarousel();

    // INTERACTIVE 3D TILT EFFECT
    const cards = document.querySelectorAll('.pbl-interactive-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left; 
            const y = e.clientY - rect.top;  
            
            card.style.setProperty('--x', `${x}px`);
            card.style.setProperty('--y', `${y}px`);
            
            const rotateX = ((rect.height / 2) - y) / (rect.height / 2) * 12;
            const rotateY = (x - (rect.width / 2)) / (rect.width / 2) * 12;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)';
        });
    });
</script>
@endpush