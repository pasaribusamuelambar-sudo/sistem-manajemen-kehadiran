<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Absensi | PresensiHub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-900 p-4 md:p-6">

    <div class="space-y-6 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white border border-slate-200 rounded-3xl p-5 md:p-6 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg md:text-xl font-black text-slate-900 flex items-center gap-2">
                    <i data-lucide="monitor" class="text-blue-600 w-5 h-5 md:w-6 md:h-6"></i> Monitoring Presensi Karyawan
                </h2>
                <p class="text-[11px] md:text-xs text-slate-400 font-bold mt-1">Pantau data kehadiran check-in dan check-out masuk-pulang secara realtime</p>
            </div>
            <button onclick="resetDataLog()" class="w-full sm:w-auto px-4 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs rounded-xl transition-all cursor-pointer text-center">
                Reset Semua Log Absen
            </button>
        </div>

        <!-- Filter Card -->
        <div class="bg-white border border-slate-200 rounded-3xl p-4 md:p-5 shadow-sm space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4 items-center">
                <div class="relative md:col-span-2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="search-input" oninput="renderLiveMonitoring()" placeholder="Cari berdasarkan nama karyawan atau divisi..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-semibold focus:outline-none focus:border-blue-500 transition-all">
                </div>
                <div>
                    <select id="status-filter" onchange="renderLiveMonitoring()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-700 focus:outline-none focus:border-blue-500 transition-all">
                        <option value="Semua">-- Semua Status Kehadiran --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Terlambat">Terlambat</option>
                        <option value="Izin">Izin / Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>
            </div>

            <div class="border-t border-slate-100 my-2"></div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4">
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5 pl-1">Spesifik Tanggal</label>
                    <select id="filter-tanggal" onchange="renderLiveMonitoring()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-700 focus:outline-none focus:border-blue-500 transition-all cursor-pointer">
                        <option value="Semua">-- Semua Tanggal --</option>
                    </select>
                </div>

                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5 pl-1">Pilih Bulan</label>
                    <select id="filter-bulan" onchange="handleBulanTahunChange()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-700 focus:outline-none focus:border-blue-500 transition-all cursor-pointer">
                        <option value="Semua">-- Semua Bulan --</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>

                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5 pl-1">Pilih Tahun</label>
                    <select id="filter-tahun" onchange="handleBulanTahunChange()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-700 focus:outline-none focus:border-blue-500 transition-all cursor-pointer">
                        <option value="Semua">-- Semua Tahun --</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Data Container (Table for Desktop, Cards for Mobile) -->
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
            
            <!-- Tampilan Desktop (Tabel) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase font-bold border-b border-slate-100">
                            <th class="p-4">Tanggal Log</th>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">Divisi</th>
                            <th class="p-4">Jam Check-In</th>
                            <th class="p-4">Jam Check-Out</th>
                            <th class="p-4">Titik Koordinat GPS</th>
                            <th class="p-4">Status Akhir</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-monitor-body" class="divide-y divide-slate-100 font-medium text-slate-700">
                        <!-- Data Desktop di-render di sini -->
                    </tbody>
                </table>
            </div>

            <!-- Tampilan Mobile (List Card) -->
            <div id="mobile-monitor-cards" class="block md:hidden p-4 space-y-4">
                <!-- Data Mobile di-render di sini -->
            </div>

        </div>
    </div>

    <script>
        lucide.createIcons();

        const namaBulanIndo = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // 1. MEMBUAT FILTER TAHUN DINAMIS
        function siapkanOpsiTahun() {
            const selectTahun = document.getElementById('filter-tahun');
            const tahunSekarang = new Date().getFullYear();
            let daftarTahun = new Set();

            const tahunAwalSistem = 2024;
            for (let y = tahunAwalSistem; y <= tahunSekarang + 3; y++) {
                daftarTahun.add(y);
            }

            const records = JSON.parse(localStorage.getItem('monitoringRecords')) || [];
            records.forEach(r => {
                let tgl = r.tanggal || '';
                let tahunDitemukan = null;

                if (tgl.includes('-')) {
                    tahunDitemukan = parseInt(tgl.split('-')[0]);
                } else {
                    let parts = tgl.split(' ');
                    if (parts.length === 3) {
                        tahunDitemukan = parseInt(parts[2]);
                    }
                }

                if (tahunDitemukan && !isNaN(tahunDitemukan)) {
                    daftarTahun.add(tahunDitemukan);
                }
            });

            const sortedYears = Array.from(daftarTahun).sort((a, b) => b - a);

            selectTahun.innerHTML = '<option value="Semua">-- Semua Tahun --</option>';
            sortedYears.forEach(thn => {
                let opt = document.createElement('option');
                opt.value = thn;
                opt.textContent = thn;
                selectTahun.appendChild(opt);
            });
        }

        // 2. DETEKSI OTOMATIS JUMLAH HARI
        function perbaruiOpsiTanggal() {
            const selectTanggal = document.getElementById('filter-tanggal');
            const selectBulan = document.getElementById('filter-bulan');
            const selectTahun = document.getElementById('filter-tahun');

            const bulanTerpilih = selectBulan.value;
            const tahunTerpilih = selectTahun.value;
            const tanggalTerpilihSebelumnya = selectTanggal.value;

            selectTanggal.innerHTML = '<option value="Semua">-- Semua Tanggal --</option>';
            let batasHari = 31;

            if (bulanTerpilih !== 'Semua') {
                const indexBulan = namaBulanIndo.indexOf(bulanTerpilih);
                const tahunAcuan = tahunTerpilih !== 'Semua' ? parseInt(tahunTerpilih) : new Date().getFullYear();
                batasHari = new Date(tahunAcuan, indexBulan + 1, 0).getDate();
            }

            for (let i = 1; i <= batasHari; i++) {
                let opt = document.createElement('option');
                let val = i < 10 ? '0' + i : '' + i;
                opt.value = val;
                opt.textContent = i;
                
                if (val === tanggalTerpilihSebelumnya) {
                    opt.selected = true;
                }
                selectTanggal.appendChild(opt);
            }
        }

        function handleBulanTahunChange() {
            perbaruiOpsiTanggal();
            renderLiveMonitoring();
        }

        // 3. PROSES PENYARINGAN & RENDERING (DUAL VIEW: DESKTOP & MOBILE)
        function renderLiveMonitoring() {
            const tBody = document.getElementById('tabel-monitor-body');
            const mCards = document.getElementById('mobile-monitor-cards');
            const records = JSON.parse(localStorage.getItem('monitoringRecords')) || [];

            const searchQuery = document.getElementById('search-input').value.toLowerCase().trim();
            const statusFilter = document.getElementById('status-filter').value;
            const tglFilter = document.getElementById('filter-tanggal').value;
            const blnFilter = document.getElementById('filter-bulan').value;
            const thnFilter = document.getElementById('filter-tahun').value;

            const filteredRecords = records.filter(r => {
                let tanggalTeks = r.tanggal || '';
                let dataTgl = "";
                let dataBlnTeks = "";
                let dataThn = "";

                if (tanggalTeks.includes('-')) {
                    const parts = tanggalTeks.split('-');
                    if (parts.length === 3) {
                        dataThn = parts[0];
                        let blnNum = parseInt(parts[1]) - 1;
                        dataBlnTeks = namaBulanIndo[blnNum] || "";
                        dataTgl = parseInt(parts[2]).toString().padStart(2, '0');
                    }
                } else {
                    const parts = tanggalTeks.split(' ');
                    if (parts.length === 3) {
                        dataTgl = parseInt(parts[0]).toString().padStart(2, '0');
                        dataBlnTeks = parts[1];
                        dataThn = parts[2];
                    }
                }

                const matchQuery = (r.nama && r.nama.toLowerCase().includes(searchQuery)) || 
                                   (r.divisi && r.divisi.toLowerCase().includes(searchQuery));
                
                const matchStatus = (statusFilter === 'Semua') || (r.status === statusFilter);
                const matchTanggal = (tglFilter === 'Semua') || (dataTgl === tglFilter);
                const matchBulan = (blnFilter === 'Semua') || (dataBlnTeks.toLowerCase() === blnFilter.toLowerCase());
                const matchTahun = (thnFilter === 'Semua') || (dataThn === thnFilter);

                return matchQuery && matchStatus && matchTanggal && matchBulan && matchTahun;
            });

            // State: Jika Data Kosong Sama Sekali
            if(records.length === 0) {
                const emptyState = `
                    <div class="p-8 text-center text-slate-400 font-bold text-xs">
                        Belum ada aktivitas presensi masuk ataupun pulang terekam dari sisi panel karyawan.
                    </div>`;
                tBody.innerHTML = `<tr><td colspan="7">${emptyState}</td></tr>`;
                mCards.innerHTML = emptyState;
                return;
            }

            // State: Jika Data yang Difilter Tidak Ditemukan
            if(filteredRecords.length === 0) {
                const noResultState = `
                    <div class="p-8 text-center text-slate-400 font-bold bg-slate-50/50 text-xs">
                        Data yang Anda cari tidak ditemukan dengan filter tersebut.
                    </div>`;
                tBody.innerHTML = `<tr><td colspan="7">${noResultState}</td></tr>`;
                mCards.innerHTML = noResultState;
                return;
            }

            // Reset wadah data
            tBody.innerHTML = '';
            mCards.innerHTML = '';

            filteredRecords.forEach(r => {
                // Konfigurasi Badge Status
                let badgeStyle = "bg-emerald-100 text-emerald-700";
                if(r.status === 'Terlambat') badgeStyle = "bg-amber-100 text-amber-700";
                if(r.status === 'Izin') badgeStyle = "bg-blue-100 text-blue-700";
                if(r.status === 'Alpha') badgeStyle = "bg-rose-100 text-rose-700";

                // Konfigurasi Link Maps GPS
                let linkMaps = "-";
                if(r.lokasi && r.lokasi !== "Lokasi Tidak Diizinkan" && r.lokasi !== "-") {
                    linkMaps = `<a href="https://maps.google.com/?q=${r.lokasi}" target="_blank" class="text-blue-600 hover:underline font-semibold flex items-center gap-1">
                                    <i class="fa-solid fa-map-location-dot"></i> ${r.lokasi}
                                </a>`;
                } else {
                    linkMaps = `<span class="text-slate-400 italic">${r.lokasi || 'Tanpa Lokasi'}</span>`;
                }

                let formatTanggalClean = r.tanggal;
                if (!isNaN(formatTanggalClean) && formatTanggalClean !== '') {
                    formatTanggalClean = `${r.tanggal} Juli 2026`; 
                }

                let jamMasuk = r.jam_masuk || '-';
                let jamPulang = r.jam_pulang || '-';

                // 1. Render Tampilan Desktop (Baris Tabel)
                tBody.innerHTML += `
                    <tr class="hover:bg-slate-50/50 transition-all">
                        <td class="p-4 font-bold text-slate-900">${formatTanggalClean}</td>
                        <td class="p-4 font-bold text-slate-800">${r.nama}</td>
                        <td class="p-4 text-slate-500">${r.divisi || '-'}</td>
                        <td class="p-4 text-emerald-600 font-bold font-mono">${jamMasuk}</td>
                        <td class="p-4 text-orange-600 font-bold font-mono">${jamPulang}</td>
                        <td class="p-4">${linkMaps}</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase ${badgeStyle}">${r.status}</span>
                        </td>
                    </tr>`;

                // 2. Render Tampilan Mobile (Sistem Card)
                mCards.innerHTML += `
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 space-y-3 relative overflow-hidden">
                        <!-- Header Card: Nama & Status Badge -->
                        <div class="flex justify-between items-start gap-2">
                            <div>
                                <h4 class="font-black text-slate-800 text-sm">${r.nama}</h4>
                                <p class="text-[10px] text-slate-400 font-semibold">${r.divisi || '-'} • ${formatTanggalClean}</p>
                            </div>
                            <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase ${badgeStyle}">${r.status}</span>
                        </div>

                        <hr class="border-dashed border-slate-200">

                        <!-- Detail Waktu -->
                        <div class="grid grid-cols-2 gap-2 text-[11px]">
                            <div>
                                <span class="text-slate-400 block font-bold text-[9px] uppercase">Jam Check-In</span>
                                <span class="text-emerald-600 font-bold font-mono text-xs">${jamMasuk}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-bold text-[9px] uppercase">Jam Check-Out</span>
                                <span class="text-orange-600 font-bold font-mono text-xs">${jamPulang}</span>
                            </div>
                        </div>

                        <!-- GPS -->
                        <div class="pt-1">
                            <span class="text-slate-400 block font-bold text-[9px] uppercase mb-0.5">Koordinat GPS</span>
                            <div class="text-[11px] truncate">${linkMaps}</div>
                        </div>
                    </div>`;
            });
        }

        function resetDataLog() {
            if(confirm('Apakah Anda yakin ingin menghapus bersih seluruh log monitoring?')) {
                localStorage.removeItem('monitoringRecords');
                document.getElementById('search-input').value = '';
                document.getElementById('status-filter').value = 'Semua';
                document.getElementById('filter-tanggal').value = 'Semua';
                document.getElementById('filter-bulan').value = 'Semua';
                document.getElementById('filter-tahun').value = 'Semua';
                
                siapkanOpsiTahun();
                perbaruiOpsiTanggal();
                renderLiveMonitoring();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            siapkanOpsiTahun();       
            perbaruiOpsiTanggal();   
            renderLiveMonitoring();  
        });
    </script>
</body>
</html>