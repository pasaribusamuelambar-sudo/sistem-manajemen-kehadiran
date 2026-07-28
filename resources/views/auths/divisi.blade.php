<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Divisi | PresensiHub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
    .content-viewport-isolated {
        display: flex;
        flex-direction: column;
        width: 100%;
        overflow-y: auto;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    /* Animasi Efek Transisi */
    .fade-out {
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.4s ease-out;
    }
    .fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div id="toastNotification" class="fixed top-5 right-5 z-[100] transform translate-y-[-20px] opacity-0 pointer-events-none transition-all duration-300 ease-out flex items-center gap-3 bg-white text-slate-800 px-5 py-3.5 rounded-xl shadow-xl border border-emerald-100 text-sm font-semibold">
    <div class="bg-emerald-500 text-white p-1.5 rounded-lg">
        <i data-lucide="check" class="w-4 h-4 stroke-[3]"></i>
    </div>
    <span id="toastMessage">Divisi berhasil disimpan!</span>
</div>

<div id="modalDivision" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-2xl m-4 transform scale-95 transition-all duration-300" id="modalContainer">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-bold text-slate-800 text-lg" id="modalTitle">Tambah Divisi</h2>
            <button onclick="toggleModal(false)" class="text-slate-400 hover:text-slate-600 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="divisionForm" onsubmit="handleFormSubmit(event)" class="space-y-5">
            <input type="hidden" id="formEditIndex" value="">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Divisi</label>
                <input type="text" id="formNamaDivisi" placeholder="Masukkan nama divisi" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium outline-none focus:border-indigo-500 focus:bg-white transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Ketua Divisi</label>
                <input type="text" id="formKetuaDivisi" placeholder="Masukkan nama ketua divisi" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium outline-none focus:border-indigo-500 focus:bg-white transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                <select id="formStatus" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                <button type="button" onclick="toggleModal(false)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm rounded-xl transition-all">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-md shadow-indigo-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="content-viewport-isolated custom-scrollbar">
    <div class="p-0 max-w-7xl mx-auto w-full pb-16">
        
        <div class="flex justify-between items-center mb-6 w-full">
            <h1 class="text-xl font-bold text-slate-800">Manajemen Divisi</h1>
            
            <button onclick="openAddModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 transition-all shadow-md shadow-indigo-100 shrink-0 h-[44px]">
                <i data-lucide="plus" class="w-4 h-4 stroke-[3]"></i> Tambah Divisi
            </button>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="divisionTable">
                    <thead>
                        <tr class="bg-slate-50/70 text-slate-400 border-b border-slate-100">
                            <th class="p-4 text-sm font-medium">Nama Divisi</th>
                            <th class="p-4 text-sm font-medium">Ketua Divisi</th>
                            <th class="p-4 text-sm font-medium">Status</th>
                            <th class="p-4 text-sm font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tableBody">
                        </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    // Data bawaan awal (Default Data) jika LocalStorage masih kosong
    const defaultDivisions = [
        { nama: "IT & Teknologi", ketua: "Budi Santoso", status: "aktif" },
        { nama: "Keuangan", ketua: "Siti Rahayu", status: "aktif" },
        { nama: "SDM (HR)", ketua: "Ahmad Fauzi", status: "aktif" },
        { nama: "Marketing", ketua: "Dewi Lestari", status: "aktif" }
    ];

    // Inisialisasi data saat halaman pertama kali dibuka
    document.addEventListener("DOMContentLoaded", function() {
        if (!localStorage.getItem('presensi_hub_divisi')) {
            localStorage.setItem('presensi_hub_divisi', JSON.stringify(defaultDivisions));
        }
        renderTable();
    });

    // Fungsi mengambil data dari LocalStorage
    function getDivisions() {
        return JSON.parse(localStorage.getItem('presensi_hub_divisi')) || [];
    }

    // Fungsi menyimpan ulang data ke LocalStorage
    function saveDivisions(data) {
        localStorage.setItem('presensi_hub_divisi', JSON.stringify(data));
    }

    // Fungsi Render Menggambar Ulang Tabel berdasarkan isi Data Terkini
    function renderTable() {
        const divisions = getDivisions();
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = ''; // Kosongkan tabel terlebih dahulu

        if (divisions.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-400 font-medium">Belum ada data divisi.</td>
                </tr>`;
            return;
        }

        divisions.forEach((divisi, index) => {
            let badgeStyle = 'bg-emerald-50 text-emerald-600 border border-emerald-100/50';
            if (divisi.status === 'tidak aktif') {
                badgeStyle = 'bg-rose-50 text-rose-600 border border-rose-100/50';
            }

            const tr = document.createElement('tr');
            tr.className = "hover:bg-slate-50/80 transition-colors text-sm division-row";
            tr.innerHTML = `
                <td class="p-4 font-semibold text-slate-800 division-name">${divisi.nama}</td>
                <td class="p-4 text-slate-600 font-medium">${divisi.ketua}</td>
                <td class="p-4">
                    <span class="px-2.5 py-1 text-xs font-bold rounded-lg ${badgeStyle}">${divisi.status}</span>
                </td>
                <td class="p-4">
                    <div class="flex items-center justify-center gap-1">
                        <button onclick="openEditModal(${index})" class="text-slate-700 hover:text-slate-900 w-8 h-8 flex items-center justify-center hover:bg-slate-100 rounded-lg transition-all" title="Ubah Divisi">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </button>
                        <button onclick="deleteDivision(${index}, this)" class="text-rose-500 hover:text-rose-600 w-8 h-8 flex items-center justify-center hover:bg-rose-50 rounded-lg transition-all" title="Hapus Divisi">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });

        // Re-render Ikon Lucide agar ikon pena & sampah muncul kembali
        if (window.lucide) { lucide.createIcons(); }
    }

    // Fungsi Kontrol Tampilan Pop-up Modal
    function toggleModal(show) {
        const modal = document.getElementById('modalDivision');
        const container = document.getElementById('modalContainer');
        if (show) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            container.classList.remove('scale-95');
            container.classList.add('scale-100');
        } else {
            modal.classList.add('opacity-0', 'pointer-events-none');
            container.classList.remove('scale-100');
            container.classList.add('scale-95');
            document.getElementById('divisionForm').reset();
            document.getElementById('formEditIndex').value = "";
        }
    }

    // Mode: Klik tombol "Tambah Divisi"
    function openAddModal() {
        document.getElementById('modalTitle').textContent = "Tambah Divisi";
        document.getElementById('formEditIndex').value = ""; // Kosongkan index edit
        toggleModal(true);
    }

    // Mode PERBAIKAN: Klik ikon pena (Edit Divisi) mengambil data baris terkait
    function openEditModal(index) {
        const divisions = getDivisions();
        const targetData = divisions[index];

        if (targetData) {
            document.getElementById('modalTitle').textContent = "Ubah Divisi";
            document.getElementById('formEditIndex').value = index; // Isi index baris ke berapa
            document.getElementById('formNamaDivisi').value = targetData.nama;
            document.getElementById('formKetuaDivisi').value = targetData.ketua;
            document.getElementById('formStatus').value = targetData.status;
            
            toggleModal(true);
        }
    }

    // Handler Submit Form Gabungan (Bisa Tambah Baru atau Update Data Lama)
    function handleFormSubmit(event) {
        event.preventDefault();

        const namaDivisi = document.getElementById('formNamaDivisi').value;
        const ketuaDivisi = document.getElementById('formKetuaDivisi').value;
        const status = document.getElementById('formStatus').value;
        const editIndex = document.getElementById('formEditIndex').value;

        let divisions = getDivisions();

        if (editIndex !== "") {
            // JIKA INDEX TERSEDIA -> PROSES UPDATE DATA LAMA
            divisions[editIndex] = { nama: namaDivisi, ketua: ketuaDivisi, status: status };
            saveDivisions(divisions);
            showToast("Perubahan divisi berhasil diperbarui!");
        } else {
            // JIKA INDEX KOSONG -> PROSES SIMPAN DATA BARU
            divisions.unshift({ nama: namaDivisi, ketua: ketuaDivisi, status: status });
            saveDivisions(divisions);
            showToast("Divisi baru berhasil ditambahkan!");
        }

        toggleModal(false);
        renderTable();
    }

    // Fungsi PERBAIKAN: Hapus Data Divisi Permanen dari Storage
    function deleteDivision(index, buttonElement) {
        if (confirm("Apakah Anda yakin ingin menghapus divisi ini?")) {
            const targetRow = buttonElement.closest('.division-row');
            targetRow.classList.add('fade-out'); // Efek animasi menghilang ke kanan
            
            setTimeout(() => {
                let divisions = getDivisions();
                divisions.splice(index, 1); // Buang data array di indeks terpilih
                saveDivisions(divisions); // Simpan kembali array terbaru
                
                renderTable(); // Gambar ulang tabel
                showToast("Divisi berhasil dihapus!");
            }, 400); 
        }
    }

    // Fungsi Memunculkan Toast Notifikasi
    function showToast(message) {
        const toast = document.getElementById('toastNotification');
        const toastMsg = document.getElementById('toastMessage');
        
        toastMsg.textContent = message;
        toast.classList.remove('translate-y-[-20px]', 'opacity-0', 'pointer-events-none');
        toast.classList.add('translate-y-0', 'opacity-100');
        
        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-[-20px]', 'opacity-0', 'pointer-events-none');
        }, 3000);
    }
</script>