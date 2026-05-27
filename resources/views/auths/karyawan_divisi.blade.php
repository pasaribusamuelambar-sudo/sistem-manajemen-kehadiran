<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Mengunci area tengah agar scroll mandiri tanpa mengganggu Sidebar/Navbar luar */
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
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
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
    <!-- Mengubah padding dan max-w menjadi w-full agar layout sinkron dan tidak melebar secara asimetris -->
    <div class="p-4 sm:p-5 space-y-5 w-full mx-auto pb-16">
        
        <!-- Header Section (Dipersempit gap & disesuaikan flex-nya agar sejajar sempurna) -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100 pb-4">
            <div class="max-w-xl">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight italic">Manajemen SDM</h1>
                <p class="text-slate-500 mt-0.5 font-medium text-xs sm:text-sm leading-relaxed">Otoritas HR: Kelola data master karyawan dan status akses sistem.</p>
            </div>
            
            <button onclick="openEmpModal()" class="w-full sm:w-auto bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center justify-center space-x-2 group flex-shrink-0 text-sm">
                <i data-lucide="user-plus" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                <span>Tambah Personel</span>
            </button>
        </div>

        <!-- Search Bar Section -->
        <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="relative w-full sm:max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="searchKaryawan" onkeyup="filterEmpTable()" placeholder="Cari nama, ID, atau jabatan karyawan..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-semibold text-sm">
            </div>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider hidden sm:block flex-shrink-0">
                PresensiHub Database Engine
            </div>
        </div>

        <!-- Stat Cards Section -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm render-stable">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Karyawan</p>
                <h3 class="text-2xl font-black text-slate-900" id="statTotal">0</h3>
            </div>
            <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100 shadow-sm render-stable">
                <p class="text-[10px] font-black text-emerald-600/70 uppercase tracking-widest mb-1">Aktif</p>
                <h3 class="text-2xl font-black text-emerald-600" id="statAktif">0</h3>
            </div>
            <div class="bg-amber-50 p-4 rounded-xl border border-amber-100 shadow-sm render-stable">
                <p class="text-[10px] font-black text-amber-600/70 uppercase tracking-widest mb-1">Cuti / Izin</p>
                <h3 class="text-2xl font-black text-amber-600" id="statCuti">0</h3>
            </div>
            <div class="bg-rose-50 p-4 rounded-xl border border-rose-100 shadow-sm render-stable">
                <p class="text-[10px] font-black text-rose-600/70 uppercase tracking-widest mb-1">Non-Aktif</p>
                <h3 class="text-2xl font-black text-rose-600" id="statNonAktif">0</h3>
            </div>
        </div>

        <!-- Table Card Section (Menggunakan scrollbar internal agar pas di container kanan) -->
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm render-stable w-full overflow-hidden">
            <div class="w-full overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 text-[10px] uppercase tracking-wider">
                            <th class="py-3.5 px-4 font-black w-[18%]">ID & Jabatan</th>
                            <th class="py-3.5 px-4 font-black w-[25%]">Nama Lengkap</th>
                            <th class="py-3.5 px-4 font-black w-[15%]">Divisi</th>
                            <th class="py-3.5 px-4 font-black w-[22%]">Kontak & Email</th>
                            <th class="py-3.5 px-4 font-black w-[12%]">Status</th>
                            <th class="py-3.5 px-4 font-black text-center w-[8%]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="empTableBody" class="divide-y divide-slate-100 text-slate-700 font-semibold text-xs sm:text-sm">
                        <!-- Data loaded via Javascript -->
                    </tbody>
                </table>
            </div>
            
            <!-- Empty State -->
            <div id="emptySearchState" class="hidden py-12 text-center">
                <div class="inline-flex p-3 bg-slate-50 rounded-full text-slate-400 mb-2">
                    <i data-lucide="user-x" class="w-5 h-5"></i>
                </div>
                <p class="text-slate-500 font-bold text-sm">Data personel tidak ditemukan</p>
                <p class="text-slate-400 text-xs mt-0.5">Gunakan kata kunci atau ejaan nama yang lain.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Component -->
<div id="empModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md">
    <div class="bg-white w-full max-w-xl rounded-2xl p-6 sm:p-8 shadow-2xl scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto custom-scrollbar relative">
        <div class="relative">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 id="modalEmpTitle" class="text-xl font-black text-slate-900 italic">Tambah Karyawan</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Lengkapi entitas data sesuai basis data pusat.</p>
                </div>
                <button onclick="closeEmpModal()" class="p-2 hover:bg-slate-100 rounded-full transition-colors text-slate-400">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="empForm" class="space-y-4">
                <input type="hidden" id="editEmpIndex">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">ID Karyawan (PK)</label>
                        <input type="text" id="inputEmpId" placeholder="Contoh: 33125..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Jabatan</label>
                        <input type="text" id="inputJabatan" placeholder="Contoh: Staff IT / Manager" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Nama Lengkap</label>
                    <input type="text" id="inputEmpName" placeholder="Nama sesuai KTP..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">No. Handphone</label>
                        <input type="tel" id="inputNoHp" placeholder="08..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Email Perusahaan</label>
                        <input type="email" id="inputEmail" placeholder="nama@polibatam.ac.id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Alamat Lengkap (Sesuai Domisili)</label>
                    <textarea id="inputAlamat" rows="2" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" placeholder="Jl. Gajah Mada..."></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Divisi (Relasi Status Divisi)</label>
                    <select id="inputEmpDiv" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm">
                        <option value="IT Dept">Pusat Data & IT</option>
                        <option value="Keuangan">Biro Keuangan</option>
                        <option value="HR Dept">SDM / HRD</option>
                        <option value="Marketing">Humas & Pemasaran</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Status Personel</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="empStatus" value="Aktif" class="hidden peer" checked>
                            <div class="p-2 text-center rounded-xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 text-slate-400 peer-checked:text-emerald-700 text-[10px] font-black uppercase transition-all">Aktif</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="empStatus" value="Cuti" class="hidden peer">
                            <div class="p-2 text-center rounded-xl border-2 border-slate-100 peer-checked:border-amber-500 peer-checked:bg-amber-50 text-slate-400 peer-checked:text-amber-700 text-[10px] font-black uppercase transition-all">Cuti</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="empStatus" value="Non-Aktif" class="hidden peer">
                            <div class="p-2 text-center rounded-xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50 text-slate-400 peer-checked:text-rose-700 text-[10px] font-black uppercase transition-all">Keluar</div>
                        </label>
                    </div>
                </div>

                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeEmpModal()" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-black uppercase text-[11px] tracking-widest hover:bg-slate-200 transition-all">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-black uppercase text-[11px] tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Data dummy terintegrasi dengan localStorage
    let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || [
        { 
            id: '331307-001', 
            nama: 'Samuel Ambar Pasaribu', 
            jabatan: 'Lead Developer', 
            no_hp: '0812-3456-7890', 
            email: 'samuel@polibatam.ac.id', 
            alamat: 'Batam Centre, Blok A No. 1', 
            divisi: 'IT Dept', 
            status: 'Aktif' 
        },
        { 
            id: '331307-002', 
            nama: 'Aditya Pratama', 
            jabatan: 'Staff Finance Senior', 
            no_hp: '0852-1122-3347', 
            email: 'aditya@polibatam.ac.id', 
            alamat: 'Tiban, Sekupang', 
            divisi: 'Keuangan', 
            status: 'Non-Aktif' 
        }
    ];

    function saveToStorage() {
        localStorage.setItem('dataKaryawan', JSON.stringify(dataKaryawan));
    }

    function updateStats() {
        document.getElementById('statTotal').innerText = dataKaryawan.length;
        document.getElementById('statAktif').innerText = dataKaryawan.filter(e => e.status === 'Aktif').length;
        document.getElementById('statCuti').innerText = dataKaryawan.filter(e => e.status === 'Cuti').length;
        document.getElementById('statNonAktif').innerText = dataKaryawan.filter(e => e.status === 'Non-Aktif').length;
    }

    function renderEmpTable() {
        const tbody = document.getElementById('empTableBody');
        if(!tbody) return; 
        
        tbody.innerHTML = '';

        dataKaryawan.forEach((emp, index) => {
            let badgeStyle = emp.status === 'Aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 
                             emp.status === 'Cuti' ? 'bg-amber-50 text-amber-600 border-amber-100' : 
                             'bg-rose-50 text-rose-600 border-rose-100';

            tbody.innerHTML += `
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="py-3 px-4">
                        <div class="text-slate-900 font-bold tracking-tight">${emp.id}</div>
                        <div class="text-[9px] text-slate-400 uppercase font-bold tracking-tight">${emp.jabatan}</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-[10px] font-black shadow-sm flex-shrink-0">
                                ${emp.nama.charAt(0)}
                            </div>
                            <span class="text-slate-900 font-bold max-w-[160px] truncate" title="${emp.nama}">${emp.nama}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 text-[9px] font-black uppercase rounded-md">${emp.divisi}</span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-xs text-slate-600 font-semibold">${emp.no_hp}</div>
                        <div class="text-[10px] text-slate-400 font-medium truncate">${emp.email}</div>
                    </td>
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center px-2 py-0.5 border rounded-full text-[9px] font-black uppercase tracking-wide ${badgeStyle}">
                            ● ${emp.status}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex justify-center space-x-1">
                            <button onclick="editEmp(${index})" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-slate-100 rounded-md transition-all">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                            </button>
                            <button onclick="deleteEmp(${index})" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-md transition-all">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
        updateStats();
        if (window.lucide) lucide.createIcons();
    }

    function filterEmpTable() {
        const query = document.getElementById('searchKaryawan').value.toLowerCase();
        const rows = document.querySelectorAll('#empTableBody tr');
        let matchCount = 0;

        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            if (cells.length > 0) {
                const idDanJabatan = cells[0].textContent.toLowerCase();
                const nama = cells[1].textContent.toLowerCase();
                
                if (idDanJabatan.includes(query) || nama.includes(query)) {
                    row.style.display = "";
                    matchCount++;
                } else {
                    row.style.display = "none";
                }
            }
        });

        const emptyState = document.getElementById('emptySearchState');
        if (matchCount === 0 && rows.length > 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    function openEmpModal(index = -1) {
        const modal = document.getElementById('empModal');
        const form = document.getElementById('empForm');
        modal.classList.remove('hidden');

        if(index > -1) {
            const e = dataKaryawan[index];
            document.getElementById('modalEmpTitle').innerText = 'Edit Data Karyawan';
            document.getElementById('editEmpIndex').value = index;
            document.getElementById('inputEmpId').value = e.id;
            document.getElementById('inputEmpName').value = e.nama;
            document.getElementById('inputJabatan').value = e.jabatan;
            document.getElementById('inputNoHp').value = e.no_hp;
            document.getElementById('inputEmail').value = e.email;
            document.getElementById('inputAlamat').value = e.alamat;
            document.getElementById('inputEmpDiv').value = e.divisi;
            form.querySelector(`input[name="empStatus"][value="${e.status}"]`).checked = true;
        } else {
            document.getElementById('modalEmpTitle').innerText = 'Tambah Personel Baru';
            form.reset();
            document.getElementById('editEmpIndex').value = -1;
        }
    }

    function closeEmpModal() {
        document.getElementById('empModal').classList.add('hidden');
    }

    document.getElementById('empForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const index = document.getElementById('editEmpIndex').value;
        const newData = {
            id: document.getElementById('inputEmpId').value,
            nama: document.getElementById('inputEmpName').value,
            jabatan: document.getElementById('inputJabatan').value,
            no_hp: document.getElementById('inputNoHp').value,
            email: document.getElementById('inputEmail').value,
            alamat: document.getElementById('inputAlamat').value,
            divisi: document.getElementById('inputEmpDiv').value,
            status: document.querySelector('input[name="empStatus"]:checked').value
        };

        if(index > -1) {
            dataKaryawan[index] = newData;
        } else {
            dataKaryawan.push(newData);
        }

        saveToStorage();
        renderEmpTable();
        closeEmpModal();
        document.getElementById('searchKaryawan').value = '';
    });

    function deleteEmp(index) {
        if(confirm('Hapus data karyawan ini dari sistem?')) {
            dataKaryawan.splice(index, 1);
            saveToStorage();
            renderEmpTable();
        }
    }

    function editEmp(index) { openEmpModal(index); }

    // Memastikan skrip dijalankan setelah DOM siap sempurna
    window.addEventListener('DOMContentLoaded', () => {
        renderEmpTable();
    });
</script>
</body>
</html>