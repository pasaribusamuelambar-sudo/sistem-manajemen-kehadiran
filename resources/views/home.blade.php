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
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-slate-200 p-8 flex flex-col shadow-sm">
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
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3 p-4 text-rose-500 hover:bg-rose-50 rounded-2xl transition-all font-bold group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-12 overflow-y-auto">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Halo, Karyawan 👋</h1>
                    <p class="text-slate-500 mt-2 font-medium">Sudahkah Anda melakukan presensi hari ini?</p>
                </div>
                
                <div class="flex items-center space-x-4 bg-white p-2 pr-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">User Akun</p>
                        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">Karyawan</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 mb-8 text-center">
                <h3 class="text-xl font-bold mb-4">Presensi Masuk/Keluar</h3>
                <div class="flex justify-center space-x-4">
                    <button class="px-8 py-4 bg-emerald-500 text-white rounded-2xl font-black shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition-all flex items-center space-x-2">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        <span>Absen Masuk</span>
                    </button>
                    <button class="px-8 py-4 bg-rose-500 text-white rounded-2xl font-black shadow-lg shadow-rose-200 hover:bg-rose-600 transition-all flex items-center space-x-2">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span>Absen Keluar</span>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 flex items-center space-x-6">
                    <div class="p-4 bg-indigo-50 rounded-2xl text-indigo-600">
                        <i data-lucide="clock" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Total Jam Kerja</p>
                        <h3 class="text-3xl font-black text-slate-900">160 Jam</h3>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 flex items-center space-x-6">
                    <div class="p-4 bg-amber-50 rounded-2xl text-amber-600">
                        <i data-lucide="alert-circle" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Keterlambatan</p>
                        <h3 class="text-3xl font-black text-slate-900">2 Kali</h3>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
      lucide.createIcons();
    </script>
</body>
</html>