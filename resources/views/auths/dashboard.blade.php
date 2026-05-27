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
    <div class="space-y-8 p-2 pb-12">
        
        <div class="hardware-render-fix bg-indigo-600 p-10 rounded-[40px] shadow-2xl shadow-indigo-200 flex flex-col md:flex-row justify-between items-center gap-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="relative z-10">
                <h1 class="text-4xl font-black tracking-tight mb-2">Pusat Kontrol Real-time</h1>
                <p class="text-indigo-100 font-medium">Monitoring kehadiran karyawan secara akurat hari ini.</p>
            </div>
            <div class="bg-white/20 p-6 rounded-[32px] backdrop-blur-xl border border-white/30 text-center min-w-[180px] relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1">Total Karyawan</p>
                <p class="text-4xl font-black italic">{{ $stats['total_karyawan'] ?? '156' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="hardware-render-fix bg-white p-8 rounded-[35px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-3">Hadir Tepat Waktu</p>
                <h3 class="text-4xl font-black text-emerald-500 italic">{{ $stats['hadir'] ?? '120' }}</h3>
            </div>
            <div class="hardware-render-fix bg-white p-8 rounded-[35px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-3">Terlambat</p>
                <h3 class="text-4xl font-black text-rose-500 italic">10</h3>
            </div>
            <div class="hardware-render-fix bg-white p-8 rounded-[35px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-3">Izin/Cuti</p>
                <h3 class="text-4xl font-black text-amber-500 italic">5</h3>
            </div>
            <div class="hardware-render-fix bg-white p-8 rounded-[35px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-3">Belum Absen</p>
                <h3 class="text-4xl font-black text-slate-300 italic">21</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="hardware-render-fix lg:col-span-8 bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-black text-slate-800 flex items-center gap-3 italic">
                        <i data-lucide="bar-chart-3" class="text-indigo-600 w-6 h-6"></i> Statistik Mingguan
                    </h2>
                    <button onclick="downloadChart('weeklyChart')" class="p-3 bg-slate-50 hover:bg-indigo-50 text-slate-400 hover:text-indigo-600 rounded-2xl transition-all border border-slate-100 shadow-sm flex items-center gap-2 font-bold text-[10px] uppercase tracking-widest">
                        <i data-lucide="download" class="w-4 h-4"></i> Export PNG
                    </button>
                </div>
                <div class="relative h-[300px]">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>

            <div class="hardware-render-fix lg:col-span-4 bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm">
                <h2 class="font-black text-slate-800 mb-8 italic text-lg">Antrean Izin</h2>
                <div class="space-y-4">
                    <div class="p-6 bg-slate-50 rounded-[30px] border border-slate-100">
                        <p class="font-black text-slate-900 mb-1">Budi Santoso</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 italic">Sakit • 2 Hari</p>
                        <div class="flex gap-2">
                            <button class="flex-1 py-3 bg-indigo-600 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest shadow-lg shadow-indigo-100">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hardware-render-fix bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm">
            <h2 class="font-black text-slate-800 mb-8 flex items-center gap-3 italic">
                <i data-lucide="map-pin" class="text-rose-500 w-6 h-6"></i> Tracking Jangkauan (Politeknik Negeri Batam)
            </h2>
            <div class="map-container-isolated">
                <div id="map" class="rounded-3xl border border-slate-100"></div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 1. Chart Statistik
        const ctx = document.getElementById('weeklyChart');
        if(ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
                    datasets: [{
                        label: 'Hadir',
                        data: [140, 135, 145, 130, 148],
                        backgroundColor: '#4f46e5',
                        borderRadius: 12
                    }]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } } 
                }
            });
        }

        // 2. Map (Politeknik Negeri Batam)
        const mapDiv = document.getElementById('map');
        if(mapDiv) {
            const polyBatam = [1.1186, 104.0484];
            
            // scrollWheelZoom dimatikan agar scroll halaman tidak tersendat saat kursor mengenai area peta
            var map = L.map('map', {
                scrollWheelZoom: false 
            }).setView(polyBatam, 15);
            
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Marker Pusat
            L.marker(polyBatam).addTo(map)
                .bindPopup('<b>Kantor Pusat: Polibatam</b>')
                .openPopup();

            // Radius 5KM
            L.circle(polyBatam, {
                color: '#4f46e5',
                fillColor: '#4f46e5',
                fillOpacity: 0.1,
                radius: 5000 
            }).addTo(map).bindPopup('Jangkauan Absensi (5KM)');

            // Memaksa kalkulasi ulang dimensi peta agar layernya tidak pecah/geser
            setTimeout(() => {
                map.invalidateSize();
            }, 300);
        }
        
        // Refresh Icons lucide
        if (window.lucide) lucide.createIcons();
    });
</script>