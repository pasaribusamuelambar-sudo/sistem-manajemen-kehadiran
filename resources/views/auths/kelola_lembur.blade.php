<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">Kelola Lembur Karyawan</h1>
        <p class="text-sm text-slate-500 mt-1">Otorisasi, tinjau, dan rekapitulasi data lembur kerja karyawan.</p>
    </div>
    <div class="flex-shrink-0">
        <button onclick="openModalLembur()" class="inline-flex items-center justify-center space-x-2 px-5 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all text-sm w-full sm:w-auto">
            <i data-lucide="plus" class="w-4 h-4 stroke-[3]"></i>
            <span>Tambah Lembur</span>
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-amber-50/60 border border-amber-100 rounded-3xl p-6 flex items-center justify-between shadow-sm">
        <div class="space-y-1 min-w-0">
            <p class="text-xs font-bold text-amber-600 uppercase tracking-wider">Menunggu Persetujuan</p>
            <h3 id="stat-menunggu" class="text-3xl font-black text-amber-700 tracking-tight">0</h3>
            <p class="text-xs text-amber-600/80 font-medium truncate">Pengajuan memerlukan tindakan</p>
        </div>
        <div class="bg-amber-500 text-white p-3.5 rounded-2xl shadow-md shadow-amber-100 flex-shrink-0 ml-4">
            <i data-lucide="clock" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-emerald-50/60 border border-emerald-100 rounded-3xl p-6 flex items-center justify-between shadow-sm">
        <div class="space-y-1 min-w-0">
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Total Jam Disetujui</p>
            <h3 id="stat-jam" class="text-3xl font-black text-emerald-700 tracking-tight">0 <span class="text-lg font-bold">jam</span></h3>
            <p class="text-xs text-emerald-600/80 font-medium truncate">Akumulasi lembur bulan ini</p>
        </div>
        <div class="bg-emerald-500 text-white p-3.5 rounded-2xl shadow-md shadow-emerald-100 flex-shrink-0 ml-4">
            <i data-lucide="zap" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-indigo-50/50 border border-indigo-100 rounded-3xl p-6 flex items-center justify-between shadow-sm">
        <div class="space-y-1 min-w-0">
            <p class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Total Pengajuan</p>
            <h3 id="stat-total" class="text-3xl font-black text-indigo-700 tracking-tight">0</h3>
            <p class="text-xs text-indigo-600/80 font-medium truncate">Seluruh berkas masuk</p>
        </div>
        <div class="bg-indigo-500 text-white p-3.5 rounded-2xl shadow-md shadow-indigo-100 flex-shrink-0 ml-4">
            <i data-lucide="file-text" class="w-6 h-6"></i>
        </div>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-3xl p-4 mb-6 flex flex-col lg:flex-row gap-4 items-center justify-between shadow-sm">
    <div class="relative w-full lg:flex-1">
        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
        <input type="text" id="filter-search" oninput="renderTable()" placeholder="Cari karyawan..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-12 pr-4 py-3 text-sm font-medium focus:outline-none focus:border-indigo-500 focus:bg-white transition-all text-slate-700">
    </div>
    
    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
        <div class="relative w-full sm:w-48">
            <input type="date" id="filter-date" onchange="renderTable()" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold text-slate-600 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
        </div>

        <div class="relative w-full sm:w-48">
            <select id="filter-status" onchange="renderTable()" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-4 pr-10 py-3 text-sm font-bold text-slate-600 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all appearance-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="disetujui">Disetujui</option>
                <option value="ditolak">Ditolak</option>
            </select>
            <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4 pointer-events-none"></i>
        </div>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-3xl shadow-sm w-full overflow-hidden">
    <div class="overflow-x-auto w-full block">
        <table class="w-full min-w-[1050px] text-left border-collapse table-layout-fixed">
            <thead>
                <tr class="border-b border-slate-100 text-slate-400 text-[11px] font-bold uppercase tracking-wider bg-slate-50/50">
                    <th class="px-5 py-4 w-[22%]">Karyawan</th>
                    <th class="px-5 py-4 w-[12%]">Tanggal</th>
                    <th class="px-5 py-4 w-[10%]">Mulai</th>
                    <th class="px-5 py-4 w-[10%]">Selesai</th>
                    <th class="px-5 py-4 w-[11%]">Durasi</th>
                    <th class="px-5 py-4 w-[23%]">Keterangan</th>
                    <th class="px-5 py-4 w-[12%]">Status</th>
                    <th class="px-5 py-4 w-[12%] text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="lembur-table-body" class="divide-y divide-slate-100 text-sm font-medium text-slate-700">
                </tbody>
        </table>
    </div>
</div>

<div id="modal-lembur" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div onclick="closeModalLembur()" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    
    <div class="bg-white rounded-3xl w-full max-w-lg p-6 relative z-10 shadow-2xl mx-4 transform transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Form Input Lembur</h2>
            <button onclick="closeModalLembur()" class="p-2 rounded-xl text-slate-400 hover:bg-slate-100 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="form-lembur" onsubmit="handleFormSubmit(event)" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Pilih Karyawan</label>
                <select id="input-karyawan" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    <option value="">-- Pilih Karyawan --</option>
                    <option value="Ahmad Fauzi">Ahmad Fauzi</option>
                    <option value="Samuel Ambar Pasaribu">Samuel Ambar Pasaribu</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal</label>
                <input type="date" id="input-tanggal" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Jam Mulai</label>
                    <input type="time" id="input-mulai" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Jam Selesai</label>
                    <input type="time" id="input-selesai" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Keterangan / Alasan</label>
                <textarea id="input-keterangan" rows="3" required placeholder="Contoh: lembur migrasi database produksi" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all resize-none"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeModalLembur()" class="px-5 py-3 rounded-2xl text-slate-500 hover:bg-slate-50 font-bold transition-all text-sm">Batal</button>
                <button type="submit" class="px-5 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all text-sm shadow-md shadow-indigo-100">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Data bawaan awal (Default mock data jika localStorage masih kosong)
    const defaultDataLembur = [
        {
            id: 1,
            nama: "Ahmad Fauzi",
            inisial: "A",
            bgInisial: "bg-blue-50 text-blue-600 border-blue-100",
            tanggal: "2026-05-29",
            mulai: "07:30",
            selesai: "19:45",
            durasi: 12.3,
            keterangan: "lembur karena teman ada urusan mendadak",
            status: "menunggu"
        },
        {
            id: 2,
            nama: "Ahmad Fauzi",
            inisial: "A",
            bgInisial: "bg-blue-50 text-blue-600 border-blue-100",
            tanggal: "2026-05-29",
            mulai: "07:00",
            selesai: "19:30",
            durasi: 12.5,
            keterangan: "gantikan teman sakit shift siang",
            status: "disetujui"
        },
        {
            id: 3,
            nama: "Samuel Ambar Pasaribu",
            inisial: "S",
            bgInisial: "bg-indigo-50 text-indigo-600 border-indigo-100",
            tanggal: "2026-05-29",
            mulai: "07:00",
            selesai: "19:00",
            durasi: 12.0,
            keterangan: "kerja dari tanggal 28-mei lembur proyek backend",
            status: "ditolak"
        }
    ];

    // Mengambil data dari localStorage saat load awal, jika belum ada pakai defaultDataLembur
    let dataLembur = JSON.parse(localStorage.getItem('presensi_hub_lembur')) || defaultDataLembur;

    // Fungsi untuk mensinkronisasi data variabel ke dalam storage browser browser
    function saveToLocalStorage() {
        localStorage.setItem('presensi_hub_lembur', JSON.stringify(dataLembur));
    }

    // Fungsi hitung rekap kartu statistik secara dinamis
    function updateStatCards() {
        const menunggu = dataLembur.filter(item => item.status === 'menunggu').length;
        const totalJam = dataLembur.filter(item => item.status === 'disetujui').reduce((sum, item) => sum + item.durasi, 0);
        const totalPengajuan = dataLembur.length;

        document.getElementById('stat-menunggu').innerText = menunggu;
        document.getElementById('stat-jam').innerHTML = `${totalJam.toFixed(1)} <span class="text-lg font-bold">jam</span>`;
        document.getElementById('stat-total').innerText = totalPengajuan;
    }

    // Fungsi utilitas hitung durasi jam lembur
    function hitungDurasi(mulai, selesai) {
        let [h1, m1] = mulai.split(':').map(Number);
        let [h2, m2] = selesai.split(':').map(Number);
        let menitMulai = h1 * 60 + m1;
        let menitSelesai = h2 * 60 + m2;
        if (menitSelesai < menitMulai) menitSelesai += 24 * 60; // Antisipasi lembur lewat tengah malam
        return parseFloat(((menitSelesai - menitMulai) / 60).toFixed(1));
    }

    // Fungsi render struktur baris tabel
    function renderTable() {
        const tbody = document.getElementById('lembur-table-body');
        const searchVal = document.getElementById('filter-search').value.toLowerCase();
        const dateVal = document.getElementById('filter-date').value;
        const statusVal = document.getElementById('filter-status').value;

        tbody.innerHTML = '';

        const filteredData = dataLembur.filter(item => {
            const matchSearch = item.nama.toLowerCase().includes(searchVal);
            const matchDate = dateVal ? item.tanggal === dateVal : true;
            const matchStatus = statusVal ? item.status === statusVal : true;
            return matchSearch && matchDate && matchStatus;
        });

        if (filteredData.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center py-8 text-slate-400 font-medium">
                        Tidak ada data lembur yang ditemukan.
                    </td>
                </tr>
            `;
            return;
        }

        filteredData.forEach(item => {
            let statusBadge = '';
            if(item.status === 'menunggu') {
                statusBadge = `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">menunggu</span>`;
            } else if(item.status === 'disetujui') {
                statusBadge = `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">disetujui</span>`;
            } else {
                statusBadge = `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-600 border border-rose-100">ditolak</span>`;
            }

            // Atur tombol aksi dinamis sesuai statusnya
            let actionButtons = '';
            if(item.status === 'menunggu') {
                actionButtons = `
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="ubahStatus(${item.id}, 'disetujui')" class="p-2 rounded-xl text-emerald-500 hover:bg-emerald-50 border border-transparent hover:border-emerald-100 transition-all flex items-center justify-center" title="Setujui">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </button>
                        <button onclick="ubahStatus(${item.id}, 'ditolak')" class="p-2 rounded-xl text-rose-500 hover:bg-rose-50 border border-transparent hover:border-rose-100 transition-all flex items-center justify-center" title="Tolak">
                            <i data-lucide="x-circle" class="w-5 h-5"></i>
                        </button>
                        <button onclick="hapusLembur(${item.id})" class="p-2 rounded-xl text-slate-400 hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all flex items-center justify-center" title="Hapus">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                `;
            } else {
                actionButtons = `
                    <div class="flex items-center justify-center">
                        <button onclick="hapusLembur(${item.id})" class="p-2 rounded-xl text-slate-400 hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all flex items-center justify-center" title="Hapus">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                `;
            }

            const tr = document.createElement('tr');
            tr.className = "hover:bg-slate-50/80 transition-colors";
            tr.innerHTML = `
                <td class="px-5 py-4 flex items-center space-x-3 min-w-0">
                    <div class="w-9 h-9 flex-shrink-0 rounded-xl flex items-center justify-center font-bold text-xs border ${item.bgInisial}">
                        ${item.inisial}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-bold text-slate-800 truncate" title="${item.nama}">${item.nama}</p>
                    </div>
                </td>
                <td class="px-5 py-4 text-slate-600 whitespace-nowrap">${item.tanggal}</td>
                <td class="px-5 py-4 font-semibold whitespace-nowrap">${item.mulai}</td>
                <td class="px-5 py-4 font-semibold whitespace-nowrap">${item.selesai}</td>
                <td class="px-5 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-purple-50 text-purple-600 border border-purple-100">${item.durasi} jam</span>
                </td>
                <td class="px-5 py-4 text-slate-500 break-words pr-4 max-w-[220px]" title="${item.keterangan}">
                    <p class="line-clamp-2">${item.keterangan}</p>
                </td>
                <td class="px-5 py-4 whitespace-nowrap">${statusBadge}</td>
                <td class="px-5 py-4">${actionButtons}</td>
            `;
            tbody.appendChild(tr);
        });

        // Gambar ulang ikon Lucide
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // Handler Tambah Lembur Baru
    function handleFormSubmit(e) {
        e.preventDefault();
        
        const nama = document.getElementById('input-karyawan').value;
        const tanggal = document.getElementById('input-tanggal').value;
        const mulai = document.getElementById('input-mulai').value;
        const selesai = document.getElementById('input-selesai').value;
        const keterangan = document.getElementById('input-keterangan').value;

        const inisial = nama.charAt(0);
        const bgInisial = nama.includes("Samuel") 
            ? "bg-indigo-50 text-indigo-600 border-indigo-100" 
            : "bg-blue-50 text-blue-600 border-blue-100";

        const durasiCalculated = hitungDurasi(mulai, selesai);

        const newLembur = {
            id: Date.now(), // ID Unik berbasis timestamp
            nama,
            inisial,
            bgInisial,
            tanggal,
            mulai,
            selesai,
            durasi: durasiCalculated,
            keterangan,
            status: "menunggu"
        };

        dataLembur.unshift(newLembur);
        
        saveToLocalStorage(); // Simpan permanen ke browser
        document.getElementById('form-lembur').reset();
        closeModalLembur();
        
        renderTable();
        updateStatCards();
    }

    // Handler Ubah Status (Setujui / Tolak)
    function ubahStatus(id, statusBaru) {
        dataLembur = dataLembur.map(item => {
            if(item.id === id) {
                return { ...item, status: statusBaru };
            }
            return item;
        });
        saveToLocalStorage(); // Simpan perubahan status ke browser
        renderTable();
        updateStatCards();
    }

    // Handler Hapus Data Lembur
    function hapusLembur(id) {
        if(confirm("Apakah Anda yakin ingin menghapus data rekap lembur ini?")) {
            dataLembur = dataLembur.filter(item => item.id !== id);
            saveToLocalStorage(); // Simpan perubahan struktur array ke browser
            renderTable();
            updateStatCards();
        }
    }

    // Modal Control Visibility
    function openModalLembur() {
        document.getElementById('modal-lembur').classList.remove('hidden');
    }

    function closeModalLembur() {
        document.getElementById('modal-lembur').classList.add('hidden');
    }

    // Init state saat DOM siap dimuat
    document.addEventListener("DOMContentLoaded", function() {
        renderTable();
        updateStatCards();
    });
</script>