<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-slate-200 p-8 flex flex-col fixed h-full">
            <div class="mb-12 flex items-center space-x-3">
                <div class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-200">
                    <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
                </div>
                <span class="font-extrabold text-2xl tracking-tighter text-slate-900">Presensi<span class="text-indigo-600">Hub</span></span>
            </div>
            
            <nav class="space-y-2 flex-1">
                <a href="{{ route('home1', ['page' => 'dashboard']) }}" 
                   class="flex items-center space-x-3 p-4 {{ request('page') != 'profile' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('home1', ['page' => 'profile']) }}" 
                   class="flex items-center space-x-3 p-4 {{ request('page') == 'profile' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="user-circle" class="w-5 h-5"></i>
                    <span>Profil Admin</span>
                </a>

                <a href="#" class="flex items-center space-x-3 p-4 text-slate-500 hover:bg-slate-50 hover:text-indigo-600 rounded-2xl transition-all group">
                    <i data-lucide="users" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    <span class="font-semibold">Data Karyawan</span>
                </a>
            </nav>

            <div class="pt-6 border-t border-slate-100">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3 p-4 text-rose-500 hover:bg-rose-50 rounded-2xl transition-all font-bold group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-12 ml-72 overflow-y-auto">
            
            @if(request('page') == 'profile')
                
                <h1 class="text-4xl font-black text-slate-900 tracking-tight italic mb-12">Profil Saya</h1>
                @include('profile') {{-- Ini memanggil file profile.blade.php kamu --}}

            @else
                
                <div class="flex justify-between items-center mb-12">
                    <div>
                        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Selamat Datang, Admin 👋</h1>
                        <p class="text-slate-500 mt-2 font-medium">admin hari ini ada <span class="text-indigo-600 font-bold">12 permintaan izin</span> yang perlu dicek.</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="p-3 bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-indigo-600 transition-colors shadow-sm">
                            <i data-lucide="bell" class="w-6 h-6"></i>
                        </button>
                        <div class="h-12 w-12 bg-gradient-to-tr from-indigo-600 to-violet-500 rounded-2xl shadow-lg shadow-indigo-200 border-2 border-white"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-indigo-200 transition-all group">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-4 bg-indigo-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i data-lucide="user-plus" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-black text-green-500 bg-green-50 px-3 py-1 rounded-full uppercase">+12%</span>
                        </div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-1">Total Karyawan</p>
                        <h3 class="text-4xl font-black text-slate-900">150</h3>
                    </div>

                    <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-emerald-200 transition-all group">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-4 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                <i data-lucide="activity" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase italic font-black">Live</span>
                        </div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-1">Status Sistem</p>
                        <h3 class="text-4xl font-black text-emerald-600">Online</h3>
                    </div>

                    <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-indigo-200 transition-all group">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-4 bg-indigo-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i data-lucide="check-circle" class="w-6 h-6"></i>
                            </div>
                        </div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-1">Kehadiran Hari Ini</p>
                        <h3 class="text-4xl font-black text-slate-900">92%</h3>
                    </div>
                </div>

                <div class="mt-12 bg-white border border-slate-200 rounded-[40px] p-10 flex items-center justify-between shadow-sm">
                    <div>
                        <h4 class="text-xl font-bold mb-1">Sistem PresensiHub v1.0</h4>
                        <p class="text-slate-500 font-medium italic">Dikembangkan oleh Tim Manajemen Kehadiran.</p>
                    </div>
                    <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">
                        Buka Laporan
                    </button>
                </div>
            @endif

        </main>
    </div>

    <script>
      lucide.createIcons();
    </script>

    <footer class="bg-blue-600 text-white py-6 text-center text-sm">
    @polibatam2026 - Sistem Manajemen Kehadiran Karyawan
</footer>

</body>
</html>