<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Karyawan | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Custom scrollbar untuk tampilan lebih bersih */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        @media (max-width: 768px) {
            .sidebar-closed { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="flex min-h-screen relative overflow-hidden">
        
        <!-- Sidebar (Desktop & Mobile) -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 p-8 flex flex-col shadow-xl transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 sidebar-closed">
            <!-- Close Button (Mobile Only) -->
            <button onclick="toggleSidebar()" class="lg:hidden absolute top-8 right-6 text-slate-400">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <div class="mb-12 flex items-center space-x-3">
                <div class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-200">
                    <i data-lucide="fingerprint" class="text-white w-6 h-6"></i>
                </div>
                <span class="font-extrabold text-2xl tracking-tighter">Presensi<span class="text-indigo-600">Hub</span></span>
            </div>
            
            <nav class="space-y-2 flex-1">
                <a href="#" class="flex items-center space-x-3 p-4 bg-indigo-50 text-indigo-700 rounded-2xl font-bold">
                    <i data-lucide="layout" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-4 text-slate-500 hover:bg-slate-50 hover:text-indigo-600 rounded-2xl transition-all font-semibold group">
                    <i data-lucide="calendar-check" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    <span>Riwayat Absensi</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-4 text-slate-500 hover:bg-slate-50 hover:text-indigo-600 rounded-2xl transition-all font-semibold group">
                    <i data-lucide="file-plus" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    <span>Ajukan Izin</span>
                </a>
            </nav>

            <div class="pt-6 border-t border-slate-100">
                <a href="#" class="flex items-center space-x-3 p-4 text-rose-500 hover:bg-rose-50 rounded-2xl transition-all font-bold group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Overlay for Mobile Sidebar -->
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 z-40 hidden backdrop-blur-sm transition-opacity"></div>

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-12 overflow-y-auto pb-24 lg:pb-12">
            
            <!-- Top Header (Mobile & Desktop) -->
            <div class="flex justify-between items-start lg:items-center mb-8 lg:mb-12">
                <div>
                    <!-- Hamburger Menu (Mobile Only) -->
                    <button onclick="toggleSidebar()" class="lg:hidden mb-4 p-2 bg-white rounded-xl shadow-sm border border-slate-200">
                        <i data-lucide="menu" class="w-6 h-6 text-indigo-600"></i>
                    </button>
                    <h1 class="text-2xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight">Halo, Karyawan 👋</h1>
                    <p class="text-slate-500 mt-1 lg:mt-2 font-medium text-sm lg:text-base">Sudahkah Anda presensi hari ini?</p>
                </div>
                
                <div class="hidden sm:flex items-center space-x-4 bg-white p-2 pr-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="h-10 w-10 lg:h-12 lg:w-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                        <i data-lucide="user" class="w-5 h-5 lg:w-6 lg:h-6"></i>
                    </div>
                    <div>
                        <p class="text-xs lg:text-sm font-bold text-slate-800">User Akun</p>
                        <p class="text-[9px] lg:text-[10px] font-black text-indigo-500 uppercase tracking-widest">Karyawan</p>
                    </div>
                </div>
            </div>

            <!-- Attendance Card -->
            <div class="bg-white p-6 lg:p-10 rounded-[30px] lg:rounded-[40px] shadow-sm border border-slate-100 mb-6 lg:mb-8 text-center">
                <h3 class="text-lg lg:text-xl font-bold mb-6">Presensi Hari Ini</h3>
                <div class="grid grid-cols-1 sm:flex sm:justify-center gap-4">
                    <button class="w-full sm:w-auto px-8 py-4 bg-emerald-500 text-white rounded-2xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-600 hover:-translate-y-1 transition-all flex items-center justify-center space-x-2">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        <span>Absen Masuk</span>
                    </button>
                    <button class="w-full sm:w-auto px-8 py-4 bg-rose-500 text-white rounded-2xl font-bold shadow-lg shadow-rose-100 hover:bg-rose-600 hover:-translate-y-1 transition-all flex items-center justify-center space-x-2">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span>Absen Keluar</span>
                    </button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
                <div class="bg-white p-6 lg:p-8 rounded-[24px] lg:rounded-[32px] shadow-sm border border-slate-100 flex items-center space-x-4 lg:space-x-6">
                    <div class="p-3 lg:p-4 bg-indigo-50 rounded-2xl text-indigo-600">
                        <i data-lucide="clock" class="w-6 h-6 lg:w-8 lg:h-8"></i>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] lg:text-sm font-bold uppercase tracking-widest">Total Jam Kerja</p>
                        <h3 class="text-2xl lg:text-3xl font-black text-slate-900">160 Jam</h3>
                    </div>
                </div>
                <div class="bg-white p-6 lg:p-8 rounded-[24px] lg:rounded-[32px] shadow-sm border border-slate-100 flex items-center space-x-4 lg:space-x-6">
                    <div class="p-3 lg:p-4 bg-amber-50 rounded-2xl text-amber-600">
                        <i data-lucide="alert-circle" class="w-6 h-6 lg:w-8 lg:h-8"></i>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] lg:text-sm font-bold uppercase tracking-widest">Keterlambatan</p>
                        <h3 class="text-2xl lg:text-3xl font-black text-slate-900">2 Kali</h3>
                    </div>
                </div>
            </div>
        </main>

        <!-- Bottom Navigation (Mobile Only) -->
        <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-6 py-3 flex justify-around items-center z-40">
            <a href="#" class="flex flex-col items-center text-indigo-600">
                <i data-lucide="layout" class="w-6 h-6"></i>
                <span class="text-[10px] font-bold mt-1">Home</span>
            </a>
            <a href="#" class="flex flex-col items-center text-slate-400">
                <i data-lucide="calendar-check" class="w-6 h-6"></i>
                <span class="text-[10px] font-bold mt-1">Riwayat</span>
            </a>
            <a href="#" class="flex flex-col items-center text-slate-400">
                <i data-lucide="file-plus" class="w-6 h-6"></i>
                <span class="text-[10px] font-bold mt-1">Izin</span>
            </a>
            <a href="#" class="flex flex-col items-center text-slate-400">
                <i data-lucide="user" class="w-6 h-6"></i>
                <span class="text-[10px] font-bold mt-1">Profil</span>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('sidebar-closed');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>