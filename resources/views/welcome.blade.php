<!DOCTYPE html>
<html lang="id">
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
            background-color: #f8fafc;
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
<body class="text-slate-900 overflow-x-hidden bg-gradient-custom">

    <nav class="fixed w-full z-50 bg-white/60 backdrop-blur-xl border-b border-white/20">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="bi bi-person-check-fill text-white"></i>
                </div>
                <span class="font-extrabold text-lg tracking-tight uppercase text-slate-800">
                    Presensi<span class="text-indigo-600">Hub</span>
                </span>
            </div>
            
            <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg text-xs font-bold shadow-lg hover:bg-indigo-700 transition">Daftar Sekarang</a>
            </div>
        </div>
    </nav>

    <main class="relative pt-40 pb-20 px-6">
        <div class="absolute top-20 right-0 w-80 h-80 bg-indigo-200 rounded-full blur-[120px] opacity-40 -z-10"></div>
        <div class="absolute bottom-10 left-10 w-64 h-64 bg-blue-200 rounded-full blur-[100px] opacity-30 -z-10"></div>

        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block bg-white/80 border border-indigo-100 px-4 py-1.5 rounded-full mb-6 shadow-sm">
                <span class="text-indigo-600 text-[10px] font-bold uppercase tracking-widest">Digital Presence Solution</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Sistem Terintegrasi<br>
                <span class="text-indigo-600">Kehadiran Karyawan</span>
            </h1>

            <p class="text-slate-500 text-base md:text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                Platform manajemen kehadiran terpadu untuk memantau produktivitas, mengelola perizinan, dan laporan kehadiran secara akurat dan transparan.
            </p>

            <div class="flex flex-col md:flex-row justify-center gap-4 mb-20">
                 <a href="{{ route('login') }}" class="bg-slate-900 text-white px-8 py-3.5 rounded-2xl font-bold shadow-2xl hover:bg-slate-800 transition transform hover:-translate-y-1">
                    Mulai Absensi
                </a>
                <a href="#features" class="glass px-8 py-3.5 rounded-2xl font-bold text-slate-700 hover:bg-white/80 transition">
                    Pelajari Fitur
                </a>
            </div>  
            <div id="features" class="grid md:grid-cols-3 gap-6">
                <div class="bg-white/50 border border-white/40 p-8 rounded-[2.5rem] shadow-sm">
                    <div class="text-3xl font-black text-indigo-600 mb-2">99%</div>
                    <div class="text-sm font-bold text-slate-800">Akurasi Data</div>
                    <p class="text-slate-500 text-xs mt-2">Validasi kehadiran otomatis tanpa risiko manipulasi.</p>
                </div>
                <div class="bg-white/50 border border-white/40 p-8 rounded-[2.5rem] shadow-sm">
                    <div class="text-3xl font-black text-blue-600 mb-2">24/7</div>
                    <div class="text-sm font-bold text-slate-800">Akses Mandiri</div>
                    <p class="text-slate-500 text-xs mt-2">Karyawan dapat melihat riwayat kehadiran kapan saja.</p>
                </div>
                <div class="bg-white/50 border border-white/40 p-8 rounded-[2.5rem] shadow-sm">
                    <div class="text-3xl font-black text-emerald-600 mb-2">Cloud</div>
                    <div class="text-sm font-bold text-slate-800">Penyimpanan Aman</div>
                    <p class="text-slate-500 text-xs mt-2">Data tersimpan aman di server pusat yang terintegrasi.</p>
                </div>
            </div>
        </div>
    </main>

   <footer class="py-6 px-6 border-t border-slate-100 bg-white/50">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center space-x-2">
                <span class="font-bold text-sm text-slate-800 tracking-tight italic">
                    Presensi<span class="text-indigo-600">Hub</span>
                </span>
            </div>

            <p class="text-slate-400 text-[9px] font-bold uppercase tracking-[0.15em]">
                © 2026 Sistem Manejemen Kehadiran Karyawan 
            </p>

            <div class="flex items-center space-x-4">
                <a href="#" title="Privacy Policy" class="text-slate-400 hover:text-indigo-600 transition text-sm">
                    <i class="bi bi-shield-lock"></i>
                </a>
                <a href="#" title="Information" class="text-slate-400 hover:text-indigo-600 transition text-sm">
                    <i class="bi bi-info-circle"></i>
                </a>
            </div>

        </div>
    </footer>

</body>
</html>