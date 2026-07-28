<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan Panel | PresensiHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        #map { height: 350px; border-radius: 1.5rem; width: 100%; z-index: 10; }
        
        .sidebar-scroll::-webkit-scrollbar { width: 0px; background: transparent; }
        .sidebar-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        .transition-sidebar { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), padding 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <div class="flex min-h-screen w-full">
        
        {{-- Overlay Mobile --}}
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 z-30 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>
        
        {{-- SIDEBAR UTAMA --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-slate-950 border-r-2 border-slate-700 p-4 flex flex-col z-40 transition-sidebar sidebar-scroll lg:translate-x-0 transform -translate-x-full overflow-hidden">
            
            <div id="sidebar-header-box" class="mb-8 flex items-center justify-between p-2 w-full transition-all duration-300">
                <div class="flex items-center space-x-3 sidebar-text overflow-hidden">
                    <div class="bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-900/30 flex-shrink-0">
                        <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter target-sidebar-hide text-white whitespace-nowrap">Presensi<span class="text-blue-500">Hub</span></span>
                </div>
                
                <button onclick="toggleSidebar()" class="hidden lg:flex p-2 rounded-xl hover:bg-slate-900 text-slate-400 transition-all flex-shrink-0 cursor-pointer">
                    <i data-lucide="chevron-left" id="toggle-icon" class="w-5 h-5 transition-transform duration-300"></i>
                </button>
            </div>
            
            <nav id="sidebar-nav" class="space-y-1.5 flex-1 overflow-y-auto px-2 sidebar-scroll overflow-x-hidden">
                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3 px-2 target-sidebar-hide">Main Menu</div>
                
                <a href="/karyawan/dashboard" 
                   class="flex items-center space-x-3 p-4 {{ Request::is('*dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0 {{ Request::is('*dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide">Dashboard Absensi</span>
                </a>

                <a href="/karyawan/monitoring" 
                   class="flex items-center space-x-3 p-4 {{ Request::is('*monitoring') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="history" class="w-5 h-5 flex-shrink-0 {{ Request::is('*monitoring') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide">Riwayat Absensi</span>
                </a>

                <a href="/karyawan/izin" 
                   class="flex items-center space-x-3 p-4 {{ Request::is('*izin') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="file-text" class="w-5 h-5 flex-shrink-0 {{ Request::is('*izin') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide">Pengajuan Izin / Cuti</span>
                </a>

                <a href="/karyawan/profil" 
                   class="flex items-center space-x-3 p-4 {{ Request::is('*profil') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }} rounded-2xl font-bold transition-all group">
                    <i data-lucide="user" class="w-5 h-5 flex-shrink-0 {{ Request::is('*profil') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
                    <span class="target-sidebar-hide">Profil Saya</span>
                </a>
            </nav>

            <div class="pt-4 border-t border-slate-800 px-2 overflow-hidden flex-shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3.5 text-rose-500 hover:bg-rose-950/40 rounded-2xl transition-all font-bold group cursor-pointer">
                        <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0 text-rose-500"></i>
                        <span class="target-sidebar-hide">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN KONTEN UTAMA KANAN --}}
        <main id="main-content" class="flex-1 flex flex-col min-h-screen min-w-0 lg:pl-72 transition-sidebar">
            
            {{-- HEADER ATAS GLOBAL --}}
            <header class="bg-white border-b border-slate-200 px-4 py-4 flex items-center justify-between sticky top-0 z-30 sm:px-6 lg:px-12">
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()" class="p-2 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-all flex items-center space-x-2 px-3 cursor-pointer">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                        <span class="text-xs font-bold hidden sm:inline">Menu Sidebar</span>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right border-r border-slate-200 pr-4 hidden sm:block">
                        <p id="realtime-clock" class="text-lg font-black text-indigo-600 tracking-tighter">00:00:00</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name ?? 'Samuel Ambar Pasaribu' }}</p>
                    </div>
                </div>
            </header>

            {{-- AREA INJEKSI KONTEN HALAMAN --}}
            <div class="p-4 sm:p-6 lg:p-12 overflow-y-auto flex-1 space-y-6 w-full">
                
                {{-- Notifikasi Sukses / Gagal dari Laravel --}}
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-200 font-bold animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="p-4 mb-4 text-sm text-rose-800 rounded-2xl bg-rose-50 border border-rose-200 font-bold">
                        {{ session('error') }}
                    </div>
                @endif

                @if(Request::is('*dashboard'))
                    {{-- JIKA DI HALAMAN DASHBOARD UTAMA, TAMPILKAN ELEMEN INI --}}
                    <div class="bg-white border border-slate-200 rounded-3xl p-5 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-14 h-14 bg-blue-600 text-white rounded-full flex items-center justify-center font-black text-xl shadow-md flex-shrink-0">S</div>
                            <div class="min-w-0">
                                <h1 class="text-xl font-extrabold text-slate-900 truncate">{{ Auth::user()->name ?? 'Samuel Ambar Pasaribu' }}</h1>
                                <p class="text-xs text-slate-400 font-bold truncate">Staff Karyawan • <span id="txt-divisi" class="text-blue-600">IT & Teknologi</span></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-xs font-bold self-start sm:self-auto">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                            <span>GPS: <span id="status-gps" class="text-emerald-600">Mencari Lokasi...</span></span>
                        </div>
                    </div>

                    <!-- Hidden Form untuk mengirim data absensi ke Backend Laravel -->
                    <form id="form-absensi" action="{{ route('absensi.store') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" id="latitude" name="latitude" value="-">
                        <input type="hidden" id="longitude" name="longitude" value="-">
                        <input type="hidden" id="action-type" name="action" value="">
                    </form>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
                        <div class="border border-slate-200 rounded-3xl p-6 bg-white shadow-sm flex flex-col justify-between gap-6 min-w-0 h-full">
                            <div class="space-y-1.5">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider" id="txt-realtime-date">Hari Ini</p>
                                <h2 id="live-clock" class="text-4xl font-black text-slate-900 tracking-tighter break-words">00:00:00</h2>
                                <p class="text-[11px] font-bold text-slate-500">
                                    Jam Shift Kerja Masuk: <span id="shift-masuk" class="text-emerald-600 font-black">--:-- WIB</span><br>
                                    Jam Shift Kerja Pulang: <span id="shift-pulang" class="text-orange-600 font-black">--:-- WIB</span><br>
                                    Toleransi Keterlambatan: <span id="shift-toleransi" class="text-amber-600 font-black">-- Menit</span>
                                </p>
                            </div>
                            
                            <div class="flex flex-col gap-3 w-full mt-4">
                                <button type="button" onclick="prosesKlikAbsen('masuk')" class="w-full px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-2xl flex items-center justify-center gap-2 shadow-md shadow-emerald-600/10 cursor-pointer transition-all active:scale-[0.98]">
                                    <i class="fa-solid fa-circle-check text-lg"></i> <span>Check In Masuk</span>
                                </button>
                                <button type="button" onclick="prosesKlikAbsen('pulang')" class="w-full px-6 py-4 bg-rose-600 hover:bg-rose-700 text-white font-extrabold rounded-2xl flex items-center justify-center gap-2 shadow-md shadow-rose-600/10 cursor-pointer transition-all active:scale-[0.98]">
                                    <i class="fa-solid fa-circle-xmark text-lg"></i> <span>Check Out Pulang</span>
                                </button>
                            </div>
                        </div>

                        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-3xl p-4 shadow-sm flex flex-col justify-between min-w-0 h-full">
                            <div class="text-xs font-bold text-slate-500 mb-2 flex items-center gap-2 px-2 pt-1">
                                <i class="fa-solid fa-map-location-dot text-blue-600"></i> Titik Geolocation Anda
                            </div>
                            <div id="map" class="flex-1"></div>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
                            <h3 class="font-extrabold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-calendar-days text-blue-600"></i> Kalender Rekap Bulanan
                            </h3>
                            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto justify-end">
                                <select id="filter-bulan" onchange="handlerFilterKalender()" class="bg-slate-50 border border-slate-200 text-slate-800 text-xs font-bold rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                    <option value="0">Januari</option>
                                    <option value="1">Februari</option>
                                    <option value="2">Maret</option>
                                    <option value="3">April</option>
                                    <option value="4">Mei</option>
                                    <option value="5">Juni</option>
                                    <option value="6">Juli</option>
                                    <option value="7">Agustus</option>
                                    <option value="8">September</option>
                                    <option value="9">Oktober</option>
                                    <option value="10">November</option>
                                    <option value="11">Desember</option>
                                </select>
                                <select id="filter-tahun" onchange="handlerFilterKalender()" class="bg-slate-50 border border-slate-200 text-slate-800 text-xs font-bold rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer"></select>
                                <div class="flex items-center bg-slate-100 p-1 rounded-xl border gap-0.5 ml-2">
                                    <button onclick="gantiBulan(-1)" class="p-1.5 rounded-lg hover:bg-white text-slate-700 transition-all cursor-pointer text-xs font-bold"><i class="fa-solid fa-angle-left"></i></button>
                                    <button onclick="gantiBulan(1)" class="p-1.5 rounded-lg hover:bg-white text-slate-700 transition-all cursor-pointer text-xs font-bold"><i class="fa-solid fa-angle-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-7 gap-2 text-center font-bold text-xs" id="grid-kalender-box"></div>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 text-center">
                            <h4 id="box-hadir" class="text-3xl font-black text-emerald-600">0</h4>
                            <p class="text-[10px] uppercase font-bold text-emerald-500">Hadir</p>
                        </div>
                        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 text-center">
                            <h4 id="box-telat" class="text-3xl font-black text-amber-600">0</h4>
                            <p class="text-[10px] uppercase font-bold text-amber-500">Terlambat</p>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 text-center">
                            <h4 id="box-izin" class="text-3xl font-black text-blue-600">0</h4>
                            <p class="text-[10px] uppercase font-bold text-blue-500">Izin / Sakit</p>
                        </div>
                        <div class="bg-rose-50 border border-rose-100 rounded-2xl p-4 text-center">
                            <h4 id="box-alpha" class="text-3xl font-black text-rose-600">0</h4>
                            <p class="text-[10px] uppercase font-bold text-rose-500">Alpha</p>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
                        <div class="p-4 border-b font-bold text-slate-800 text-sm">Log Aktivitas Rekap Bulan Ini</div>
                        <div class="p-4 divide-y divide-slate-100" id="list-log-terbaru"></div>
                    </div>
                @endif

                {{-- TEMPAT HALAMAN DINAMIS (PROFIL / IZIN) MUNCUL --}}
                @yield('karyawan_content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour12: false });
            if(document.getElementById('realtime-clock')) document.getElementById('realtime-clock').textContent = timeStr;
            if(document.getElementById('live-clock')) document.getElementById('live-clock').textContent = timeStr;
        }
        setInterval(updateClock, 1000);
        updateClock();

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleIcon = document.getElementById('toggle-icon');
            const overlay = document.getElementById('sidebar-overlay');
            const hiddenElements = document.querySelectorAll('.target-sidebar-hide');
            
            if (window.innerWidth < 1024) {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.add('opacity-100'), 50);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                }
            } else {
                if (sidebar.classList.contains('w-72')) {
                    sidebar.classList.remove('w-72');
                    sidebar.classList.add('w-20', 'px-2'); 
                    mainContent.classList.remove('lg:pl-72');
                    mainContent.classList.add('lg:pl-20');
                    if(toggleIcon) toggleIcon.style.transform = 'rotate(180deg)';
                    hiddenElements.forEach(el => el.classList.add('hidden'));
                } else {
                    sidebar.classList.remove('w-20', 'px-2');
                    sidebar.classList.add('w-72');
                    mainContent.classList.remove('lg:pl-20');
                    mainContent.classList.add('lg:pl-72');
                    if(toggleIcon) toggleIcon.style.transform = 'rotate(0deg)';
                    hiddenElements.forEach(el => el.classList.remove('hidden'));
                }
            }
        }

        // PERBAIKAN UTAMA: Pencocokan shift cerdas berdasarkan waktu aktif saat ini
        function sinkronisasiJadwalKerja() {
            const labelDivisi = document.getElementById('txt-divisi');
            const targetMasuk = document.getElementById('shift-masuk');
            const targetPulang = document.getElementById('shift-pulang');
            const targetToleransi = document.getElementById('shift-toleransi');

            if (!targetMasuk || !targetPulang) return;

            let namaDivisiKaryawan = labelDivisi ? labelDivisi.textContent.trim() : 'IT & Teknologi';
            namaDivisiKaryawan = namaDivisiKaryawan.replace(/&amp;/g, '&');
            
            const savedSchedules = localStorage.getItem('schedulesData');
            
            // Aturan default cadangan jika tidak ada jadwal di database
            let jamMasukHasil = "08:00"; 
            let jamPulangHasil = "15:00"; 
            let toleransiHasil = 15;

            if (savedSchedules) {
                const listJadwal = JSON.parse(savedSchedules);
                
                // Cari semua jadwal yang cocok dengan divisi karyawan ini
                const jadwalDivisi = listJadwal.filter(item => 
                    item.divisi.replace(/\s+/g, ' ').trim().toLowerCase() === 
                    namaDivisiKaryawan.replace(/\s+/g, ' ').trim().toLowerCase()
                );
                
                if (jadwalDivisi.length > 0) {
                    const jamSekarang = new Date();
                    const jamSekarangMenit = jamSekarang.getHours() * 60 + jamSekarang.getMinutes();

                    let jadwalTerdekat = jadwalDivisi[0];
                    let selisihTerkecil = Infinity;

                    // Lakukan pencarian shift terdekat dari jam saat ini
                    jadwalDivisi.forEach(jadwal => {
                        const [jM, mM] = jadwal.jam_masuk.split(':').map(Number);
                        const jamMasukMenit = jM * 60 + mM;

                        // Hitung jarak waktu absolut
                        let selisih = Math.abs(jamSekarangMenit - jamMasukMenit);
                        if (selisih < selisihTerkecil) {
                            selisihTerkecil = selisih;
                            jadwalTerdekat = jadwal;
                        }
                    });

                    jamMasukHasil = jadwalTerdekat.jam_masuk;
                    jamPulangHasil = jadwalTerdekat.jam_pulang;
                    toleransiHasil = jadwalTerdekat.toleransi !== undefined ? jadwalTerdekat.toleransi : 15;
                }
            }

            // Render ke UI Halaman
            targetMasuk.innerHTML = jamMasukHasil.substring(0, 5) + " WIB";
            targetPulang.innerHTML = jamPulangHasil.substring(0, 5) + " WIB";
            if (targetToleransi) {
                targetToleransi.innerHTML = toleransiHasil + " Menit";
            }
        }

        function prosesKlikAbsen(tipe) {
            const lat = document.getElementById('latitude').value;
            const lng = document.getElementById('longitude').value;

            if (lat === "-" || lng === "-") {
                alert("Gagal melakukan absensi! Lokasi GPS Anda belum terdeteksi. Pastikan izin lokasi browser Anda aktif.");
                return;
            }

            if (confirm("Apakah Anda yakin ingin melakukan Absen " + tipe + " sekarang?")) {
                document.getElementById('action-type').value = tipe;
                document.getElementById('form-absensi').submit();
            }
        }

        @if(session('log_data'))
            (function() {
                let currentRecords = localStorage.getItem('monitoringRecords') ? JSON.parse(localStorage.getItem('monitoringRecords')) : [];
                if(!Array.isArray(currentRecords)) {
                    currentRecords = [];
                }

                const tanggalMatang = "{{ session('log_data.tanggal_teks') }}";

                const newLog = {
                    tanggal: tanggalMatang, 
                    nama: "{{ session('log_data.nama') }}",
                    divisi: "{{ session('log_data.divisi') }}",
                    jam_masuk: "{{ session('log_data.jam_masuk') }}",
                    jam_pulang: "{{ session('log_data.jam_pulang') }}",
                    lokasi: "{{ session('log_data.lokasi') }}",
                    status: "{{ session('log_data.status') }}"
                };

                if(newLog.jam_pulang !== '-') {
                    let indexHariIni = currentRecords.findIndex(r => r.nama === newLog.nama && r.tanggal === newLog.tanggal);
                    if(indexHariIni !== -1) {
                        currentRecords[indexHariIni].jam_pulang = newLog.jam_pulang;
                    } else {
                        currentRecords.unshift(newLog);
                    }
                } else {
                    currentRecords.unshift(newLog);
                }

                localStorage.setItem('monitoringRecords', JSON.stringify(currentRecords));
            })();
        @endif

        let tanggalSistemMasehi = new Date();
        let tahunKalenderAktif = tanggalSistemMasehi.getFullYear();
        let bulanKalenderAktif = tanggalSistemMasehi.getMonth(); 

        function populateYearFilter() {
            const selectTahun = document.getElementById('filter-tahun');
            if(selectTahun) {
                selectTahun.innerHTML = '';
                for(let i = tahunKalenderAktif - 5; i <= tahunKalenderAktif + 1; i++) {
                    let opt = document.createElement('option');
                    opt.value = i; opt.textContent = i;
                    if(i === tahunKalenderAktif) opt.selected = true;
                    selectTahun.appendChild(opt);
                }
            }
        }

        function buatUlangKomponenDashboard() {
            if (!document.getElementById('grid-kalender-box')) return;
            
            const records = JSON.parse(localStorage.getItem('monitoringRecords')) || [];
            let countHadir = 0; let countTelat = 0;

            records.forEach(item => { 
                if(item.nama === "{{ Auth::user()->name ?? 'Samuel Ambar Pasaribu' }}") {
                    if(item.status === 'Hadir') countHadir++;
                    if(item.status === 'Terlambat') countTelat++;
                }
            });

            if(document.getElementById('box-hadir')) document.getElementById('box-hadir').textContent = countHadir;
            if(document.getElementById('box-telat')) document.getElementById('box-telat').textContent = countTelat;

            const box = document.getElementById('grid-kalender-box');
            box.innerHTML = '';
            const namaHari = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
            namaHari.forEach(nh => { box.innerHTML += `<div class="text-slate-400 font-bold py-1">${nh}</div>`; });

            let firstDayIndex = new Date(tahunKalenderAktif, bulanKalenderAktif, 1).getDay();
            for (let s = 0; s < firstDayIndex; s++) { box.innerHTML += `<div></div>`; }

            let jumlahHariMaksimal = new Date(tahunKalenderAktif, bulanKalenderAktif + 1, 0).getDate();
            for(let d = 1; d <= jumlahHariMaksimal; d++) {
                let isHariIniSistem = (d === tanggalSistemMasehi.getDate() && bulanKalenderAktif === tanggalSistemMasehi.getMonth() && tahunKalenderAktif === tanggalSistemMasehi.getFullYear());
                let aktifBorder = isHariIniSistem ? "border-2 border-blue-500 bg-blue-50 font-black text-blue-600 shadow-sm" : "border border-slate-100 text-slate-700";
                box.innerHTML += `<div class="p-2 rounded-xl ${aktifBorder}">${d}</div>`;
            }
        }

        // PENGATURAN EVENT UTAMA
        document.addEventListener("DOMContentLoaded", function () {
            populateYearFilter();
            buatUlangKomponenDashboard();

            // Jalankan sinkronisasi jadwal langsung saat halaman dimuat
            sinkronisasiJadwalKerja();

            const skrg = new Date();
            const dateTxt = document.getElementById('txt-realtime-date');
            if (dateTxt) dateTxt.textContent = skrg.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });

            if (document.getElementById('map')) {
                var defaultLat = 1.041523; 
                var defaultLng = 103.968767;

                var map = L.map('map').setView([defaultLat, defaultLng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                var marker = L.marker([defaultLat, defaultLng]).addTo(map).bindPopup('Lokasi Kantor').openPopup();

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        map.setView([lat, lng], 16);
                        marker.setLatLng([lat, lng]).setPopupContent('Lokasi Anda Terdeteksi').openPopup();
                        
                        var latInp = document.getElementById('latitude');
                        var lngInp = document.getElementById('longitude');
                        var gpsSts = document.getElementById('status-gps');

                        if(latInp) latInp.value = lat;
                        if(lngInp) lngInp.value = lng;
                        if(gpsSts) gpsSts.textContent = "Terdeteksi Aktif";
                        
                        buatUlangKomponenDashboard();
                    }, function(error) {
                        var gpsSts = document.getElementById('status-gps');
                        if(gpsSts) gpsSts.textContent = "Izin GPS Ditolak";
                    });
                }
            }
        });
    </script>
</body>
</html>