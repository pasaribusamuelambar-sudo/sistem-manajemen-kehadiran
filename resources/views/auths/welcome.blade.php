<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .glass {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-gradient-custom {
            background: radial-gradient(circle at top left, #e0e7ff 0%, #f8fafc 40%);
        }
    </style>
</head>
<body class="text-slate-900 overflow-x-hidden bg-gradient-custom min-h-screen">

    <nav class="fixed w-full z-50 bg-white/60 backdrop-blur-xl border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-20">
                
                <div class="flex items-center space-x-3 w-1/4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="bi bi-person-check-fill text-white"></i>
                    </div>
                    <span class="font-extrabold text-lg tracking-tight uppercase text-slate-800">
                        Presensi<span class="text-indigo-600">Hub</span>
                    </span>
                </div>
                
                <div class="hidden md:flex flex-1 justify-center items-center space-x-10">
                    <a href="{{ route('about') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Tentang Kami</a>
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

        <div id="mobile-menu" class="hidden md:hidden bg-white/95 border-b border-slate-100 px-6 py-6 space-y-4 shadow-xl">
            <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pb-1 border-b border-slate-100">Menu</div>
            <a href="{{ route('about') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Tentang Kami</a>
            <a href="{{ route('contact') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Hubungi Kami</a>
            
            <div class="text-xs font-bold tracking-wider text-slate-400 uppercase pt-2 pb-1 border-b border-slate-100">Akun</div>
            <a href="{{ route('login') }}" class="block text-base font-semibold text-slate-700 hover:text-indigo-600 transition">Login</a>
            <a href="{{ route('register') }}" class="block bg-indigo-600 text-white text-center px-5 py-3 rounded-xl text-sm font-bold shadow-lg">Daftar Sekarang</a>
        </div>
    </nav>

    <main class="relative pt-32 md:pt-48 pb-20 px-4 sm:px-6">
        <div class="absolute top-20 right-0 w-48 md:w-80 h-48 md:h-80 bg-indigo-200 rounded-full blur-[80px] md:blur-[120px] opacity-40 -z-10"></div>
        <div class="absolute bottom-10 left-10 w-40 md:w-64 h-40 md:h-64 bg-blue-200 rounded-full blur-[70px] md:blur-[100px] opacity-30 -z-10"></div>

        <div class="max-w-5xl mx-auto text-center">
            <div class="inline-block bg-white/80 border border-indigo-100 px-4 py-1.5 rounded-full mb-6 shadow-sm">
                <span class="text-indigo-600 text-[10px] md:text-xs font-bold uppercase tracking-widest italic">Digital Presence Solution</span>
            </div>

            <h1 class="text-3xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Sistem Terintegrasi<br class="hidden md:block">
                <span class="text-indigo-600">Kehadiran Karyawan</span>
            </h1>

            <p class="text-slate-500 text-sm md:text-lg mb-10 max-w-2xl mx-auto leading-relaxed px-4">
                Platform manajemen kehadiran terpadu untuk memantau produktivitas, mengelola perizinan, dan laporan secara akurat.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16 md:mb-24 px-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold shadow-2xl hover:bg-slate-800 transition transform hover:-translate-y-1 text-center">
                    Mulai Absensi
                </a>
                <a href="#features" class="w-full sm:w-auto glass px-8 py-4 rounded-2xl font-bold text-slate-700 hover:bg-white/80 transition text-center">
                    Pelajari Fitur
                </a>
            </div>  

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 sm:px-0 mb-28">
                <div class="bg-white/50 border border-white/40 p-6 md:p-8 rounded-[2rem] shadow-sm hover:shadow-md transition">
                    <div class="text-3xl font-black text-indigo-600 mb-2 italic">99%</div>
                    <div class="text-sm font-bold text-slate-800">Akurasi Data</div>
                    <p class="text-slate-500 text-xs mt-2">Validasi kehadiran otomatis tanpa risiko manipulasi.</p>
                </div>
                <div class="bg-white/50 border border-white/40 p-6 md:p-8 rounded-[2rem] shadow-sm hover:shadow-md transition">
                    <div class="text-3xl font-black text-blue-600 mb-2 italic">24/7</div>
                    <div class="text-sm font-bold text-slate-800">Akses Mandiri</div>
                    <p class="text-slate-500 text-xs mt-2">Karyawan dapat melihat riwayat kehadiran kapan saja.</p>
                </div>
                <div class="bg-white/50 border border-white/40 p-6 md:p-8 rounded-[2rem] shadow-sm hover:shadow-md transition">
                    <div class="text-3xl font-black text-emerald-600 mb-2 italic">Cloud</div>
                    <div class="text-sm font-bold text-slate-800">Penyimpanan Aman</div>
                    <p class="text-slate-500 text-xs mt-2">Data tersimpan aman di server pusat terintegrasi.</p>
                </div>
            </div>

            <div id="features" class="pt-12 scroll-mt-24">
                <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-12">
                    Semua yang Anda Butuhkan
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <div class="bg-blue-50/40 p-6 md:p-8 rounded-3xl border border-blue-100 shadow-sm hover:shadow-md hover:bg-blue-50 transition-all duration-300">
                        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-blue-200">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h3 class="text-base font-black text-blue-900 mb-2">Check-in & Check-out</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Karyawan absen hanya dengan satu klik. Sistem otomatis mencatat waktu dan mendeteksi keterlambatan.</p>
                    </div>

                    <div class="bg-indigo-50/40 p-6 md:p-8 rounded-3xl border border-indigo-100 shadow-sm hover:shadow-md hover:bg-indigo-50 transition-all duration-300">
                        <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-indigo-200">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>
                        <h3 class="text-base font-black text-indigo-900 mb-2">Rekap PDF Otomatis</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Unduh laporan kehadiran dalam format PDF lengkap dengan tabel dan statistik visual.</p>
                    </div>

                    <div class="bg-emerald-50/40 p-6 md:p-8 rounded-3xl border border-emerald-100 shadow-sm hover:shadow-md hover:bg-emerald-50 transition-all duration-300">
                        <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-emerald-200">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="text-base font-black text-emerald-900 mb-2">Pengajuan Izin Digital</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Karyawan dapat mengajukan cuti atau izin sakit dengan lampiran surat dokter secara digital.</p>
                    </div>

                    <div class="bg-amber-50/40 p-6 md:p-8 rounded-3xl border border-amber-100 shadow-sm hover:shadow-md hover:bg-amber-50 transition-all duration-300">
                        <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-amber-200">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="text-base font-black text-amber-900 mb-2">Multi-role Akses</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Admin punya kendali penuh, karyawan hanya melihat data miliknya. Aman dan terkontrol.</p>
                    </div>

                    <div class="bg-rose-50/40 p-6 md:p-8 rounded-3xl border border-rose-100 shadow-sm hover:shadow-md hover:bg-rose-50 transition-all duration-300">
                        <div class="w-12 h-12 bg-rose-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-rose-200">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h3 class="text-base font-black text-rose-900 mb-2">Monitoring Real-time</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Admin dapat memantau siapa yang hadir, terlambat, atau tidak hadir setiap saat.</p>
                    </div>

                    <div class="bg-cyan-50/40 p-6 md:p-8 rounded-3xl border border-cyan-100 shadow-sm hover:shadow-md hover:bg-cyan-50 transition-all duration-300">
                        <div class="w-12 h-12 bg-cyan-600 rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-md shadow-cyan-200">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h3 class="text-base font-black text-cyan-900 mb-2">Pencatatan Lokasi</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Catat lokasi presensi karyawan untuk kebutuhan audit dan verifikasi kehadiran.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-6 px-6 border-t border-indigo-100/30 bg-slate-900">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-indigo-500 rounded-lg flex items-center justify-center shadow-sm">
                    <i class="bi bi-person-check-fill text-white text-[10px]"></i>
                </div>
                <span class="font-bold text-xs text-white tracking-wider uppercase italic">
                    Presensi<span class="text-indigo-400">Hub</span>
                </span>
            </div>

            <div class="order-3 md:order-2">
                <p class="text-slate-500 text-[9px] font-medium uppercase tracking-[0.15em] text-center">
                    © 2026 <span class="text-slate-400">Sistem Manajemen Kehadiran</span> • All Rights Reserved
                </p>
            </div>

            <div class="flex items-center space-x-5 order-2 md:order-3">
                <a href="#" class="text-slate-500 hover:text-indigo-400 transition-all duration-300">
                    <i class="bi bi-shield-lock text-sm"></i>
                </a>
                <a href="#" class="text-slate-500 hover:text-indigo-400 transition-all duration-300">
                    <i class="bi bi-info-circle text-sm"></i>
                </a>
                <div class="h-3 w-[1px] bg-slate-800"></div>
                <a href="#" class="text-slate-500 hover:text-indigo-400 transition-all duration-300">
                    <i class="bi bi-github text-sm"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    </script>
</body>
</html>