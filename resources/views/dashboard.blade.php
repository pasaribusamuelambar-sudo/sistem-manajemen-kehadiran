<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 300px; border-radius: 0.75rem; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-900">

<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-900 text-white hidden md:flex flex-col shadow-xl">
        <div class="p-6 text-center font-bold text-xl tracking-widest border-b border-gray-800">
            CONTROL CENTER
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="flex items-center space-x-3 p-3 bg-gray-800 text-blue-400 rounded-lg">
                <i class="bi bi-house-door"></i> <span>Dashboard</span>
            </a>
            
            <div class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-500 uppercase">Data Master</div>
            <a href="#" class="flex items-center space-x-3 p-3 hover:bg-gray-800 rounded-lg transition">
                <i class="bi bi-people"></i> <span>Kelola Karyawan</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 hover:bg-gray-800 rounded-lg transition">
                <i class="bi bi-building"></i> <span>Kelola Divisi</span>
            </a>

            <div class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-500 uppercase">Laporan</div>
            <a href="#" class="flex items-center space-x-3 p-3 hover:bg-gray-800 rounded-lg transition">
                <i class="bi bi-file-earmark-pdf"></i> <span>Rekap Bulanan</span>
            </a>
            
            <div class="mt-auto pt-10">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-400 hover:bg-red-900/20 rounded-lg transition">
                        <i class="bi bi-box-arrow-left"></i> <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <header class="flex justify-between items-center pb-6 border-b mb-8">
            <h1 class="text-2xl font-bold">Dashboard Pemantauan Real-time</h1>
            <span class="px-4 py-1 bg-gray-900 text-white text-sm rounded-full">Admin: {{ Auth::user()->name }}</span>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-blue-500">
                <p class="text-sm text-gray-500">Total Karyawan</p>
                <p class="text-2xl font-bold">150</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-green-500">
                <p class="text-sm text-green-600">Hadir</p>
                <p class="text-2xl font-bold text-green-600">120</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-sm text-red-600">Terlambat</p>
                <p class="text-2xl font-bold text-red-600">10</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-yellow-500">
                <p class="text-sm text-yellow-600">Izin/Sakit</p>
                <p class="text-2xl font-bold text-yellow-600">5</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-gray-400">
                <p class="text-sm text-gray-500">Belum Absen</p>
                <p class="text-2xl font-bold">15</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                <h2 class="font-bold mb-4">Statistik Mingguan Kehadiran</h2>
                <canvas id="weeklyChart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col items-center">
                <h2 class="font-bold mb-4">Ketepatan Waktu</h2>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm overflow-x-auto">
                <h2 class="font-bold mb-4 text-gray-800">Aktivitas Terbaru</h2>
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Waktu</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="p-3">Budi Santoso</td>
                            <td class="p-3">07:55</td>
                            <td class="p-3"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Tepat Waktu</span></td>
                            <td class="p-3"><a href="#" class="text-blue-600 hover:underline">Map</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h2 class="font-bold mb-4">Lokasi Absen Terakhir</h2>
                <div id="map"></div>
            </div>
        </div>
    </main>
</div>

<footer class="bg-blue-600 text-white py-6 text-center text-sm">
    @polibatam2026 - Sistem Manajemen Kehadiran Karyawan
</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Copy script Chart.js & Leaflet Anda di sini (sama seperti sebelumnya)
    const ctxWeekly = document.getElementById('weeklyChart');
    new Chart(ctxWeekly, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            datasets: [{
                label: 'Kehadiran',
                data: [140, 135, 145, 130, 148],
                backgroundColor: '#3b82f6'
            }]
        }
    });

    const ctxPie = document.getElementById('pieChart');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Tepat Waktu', 'Terlambat'],
            datasets: [{
                data: [85, 15],
                backgroundColor: ['#10b981', '#ef4444']
            }]
        }
    });

    var map = L.map('map').setView([-1.123, 104.056], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([-1.123, 104.056]).addTo(map).bindPopup('Budi Santoso').openPopup();
</script>
</body>
</html>