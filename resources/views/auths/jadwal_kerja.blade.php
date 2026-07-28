<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kerja | PresensiHub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <div class="p-6 max-w-6xl mx-auto space-y-6">
        <div class="flex justify-between items-center bg-white p-6 border border-slate-200 rounded-3xl shadow-sm">
            <div>
                <h1 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                    <i data-lucide="calendar" class="text-blue-600 w-6 h-6"></i> Manajemen Jadwal Kerja
                </h1>
                <p class="text-xs text-slate-400 font-bold mt-1">Atur jam shift kerja masuk dan pulang untuk tiap divisi</p>
            </div>
            <button onclick="openModalJadwal()" class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl flex items-center gap-2 text-xs shadow-md cursor-pointer transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Jadwal Baru
            </button>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase font-bold border-b border-slate-100">
                            <th class="p-4">Divisi Karyawan</th>
                            <th class="p-4">Hari Kerja</th>
                            <th class="p-4">Jam Masuk</th>
                            <th class="p-4">Jam Pulang</th>
                            <th class="p-4">Toleransi (Menit)</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-jadwal-body" class="divide-y divide-slate-100 font-medium text-slate-700">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal-jadwal" class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl p-6 w-full max-w-md border border-slate-200 shadow-xl space-y-4">
            <div class="flex justify-between items-center">
                <h3 id="modal-title" class="text-base font-extrabold text-slate-900">Form Pengaturan Jam Kerja</h3>
                <button onclick="closeModalJadwal()" class="text-slate-400 hover:text-slate-600"><i data-lucide="x"></i></button>
            </div>
            
            <form id="form-jadwal" onsubmit="simpanJadwal(event)" class="space-y-4">
                <input type="hidden" id="inp-id">

                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Divisi</label>
                    <select id="inp-divisi" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-xs">
                        <option value="IT & Teknologi">IT & Teknologi</option>
                        <option value="HRD">HRD</option>
                        <option value="Pemasaran">Pemasaran</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Hari Kerja</label>
                    <input type="text" id="inp-hari" value="Senin - Jumat" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-xs" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Jam Masuk</label>
                        <input type="time" id="inp-masuk" value="08:00" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-xs" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Jam Pulang</label>
                        <input type="time" id="inp-pulang" value="15:00" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-xs" required>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Toleransi Telat (Menit)</label>
                    <input type="number" id="inp-toleransi" value="15" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-xs" required>
                </div>
                <button type="submit" id="btn-submit-jadwal" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-xl shadow-md text-xs cursor-pointer transition-colors">
                    Simpan Aturan Kerja
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openModalJadwal() {
            document.getElementById('form-jadwal').reset();
            document.getElementById('inp-id').value = '';
            document.getElementById('modal-title').textContent = 'Tambah Aturan Jam Kerja';
            document.getElementById('btn-submit-jadwal').textContent = 'Simpan Aturan Kerja';

            // Mengisi default 08:00 dan 15:00 dengan toleransi 15 menit
            document.getElementById('inp-masuk').value = "08:00";
            document.getElementById('inp-pulang').value = "15:00";
            document.getElementById('inp-toleransi').value = "15";

            const m = document.getElementById('modal-jadwal');
            m.classList.remove('hidden');
            setTimeout(() => m.classList.add('opacity-100'), 50);
        }

        function closeModalJadwal() {
            const m = document.getElementById('modal-jadwal');
            m.classList.remove('opacity-100');
            setTimeout(() => m.classList.add('hidden'), 300);
        }

        function simpanJadwal(e) {
            e.preventDefault();
            
            const idValue = document.getElementById('inp-id').value;
            const dataJadwal = {
                divisi: document.getElementById('inp-divisi').value,
                hari: document.getElementById('inp-hari').value,
                jam_masuk: document.getElementById('inp-masuk').value,
                jam_pulang: document.getElementById('inp-pulang').value,
                toleransi: parseInt(document.getElementById('inp-toleransi').value)
            };
            
            let listJadwal = localStorage.getItem('schedulesData') ? JSON.parse(localStorage.getItem('schedulesData')) : [];
            if (!Array.isArray(listJadwal)) {
                listJadwal = [];
            }

            if (idValue) {
                const index = listJadwal.findIndex(item => item.id == idValue);
                if (index !== -1) {
                    dataJadwal.id = parseInt(idValue);
                    listJadwal[index] = dataJadwal;
                    alert('Jadwal Divisi berhasil diperbarui!');
                }
            } else {
                dataJadwal.id = Date.now();
                listJadwal.push(dataJadwal);
                alert('Jadwal Divisi berhasil ditambahkan!');
            }
            
            localStorage.setItem('schedulesData', JSON.stringify(listJadwal));
            
            closeModalJadwal();
            renderTabelJadwal();
        }

        function editJadwal(id) {
            const saved = localStorage.getItem('schedulesData');
            if (!saved) return;

            const listJadwal = JSON.parse(saved);
            const item = listJadwal.find(item => item.id == id);

            if (item) {
                document.getElementById('inp-id').value = item.id;
                document.getElementById('inp-divisi').value = item.divisi;
                document.getElementById('inp-hari').value = item.hari;
                document.getElementById('inp-masuk').value = item.jam_masuk;
                document.getElementById('inp-pulang').value = item.jam_pulang;
                document.getElementById('inp-toleransi').value = item.toleransi;

                document.getElementById('modal-title').textContent = 'Edit Aturan Jam Kerja';
                document.getElementById('btn-submit-jadwal').textContent = 'Perbarui Aturan Kerja';

                const m = document.getElementById('modal-jadwal');
                m.classList.remove('hidden');
                setTimeout(() => m.classList.add('opacity-100'), 50);
            }
        }

        function renderTabelJadwal() {
            const body = document.getElementById('tabel-jadwal-body');
            const saved = localStorage.getItem('schedulesData');
            
            if(!saved) {
                body.innerHTML = `<tr><td colspan="6" class="p-6 text-center text-slate-400">Belum ada aturan jam kerja dibuat. Klik tombol tambah.</td></tr>`;
                return;
            }

            const listJadwal = JSON.parse(saved);
            
            if (!Array.isArray(listJadwal) || listJadwal.length === 0) {
                body.innerHTML = `<tr><td colspan="6" class="p-6 text-center text-slate-400">Belum ada aturan jam kerja dibuat. Klik tombol tambah.</td></tr>`;
                return;
            }

            body.innerHTML = '';

            listJadwal.forEach((item) => {
                body.innerHTML += `
                    <tr class="hover:bg-slate-50 border-b border-slate-100">
                        <td class="p-4 font-bold text-slate-900">${item.divisi}</td>
                        <td class="p-4 font-semibold">${item.hari}</td>
                        <td class="p-4 text-emerald-600 font-bold">${item.jam_masuk} WIB</td>
                        <td class="p-4 text-orange-600 font-bold">${item.jam_pulang} WIB</td>
                        <td class="p-4 font-medium">${item.toleransi} Menit</td>
                        <td class="p-4 text-center space-x-3">
                            <button onclick="editJadwal(${item.id})" class="text-blue-600 hover:text-blue-800 font-bold cursor-pointer">Edit</button>
                            <button onclick="hapusJadwal(${item.id})" class="text-rose-500 hover:text-rose-700 font-bold cursor-pointer">Hapus</button>
                        </td>
                    </tr>`;
            });
        }

        function hapusJadwal(id) {
            if(confirm('Hapus aturan jadwal kerja ini?')) {
                const saved = localStorage.getItem('schedulesData');
                if(saved) {
                    let listJadwal = JSON.parse(saved);
                    listJadwal = listJadwal.filter(item => item.id !== id);
                    
                    localStorage.setItem('schedulesData', JSON.stringify(listJadwal));
                    renderTabelJadwal();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', renderTabelJadwal);
    </script>
</body>
</html>