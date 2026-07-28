<style>
    /* Mengunci area dashboard agar memiliki scrollbar mandiri tanpa merusak Sidebar/Navbar luar */
    .dashboard-viewport-wrapper {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: calc(100vh - 110px); /* Menyesuaikan perkiraan tinggi Navbar atas agar pas di layar */
        overflow-y: auto;             /* Scroll hanya terjadi di dalam kontainer ini */
        overflow-x: hidden;
        padding-right: 4px;           /* Ruang aman untuk scrollbar */
        scroll-behavior: smooth;
        background-color: #f8fafc;    /* Background abu-abu sangat muda sesuai gambar */
    }

    /* Kustomisasi scrollbar agar terlihat modern dan tipis */
    .dashboard-viewport-wrapper::-webkit-scrollbar {
        width: 6px;
    }
    .dashboard-viewport-wrapper::-webkit-scrollbar-track {
        background: transparent;
    }
    .dashboard-viewport-wrapper::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 20px;
    }

    /* Memastikan map Leaflet tetap berada di layer bawah dan ukurannya terkunci */
    .map-container-isolated {
        position: relative;
        width: 100%;
        clear: both;
    }

    #map {
        width: 100% !important;
        height: 400px !important;
        z-index: 1 !important; /* Mencegah Leaflet menutupi dropdown navbar atau modal */
    }

    /* Mengatasi bug flickering/melayang pada browser Chromium saat di-scroll */
    .hardware-render-fix {
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
    }
</style>

<div class="dashboard-viewport-wrapper">
    <div class="space-y-6 p-6 pb-12">
        
        <div class="space-y-1">
            <h1 class="text-xl font-bold text-slate-800">Dashboard Admin</h1>
            <p id="current-date" class="text-sm text-slate-500 font-medium">Memuat tanggal...</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                <div class="space-y-2">
                    <p class="text-slate-500 text-sm font-medium">Total Karyawan</p>
                    <h3 class="text-4xl font-bold text-slate-900 tracking-tight">{{ $stats['total_karyawan'] ?? '6' }}</h3>
                    <p class="text-xs text-slate-400">6 terdaftar</p>
                </div>
                <div class="p-3 bg-blue-600 text-white rounded-xl shadow-md shadow-blue-100">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                <div class="space-y-2">
                    <p class="text-slate-500 text-sm font-medium">Hadir Hari Ini</p>
                    <h3 class="text-4xl font-bold text-slate-900 tracking-tight">{{ $stats['hadir'] ?? '0' }}</h3>
                    <p class="text-xs text-slate-400">dari 6 karyawan</p>
                </div>
                <div class="p-3 bg-emerald-500 text-white rounded-xl shadow-md shadow-emerald-100">
                    <i data-lucide="user-check" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                <div class="space-y-2">
                    <p class="text-slate-500 text-sm font-medium">Terlambat</p>
                    <h3 class="text-4xl font-bold text-slate-900 tracking-tight">0</h3>
                    <p class="text-xs text-slate-400">hari ini</p>
                </div>
                <div class="p-3 bg-amber-500 text-white rounded-xl shadow-md shadow-amber-100">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                <div class="space-y-2">
                    <p class="text-slate-500 text-sm font-medium">Alpha</p>
                    <h3 class="text-4xl font-bold text-slate-900 tracking-tight">0</h3>
                    <p class="text-xs text-slate-400">tidak hadir</p>
                </div>
                <div class="p-3 bg-rose-500 text-white rounded-xl shadow-md shadow-rose-100">
                    <i data-lucide="user-x" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col min-h-[350px]">
                <h2 class="font-bold text-slate-800 text-base flex items-center gap-2 mb-6">
                    <i data-lucide="clock" class="text-blue-600 w-5 h-5"></i> Absensi Hari Ini
                </h2>
                <div class="flex-1 flex items-center justify-center">
                    <p class="text-slate-400 font-medium text-sm">Belum ada absensi hari ini</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col min-h-[350px]">
                <h2 class="font-bold text-slate-800 text-base flex items-center gap-2 mb-4">
                    <i data-lucide="file-text" class="text-blue-600 w-5 h-5"></i> Pengajuan Izin Terbaru
                </h2>
                
                <div class="divide-y divide-slate-100 flex-1">
                    <div class="py-3.5 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Samuel Ambar Pasaribu</p>
                            <p class="text-xs text-slate-400 mt-0.5">cuti game · 26 May - 27 May</p>
                        </div>
                        <span class="px-3 py-1 bg-amber-50 text-amber-600 text-xs font-semibold rounded-full border border-amber-200/50">
                            menunggu
                        </span>
                    </div>

                    <div class="py-3.5 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Ahmad Fauzi</p>
                            <p class="text-xs text-slate-400 mt-0.5">Cuti Sakit · 26 May - 27 May</p>
                        </div>
                        <span class="px-3 py-1 bg-amber-50 text-amber-600 text-xs font-semibold rounded-full border border-amber-200/50">
                            menunggu
                        </span>
                    </div>

                    <div class="py-3.5 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Dewi Lestari</p>
                            <p class="text-xs text-slate-400 mt-0.5">Cuti Tahunan · 27 May - 29 May</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-semibold rounded-full border border-emerald-200/50">
                            disetujui
                        </span>
                    </div>

                    <div class="py-3.5 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Rina Wulandari</p>
                            <p class="text-xs text-slate-400 mt-0.5">Cuti Sakit · 25 May - 26 May</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-semibold rounded-full border border-emerald-200/50">
                            disetujui
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="hardware-render-fix lg:col-span-8 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h2 class="font-bold text-slate-800 text-base mb-4 flex items-center gap-2">
                    <i data-lucide="map-pin" class="text-rose-500 w-5 h-5"></i> Tracking Jangkauan (Politeknik Negeri Batam)
                </h2>
                <div class="map-container-isolated">
                    <div id="map" class="rounded-xl border border-slate-100"></div>
                </div>
            </div>

            <div class="hardware-render-fix lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-slate-800 text-base flex items-center gap-2">
                            <i data-lucide="bar-chart-3" class="text-blue-600 w-5 h-5"></i> Statistik Mingguan
                        </h2>
                        <button onclick="downloadChart('weeklyChart')" class="p-1.5 bg-slate-50 hover:bg-blue-50 text-slate-400 hover:text-blue-600 rounded-lg transition-all border border-slate-100">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="relative h-[250px] w-full">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- FITUR UPDATE TANGGAL OTOMATIS ---
        function updateDashboardDate() {
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                const now = new Date();
                
                // Opsi penanggalan bahasa Indonesia lengkap (Hari, Tanggal Bulan Tahun)
                const options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                };
                
                // Format tanggal menggunakan locale ID (Indonesia)
                const formattedDate = now.toLocaleDateString('id-ID', options);
                
                // Ubah teks DOM secara realtime
                dateElement.textContent = formattedDate;
            }
        }
        
        // Jalankan fungsi sesaat setelah dashboard dimuat
        updateDashboardDate();


        // 1. Chart Statistik Mingguan
        const ctx = document.getElementById('weeklyChart');
        if(ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
                    datasets: [{
                        label: 'Hadir',
                        data: [6, 5, 6, 4, 6],
                        backgroundColor: '#2563eb',
                        borderRadius: 6,
                        barThickness: 20
                    }]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        }

        // 2. Map (Politeknik Negeri Batam)
        const mapDiv = document.getElementById('map');
        if(mapDiv) {
            const polyBatam = [1.1186, 104.0484];
            
            var map = L.map('map', {
                scrollWheelZoom: false 
            }).setView(polyBatam, 13);
            
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Marker Kantor Pusat
            L.marker(polyBatam).addTo(map)
                .bindPopup('<b>Kantor Pusat: Polibatam</b>')
                .openPopup();

            // Radius 5KM
            L.circle(polyBatam, {
                color: '#2563eb',
                fillColor: '#2563eb',
                fillOpacity: 0.1,
                radius: 5000 
            }).addTo(map).bindPopup('Jangkauan Absensi (5KM)');

            // Mengatasi bug layer pecah saat dirender di dalam kontainer flex/scroll
            setTimeout(() => {
                map.invalidateSize();
            }, 300);
        }
        
        // Inisialisasi ulang icon Lucide agar berjalan lancar
        if (window.lucide) lucide.createIcons();
    });
</script>