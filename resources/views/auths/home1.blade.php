<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | PresensiHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        #map { height: 400px; border-radius: 1.5rem; width: 100%; z-index: 10; }
        
        /* Menyembunyikan scrollbar bawaan agar tidak merusak visual */
        .sidebar-scroll::-webkit-scrollbar { 
            width: 0px; 
            background: transparent; 
        }
        .sidebar-scroll {
            -ms-overflow-style: none;  
            scrollbar-width: none;  
        }
        
        /* Transisi halus untuk buka-tutup sidebar */
        .transition-sidebar { 
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), padding 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <div class="flex min-h-screen">
        
        {{-- Overlay Background untuk Mobile --}}
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 z-30 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>
        
        {{-- Sidebar Utama: Menggunakan border-r-2 dan border-slate-700 (Garis Terang Kontras Tinggi) --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-slate-950 border-r-2 border-slate-700 p-4 flex flex-col z-40 transition-sidebar sidebar-scroll lg:translate-x-0 transform -translate-x-full overflow-hidden">
            
            <div id="sidebar-header-box" class="mb-8 flex items-center justify-between p-2 w-full transition-all duration-300">
                <div class="flex items-center space-x-3 sidebar-text overflow-hidden">
                    <div class="bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-900/30 flex-shrink-0">
                        <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter target-sidebar-hide text-white whitespace-nowrap transition-all duration-200">Presensi<span class="text-blue-500">Hub</span></span>
                </div>
                
                <button onclick="toggleSidebar()" class="hidden lg:flex p-2 rounded-xl hover:bg-slate-900 text-slate-400 transition-all flex-shrink-0">
                    <i data-lucide="chevron-left" id="toggle-icon" class="w-5 h-5 transition-transform duration-300"></i>
                </button>
            </div>
            
            <nav id="sidebar-nav" class="space-y-1.5 flex-1 overflow-y-auto px-2 sidebar-scroll overflow-x-hidden">
                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3 px-2 target-sidebar-hide whitespace-nowrap">Main Menu</div>
                
                {{-- Dashboard --}}
                <a href="{{ route('home_admin', ['page' => 'dashboard']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? 'dashboard') == 'dashboard' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0 {{ ($page ?? 'dashboard') == 'dashboard' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Dashboard</span>
                </a>

                {{-- Monitoring Presensi --}}
                <a href="{{ route('home_admin', ['page' => 'monitoring']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'monitoring' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="activity" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'monitoring' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Monitoring Presensi</span>
                </a>

                {{-- Menu Kelola Izin --}}
                <a href="{{ route('home_admin', ['page' => 'kelola_izin']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'kelola_izin' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="clipboard-list" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'kelola_izin' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Kelola Izin</span>
                </a>

                {{-- Menu Jenis Cuti --}}
                <a href="{{ route('home_admin', ['page' => 'jenis_cuti']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'jenis_cuti' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="calendar-days" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'jenis_cuti' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Jenis Cuti</span>
                </a>

                {{-- Lembur --}}
                <a href="{{ route('home_admin', ['page' => 'lembur']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'lembur' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="briefcase" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'lembur' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Lembur</span>
                </a>

                {{-- Jadwal Kerja --}}
                <a href="{{ route('home_admin', ['page' => 'jadwal']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'jadwal' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="calendar" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'jadwal' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Jadwal Kerja</span>
                </a>

                {{-- Data Karyawan --}}
                <a href="{{ route('home_admin', ['page' => 'karyawan']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'karyawan' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="users" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'karyawan' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Data Karyawan</span>
                </a>

                {{-- Manajemen Divisi --}}
                <a href="{{ route('home_admin', ['page' => 'divisi']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'divisi' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="building-2" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'divisi' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Manajemen Divisi</span>
                </a>
                    
                {{-- Profil --}}
                <a href="{{ route('home_admin', ['page' => 'profile']) }}" 
                   class="nav-link flex items-center space-x-3 px-4 py-3.5 {{ ($page ?? '') == 'profile' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group justify-start overflow-hidden">
                    <i data-lucide="user" class="w-5 h-5 flex-shrink-0 {{ ($page ?? '') == 'profile' ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Profil</span>
                </a>
            </nav>

            {{-- Garis Pembatas Atas Keluar/Logout --}}
            <div class="pt-4 border-t border-slate-800 px-2 overflow-hidden flex-shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link w-full flex items-center space-x-3 px-4 py-3.5 text-rose-500 hover:bg-rose-950/40 rounded-2xl transition-all font-bold group justify-start overflow-hidden">
                        <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0 text-rose-500 group-hover:text-rose-400"></i>
                        <span class="target-sidebar-hide whitespace-nowrap transition-opacity duration-200">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Konten Utama Utama --}}
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
                            <p id="header-user-name" class="text-sm font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                Samuel Ambar Pasaribu
                            </p>
                            <p id="header-user-role" class="text-[11px] font-medium text-slate-400">
                                Admin Admin
                            </p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-indigo-600 flex items-center justify-center font-bold text-sm shadow-md overflow-hidden border border-slate-200 flex-shrink-0 relative">
                            <img id="header-avatar-img" src="" alt="Profile" class="hidden w-full h-full object-cover">
                            <i id="header-avatar-icon" data-lucide="user" class="w-5 h-5"></i>
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
                @elseif(($page ?? 'dashboard') == 'kelola_izin')
                    @include('auths.kelola_izin')
                @elseif(($page ?? 'dashboard') == 'jenis_cuti')
                    @include('auths.jenis_cuti')
                @elseif(($page ?? 'dashboard') == 'divisi')
                    @include('auths.divisi')
                @elseif(($page ?? 'dashboard') == 'jadwal')
                    @include('auths.jadwal_kerja')
                @elseif(($page ?? 'dashboard') == 'lembur')
                    @include('auths.kelola_lembur')
                @else
                    @include('auths.dashboard')
                @endif   
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        function syncHeaderProfile() {
            const savedData = JSON.parse(localStorage.getItem('userProfile'));
            const nameElement = document.getElementById('header-user-name');
            const roleElement = document.getElementById('header-user-role');
            const avatarImg = document.getElementById('header-avatar-img');
            const avatarIcon = document.getElementById('header-avatar-icon');

            if (savedData) {
                if (savedData.name) nameElement.innerText = savedData.name;
                if (savedData.role) roleElement.innerText = savedData.role;
                
                if (savedData.avatar) {
                    avatarImg.src = savedData.avatar;
                    avatarImg.classList.remove('hidden');
                    if (avatarIcon) avatarIcon.classList.add('hidden');
                } else {
                    avatarImg.classList.add('hidden');
                    if (avatarIcon) avatarIcon.classList.remove('hidden');
                }
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            syncHeaderProfile();
            window.addEventListener('storage', (e) => {
                if (e.key === 'userProfile') {
                    syncHeaderProfile();
                }
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleIcon = document.getElementById('toggle-icon');
            const overlay = document.getElementById('sidebar-overlay');
            const hiddenElements = document.querySelectorAll('.target-sidebar-hide');
            const navLinks = document.querySelectorAll('.nav-link');
            
            if (window.innerWidth < 1024) {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('w-72');
                    overlay.classList.remove('hidden');
                    setTimeout(() => {
                        overlay.classList.add('opacity-100');
                    }, 50);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                    }, 300);
                }
            } 
            else {
                if (sidebar.classList.contains('w-72')) {
                    // Ketika sidebar MENGECIL (W-20)
                    sidebar.classList.remove('w-72');
                    sidebar.classList.add('w-20', 'px-2'); 
                    mainContent.classList.remove('lg:pl-72');
                    mainContent.classList.add('lg:pl-20');
                    
                    if(toggleIcon) toggleIcon.style.transform = 'rotate(180deg)';
                    
                    // Mengubah susunan baris agar icon pas berdiri di tengah lingkaran
                    navLinks.forEach(link => {
                        link.classList.remove('justify-start', 'px-4');
                        link.classList.add('justify-center', 'px-0');
                    });

                    hiddenElements.forEach(el => {
                        el.classList.add('opacity-0');
                        setTimeout(() => el.classList.add('hidden'), 150);
                    });
                } else {
                    // Ketika sidebar MEMBESAR (W-72)
                    sidebar.classList.remove('w-20', 'px-2');
                    sidebar.classList.add('w-72');
                    mainContent.classList.remove('lg:pl-20');
                    mainContent.classList.add('lg:pl-72');
                    
                    if(toggleIcon) toggleIcon.style.transform = 'rotate(0deg)';
                    
                    // Kembalikan tata letak menu semula
                    navLinks.forEach(link => {
                        link.classList.remove('justify-center', 'px-0');
                        link.classList.add('justify-start', 'px-4');
                    });

                    hiddenElements.forEach(el => {
                        el.classList.remove('hidden');
                        setTimeout(() => el.classList.remove('opacity-0'), 50);
                    });
                }
            }
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
            }
        });

        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('realtime-clock').textContent = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>