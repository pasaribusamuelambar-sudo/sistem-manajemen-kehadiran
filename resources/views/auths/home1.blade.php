<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        #map { height: 400px; border-radius: 1.5rem; width: 100%; z-index: 10; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        /* Efek transisi halus saat sidebar mengecil */
        .transition-sidebar { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <div class="flex min-h-screen">
        
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 z-30 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>
        
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-white border-r border-slate-200 p-4 flex flex-col z-40 transition-sidebar sidebar-scroll lg:translate-x-0 transform -translate-x-full">
            
            <div class="mb-8 flex items-center justify-between p-2">
                <div class="flex items-center space-x-3 sidebar-text">
                    <div class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-100 flex-shrink-0">
                        <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter target-sidebar-hide">Presensi<span class="text-indigo-600">Hub</span></span>
                </div>
                
                <button onclick="toggleSidebar()" class="hidden lg:flex p-2 rounded-xl hover:bg-slate-100 text-slate-500 transition-all">
                    <i data-lucide="chevron-left" id="toggle-icon" class="w-5 h-5 transition-sidebar"></i>
                </button>
            </div>
            
            <nav class="space-y-1.5 flex-1 overflow-y-auto px-2">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-2 target-sidebar-hide">Main Menu</div>
                
                <a href="{{ route('home_admin', ['page' => 'dashboard']) }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? 'dashboard') == 'dashboard' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }} rounded-2xl font-bold transition-all group justify-start">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0 {{ ($page ?? 'dashboard') == 'dashboard' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap">Dashboard</span>
                </a>

                <a href="{{ route('home_admin', ['page' => 'monitoring']) }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'monitoring' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }} rounded-2xl font-bold transition-all group justify-start">
                    <i data-lucide="activity" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'monitoring' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap">Monitoring Presensi</span>
                </a>

                <a href="{{ route('home_admin', ['page' => 'karyawan']) }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'karyawan' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }} rounded-2xl font-bold transition-all group justify-start">
                    <i data-lucide="users" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'karyawan' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap">Data Karyawan</span>
                </a>

                <a href="{{ route('home_admin', ['page' => 'profile']) }}" 
                   class="flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'profile' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }} rounded-2xl font-bold transition-all group justify-start">
                    <i data-lucide="user" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'profile' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap">Profil Saya</span>
                </a>
            </nav>

            <div class="pt-4 border-t border-slate-100 px-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3.5 text-rose-500 hover:bg-rose-50 rounded-2xl transition-all font-bold group justify-start">
                        <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0 text-rose-400 group-hover:text-rose-500"></i>
                        <span class="target-sidebar-hide whitespace-nowrap">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main id="main-content" class="flex-1 flex flex-col min-h-screen w-full lg:pl-72 transition-sidebar">
            
            <header class="bg-white border-b border-slate-200 px-4 py-4 flex items-center justify-between sticky top-0 z-30 sm:px-6 lg:px-12">
                
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()" class="p-2 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-all flex items-center space-x-2 px-3">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                        <span class="text-xs font-bold hidden sm:inline">Menu Sidebar</span>
                    </button>
                    <div class="hidden md:block">
                        <h2 class="text-xs font-extrabold text-slate-400 uppercase tracking-widest">Pusat Administrasi</h2>
                    </div>
                </div>

                <div class="flex items-center space-x-4 sm:space-x-6">
                    <div class="text-right border-r border-slate-200 pr-4 sm:pr-6 hidden sm:block">
                        <p id="realtime-clock" class="text-lg sm:text-xl font-black text-indigo-600 tracking-tighter">00:00:00</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Waktu Server</p>
                    </div>

                    <a href="{{ route('home_admin', ['page' => 'profile']) }}" class="flex items-center space-x-3 p-1.5 rounded-2xl hover:bg-slate-50 transition-all group">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                {{ $karyawan->nama ?? Auth::user()->name ?? 'Samuel Ambar Pasaribu' }}
                            </p>
                            <p class="text-[11px] font-medium text-slate-400">Admin Informatika</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-indigo-100 overflow-hidden border border-slate-200 flex-shrink-0">
                            @if(isset($karyawan) && $karyawan->foto)
                                <img src="{{ asset('storage/'.$karyawan->foto) }}" alt="Profile" class="w-full h-full object-cover">
                            @elseif(Auth::user() && Auth::user()->avatar)
                                <img src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <i data-lucide="user" class="w-5 h-5"></i>
                            @endif
                        </div>
                    </a>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-12 overflow-y-auto flex-1">
                @if(($page ?? 'dashboard') == 'profile')
                    @include('auths.profile')
                @elseif(($page ?? 'dashboard') == 'karyawan')
                    @include('auths.karyawan_divisi')
                @elseif(($page ?? 'dashboard') == 'monitoring')
                    @include('auths.monitoring')
                @else
                    @include('auths.dashboard')
                @endif
            </div>
        </main>
    </div>

    <script>
        // Inisialisasi semua ikon Lucide
        lucide.createIcons();

        // Fungsi Buka Tutup Sidebar yang Responsif (HP, Tablet & Desktop)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleIcon = document.getElementById('toggle-icon');
            const overlay = document.getElementById('sidebar-overlay');
            const hiddenElements = document.querySelectorAll('.target-sidebar-hide');
            
            // Logika untuk Layar Mobile & Tablet (< 1024px)
            if (window.innerWidth < 1024) {
                if (sidebar.classList.contains('-translate-x-full')) {
                    // Buka Sidebar di Mobile
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    setTimeout(() => {
                        overlay.classList.add('opacity-100');
                    }, 50);
                } else {
                    // Tutup Sidebar di Mobile
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                    }, 300);
                }
            } 
            // Logika untuk Layar Desktop (>= 1024px) - Sistem Mini-Sidebar
            else {
                if (sidebar.classList.contains('w-72')) {
                    sidebar.classList.remove('w-72');
                    sidebar.classList.add('w-20');
                    mainContent.classList.remove('lg:pl-72');
                    mainContent.classList.add('lg:pl-20');
                    
                    if(toggleIcon) toggleIcon.style.transform = 'rotate(180deg)';
                    
                    // Sembunyikan label text, menyisakan icon saja
                    hiddenElements.forEach(el => el.classList.add('hidden'));
                } else {
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-72');
                    mainContent.classList.remove('lg:pl-20');
                    mainContent.classList.add('lg:pl-72');
                    
                    if(toggleIcon) toggleIcon.style.transform = 'rotate(0deg)';
                    
                    // Tampilkan kembali label text
                    hiddenElements.forEach(el => el.classList.remove('hidden'));
                }
            }
        }

        // Otomatis tutup overlay jika layar di-resize dari mobile ke desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
            }
        });

        // Realtime Clock Teroptimasi
        function updateClock() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            document.getElementById('realtime-clock').textContent = now.toLocaleTimeString('id-ID', options).replace(/\./g, ':');
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>