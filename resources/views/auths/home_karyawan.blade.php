<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Sidebar Scrollbar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <!-- Overlay Mobile -->
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-20 hidden backdrop-blur-sm lg:hidden"></div>

    <div class="flex min-h-screen relative">
        <!-- Sidebar Karyawan -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-white border-r border-slate-200 p-6 flex flex-col z-30 transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:static lg:h-screen sidebar-scroll">
            
            <div class="mb-10 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-200">
                        <i data-lucide="user" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter text-slate-900">Presensi<span class="text-indigo-600">Hub</span></span>
                </div>
                <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <nav class="space-y-2 flex-1 overflow-y-auto">
                <a href="{{ route('home_karyawan', ['page' => 'dashboard']) }}" 
                   class="flex items-center space-x-3 p-4 {{ request('page') == 'dashboard' || !request('page') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('home_karyawan', ['page' => 'riwayat']) }}" 
                   class="flex items-center space-x-3 p-4 {{ request('page') == 'riwayat' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="history" class="w-5 h-5"></i>
                    <span>Riwayat Absensi</span>
                </a>

                <a href="{{ route('home_karyawan', ['page' => 'izin']) }}" 
                   class="flex items-center space-x-3 p-4 {{ request('page') == 'izin' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Pengajuan Izin</span>
                </a>
            </nav>

            <div class="pt-6 mt-6 border-t border-slate-100">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3 p-4 text-rose-500 hover:bg-rose-50 rounded-2xl transition-all font-bold group">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-h-screen w-full overflow-hidden">
            
            <!-- Navbar Mobile -->
            <header class="lg:hidden bg-white border-b border-slate-200 p-4 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center space-x-2">
                    <div class="bg-indigo-600 p-1.5 rounded-lg text-white">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-lg tracking-tight italic">PresensiHub</span>
                </div>
                <button onclick="toggleSidebar()" class="p-2 bg-slate-100 rounded-xl text-slate-600">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </header>

            <div class="p-6 md:p-12 flex-1">
                @if(request('page') == 'riwayat')
                    <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight italic mb-10">Riwayat Absensi</h1>
                    {{-- @include('karyawan.riwayat') --}}
                    <div class="bg-white p-8 rounded-[32px] border border-slate-100 text-center text-slate-400 font-medium">
                        Fitur Riwayat akan segera hadir.
                    </div>

                @elseif(request('page') == 'izin')
                    @include('auths.izin') 

                @else
                    <!-- Dashboard Karyawan Default -->
                    @include('auths.karyawan_dashboard')
                @endif
            </div>

            <footer class="bg-white border-t border-slate-100 py-6 px-12 text-center text-xs md:text-sm font-medium text-slate-400 mt-auto">
                &copy; 2026 - PT Arthur Teknik Indoprima | Sistem Manajemen Kehadiran
            </footer>
        </main>
    </div>

    <script>
        lucide.createIcons();

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>