<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Mengunci area tengah agar scroll mandiri tanpa merusak komponen layout luar */
        .content-viewport-isolated {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: calc(100vh - 110px); /* Menyesuaikan batas tinggi agar tidak menabrak header luar */
            overflow-y: auto;             /* Guliran diisolasi hanya terjadi di dalam kontainer ini */
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Desain kustom scrollbar modern yang tipis */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        /* Penstabil lapisan rendering agar elemen tidak melayang saat scroll di browser Chromium */
        .render-stable {
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="content-viewport-isolated custom-scrollbar">
    <div class="p-8 max-w-7xl mx-auto w-full pb-16">
        
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Halo, Samuel! 👋</h1>
                <p class="text-slate-500 mt-2 font-medium">Sudahkah Anda melakukan presensi hari ini?</p>
            </div>
            <div class="text-right">
                <h2 id="liveClock" class="text-3xl font-black text-indigo-600 tracking-tighter">00:00:00</h2>
                <p id="liveDate" class="text-slate-400 font-bold text-sm uppercase tracking-widest">
                    @if(false) {{ date('d F Y') }} @else -- -- ---- @endif
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 render-stable">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-emerald-50 p-3 rounded-2xl text-emerald-600">
                        <i data-lucide="log-in" class="w-6 h-6"></i>
                    </div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Jam Masuk</p>
                </div>
                <h3 class="text-3xl font-black text-slate-900">08:06</h3>
                <p class="text-emerald-500 text-xs font-bold mt-1">Tepat Waktu</p>
            </div>

            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 render-stable">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-rose-50 p-3 rounded-2xl text-rose-600">
                        <i data-lucide="log-out" class="w-6 h-6"></i>
                    </div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Jam Pulang</p>
                </div>
                <h3 class="text-3xl font-black text-slate-300">-- : --</h3>
                <p class="text-slate-400 text-xs font-bold mt-1">Belum Absen</p>
            </div>

            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 render-stable">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-indigo-50 p-3 rounded-2xl text-indigo-600">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Total Jam Kerja</p>
                </div>
                <h3 class="text-3xl font-black text-slate-900">0 Jam</h3>
            </div>
        </div>

        <div class="bg-white p-12 rounded-[40px] border border-slate-200 shadow-sm text-center mb-12 render-stable">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <div class="w-24 h-24 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="map-pin" class="w-10 h-10"></i>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900">Lokasi Anda Terdeteksi</h4>
                    <p class="text-slate-500 font-medium">PT Batam Indonesia - Area Polibatam</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <button class="bg-indigo-600 text-white py-5 rounded-3xl font-black text-lg hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100">
                        ABSEN MASUK
                    </button>
                    <button disabled class="bg-slate-100 text-slate-400 py-5 rounded-3xl font-black text-lg cursor-not-allowed">
                        ABSEN PULANG
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-100 shadow-sm overflow-hidden render-stable">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-black text-slate-900">Riwayat Absensi</h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">7 Hari Terakhir</p>
                </div>
                <button class="text-indigo-600 font-bold text-sm hover:underline">Lihat Semua</button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Tanggal</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Shift</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Masuk</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Pulang</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-6 font-bold text-slate-700 text-sm">13 Mei 2026</td>
                            <td class="p-6">
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase rounded-lg border border-amber-100">Shift Pagi</span>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">08:06</td>
                            <td class="p-6 text-sm font-medium text-slate-300">-- : --</td>
                            <td class="p-6">
                                <span class="flex items-center text-emerald-500 font-bold text-[10px] uppercase tracking-wider">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span> Hadir
                                </span>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-6 font-bold text-slate-700 text-sm">12 Mei 2026</td>
                            <td class="p-6">
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase rounded-lg border border-blue-100">Shift Siang</span>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">14:00</td>
                            <td class="p-6 text-sm font-medium text-slate-600">22:05</td>
                            <td class="p-6">
                                <span class="flex items-center text-emerald-500 font-bold text-[10px] uppercase tracking-wider">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span> Hadir
                                </span>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-6 font-bold text-slate-700 text-sm">11 Mei 2026</td>
                            <td class="p-6">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase rounded-lg border border-indigo-100">Shift Malam</span>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">22:15</td>
                            <td class="p-6 text-sm font-medium text-slate-600">06:00</td>
                            <td class="p-6">
                                <span class="flex items-center text-rose-500 font-bold text-[10px] uppercase tracking-wider">
                                    <span class="w-2 h-2 bg-rose-500 rounded-full mr-2"></span> Terlambat
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Script jam digital dan penanggalan otomatis otomatis lokal browser
    function updateClock() {
        const now = new Date();
        
        // Update Jam (Format 24 Jam)
        const timeOptions = { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' };
        document.getElementById('liveClock').innerText = now.toLocaleTimeString('id-ID', timeOptions);
        
        // Update Tanggal Otomatis (jika tidak dijalankan lewat server Laravel)
        const dateElement = document.getElementById('liveDate');
        if (dateElement.innerText.includes('--')) {
            const dateOptions = { day: 'numeric', month: 'long', year: 'numeric' };
            dateElement.innerText = now.toLocaleDateString('id-ID', dateOptions);
        }
    }
    
    setInterval(updateClock, 1000);
    updateClock();

    // Memastikan icon Lucide ter-render jika dipanggil ulang
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
</body>
</html>