<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan & Divisi | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .content-viewport-isolated {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: calc(100vh - 110px); 
            overflow-y: auto;             
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        .render-stable {
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<!-- KONTEN UTAMA MANAJEMEN KARYAWAN & DIVISI -->
<div class="space-y-5 w-full mx-auto pb-16">
    
    <!-- Flash Message Notifikasi Sukses dari Database -->
    @if(session('success'))
        <div class="p-4 mb-2 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    @endif

    <!-- JUDUL & TOMBOL TAMBAH PERSONEL -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 pb-4">
        <div class="max-w-xl">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight italic">Manajemen SDM & Otoritas Akses</h1>
            <p class="text-slate-500 mt-0.5 font-medium text-xs sm:text-sm leading-relaxed">Halaman khusus Admin untuk mengelola data master karyawan, divisi kerja, dan kredensial akun sistem.</p>
        </div>
        
        <button onclick="openAddModal()" class="w-full sm:w-auto bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center justify-center space-x-2 group flex-shrink-0 text-sm">
            <i data-lucide="user-plus" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
            <span>Tambah Personel</span>
        </button>
    </div>

    <!-- SEARCH BAR ENGINE -->
    <div class="bg-white p-3 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div class="relative w-full sm:max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input type="text" id="searchKaryawan" onkeyup="filterEmpTable()" placeholder="Cari nama, ID, divisi, atau tingkat admin..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-semibold text-sm">
        </div>
        <div class="text-xs text-slate-400 font-bold uppercase tracking-wider hidden sm:block flex-shrink-0">
            PresensiHub Live Database Engine
        </div>
    </div>

    <!-- STATISTIK RINGKASAN DATA (Dihitung Real-time dari $data) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Personel</p>
            <h3 class="text-2xl font-black text-slate-900">{{ count($data) }}</h3>
        </div>
        <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-200 shadow-sm">
            <p class="text-[10px] font-black text-emerald-600/70 uppercase tracking-widest mb-1">Aktif</p>
            <h3 class="text-2xl font-black text-emerald-600">{{ $data->where('status', 'Aktif')->count() }}</h3>
        </div>
        <div class="bg-amber-50 p-4 rounded-xl border border-amber-200 shadow-sm">
            <p class="text-[10px] font-black text-amber-600/70 uppercase tracking-widest mb-1">Cuti / Izin</p>
            <h3 class="text-2xl font-black text-amber-600">{{ $data->where('status', 'Cuti')->count() }}</h3>
        </div>
        <div class="bg-rose-50 p-4 rounded-xl border border-rose-200 shadow-sm">
            <p class="text-[10px] font-black text-rose-600/70 uppercase tracking-widest mb-1">Non-Aktif</p>
            <h3 class="text-2xl font-black text-rose-600">{{ $data->where('status', 'Non-Aktif')->count() }}</h3>
        </div>
    </div>

    <!-- TABEL DATA MASTER KARYAWAN -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm w-full overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[950px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[10px] uppercase tracking-wider">
                        <th class="py-3.5 px-4 font-black w-[15%]">ID & Level Akses</th>
                        <th class="py-3.5 px-4 font-black w-[22%]">Nama Lengkap</th>
                        <th class="py-3.5 px-4 font-black w-[12%]">Divisi</th>
                        <th class="py-3.5 px-4 font-black w-[23%]">Kontak & Email</th>
                        <th class="py-3.5 px-4 font-black w-[12%]">Password (Monitor)</th>
                        <th class="py-3.5 px-4 font-black w-[10%]">Status</th>
                        <th class="py-3.5 px-4 font-black text-center w-[8%]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="empTableBody" class="divide-y divide-slate-100 text-slate-700 font-semibold text-xs sm:text-sm">
                    @forelse($data as $karyawan)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <!-- ID Kerja & Role -->
                        <td class="py-3 px-4">
                            <div class="text-slate-900 font-bold tracking-tight">{{ $karyawan->id_kerja }}</div>
                            <div class="text-[9px] text-indigo-600 uppercase font-black tracking-tight">{{ $karyawan->role }}</div>
                        </td>

                        <!-- Nama Lengkap -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-[10px] font-black shadow-sm flex-shrink-0">
                                    {{ strtoupper(substr($karyawan->name, 0, 1)) }}
                                </div>
                                <span class="text-slate-900 font-bold max-w-[160px] truncate" title="{{ $karyawan->name }}">{{ $karyawan->name }}</span>
                            </div>
                        </td>

                        <!-- Divisi -->
                        <td class="py-3 px-4">
                            <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 text-[9px] font-black uppercase rounded-md border border-slate-200">{{ $karyawan->divisi }}</span>
                        </td>

                        <!-- Kontak & Email -->
                        <td class="py-3 px-4">
                            <div class="text-xs text-slate-700 font-bold">{{ $karyawan->no_hp }}</div>
                            <div class="text-[10px] text-slate-400 font-medium truncate">{{ $karyawan->email }}</div>
                        </td>

                        <!-- Password Plain Text Monitor -->
                        <td class="py-3 px-4 font-mono text-xs text-slate-600">
                            <div class="bg-slate-50 px-2 py-1 rounded-lg inline-block border border-slate-200">
                                {{ $karyawan->real_password ?? '--------' }}
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 border rounded-full text-[9px] font-black uppercase tracking-wide 
                                {{ $karyawan->status == 'Aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : ($karyawan->status == 'Cuti' ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-rose-50 text-rose-600 border-rose-200') }}">
                                ● {{ $karyawan->status }}
                            </span>
                        </td>

                        <!-- Aksi Edit & Hapus -->
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-1">
                                <button onclick="openEditModal({{ json_encode($karyawan) }})" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-slate-100 rounded-md transition-all" title="Edit Karyawan">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                
                                <form action="{{ route('admin.karyawan.delete', $karyawan->id) }}" method="POST" onsubmit="return confirm('Hapus data karyawan ini dari sistem database?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-md transition-all" title="Hapus Karyawan">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400 font-bold">Belum ada data karyawan terdaftar di database.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- State saat pencarian tidak ditemukan -->
        <div id="emptySearchState" class="hidden py-12 text-center">
            <div class="inline-flex p-3 bg-slate-50 rounded-full text-slate-400 mb-2">
                <i data-lucide="user-x" class="w-5 h-5"></i>
            </div>
            <p class="text-slate-500 font-bold text-sm">Data personel tidak ditemukan</p>
            <p class="text-slate-400 text-xs mt-0.5">Gunakan kata kunci divisi, jabatan, atau ejaan nama yang lain.</p>
        </div>
    </div>
</div>

<!-- MODAL FORM INPUT (TAMBAH & EDIT) -->
<div id="empModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md">
    <div class="bg-white w-full max-w-xl rounded-2xl p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 id="modalEmpTitle" class="text-xl font-black text-slate-900 italic">Tambah Karyawan</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Lengkapi entitas data login dan penugasan karyawan ke database.</p>
            </div>
            <button onclick="closeEmpModal()" class="p-2 hover:bg-slate-100 rounded-full transition-colors text-slate-400">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="empForm" method="POST" class="space-y-4">
            @csrf
            <!-- Slot untuk mengizinkan method PUT saat Edit -->
            <div id="methodField"></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">ID Karyawan</label>
                    <input type="text" name="id_kerja" id="inputEmpId" placeholder="Contoh: EMP-33125" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                </div>
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Level Akses / Role</label>
                    <select name="role" id="inputJabatan" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm">
                        <option value="Karyawan">Karyawan (Dashboard Staff)</option>
                        <option value="Admin Pembuat Aplikasi">Admin 1: Pembuat Aplikasi (Super Admin)</option>
                        <option value="CEO / Direksi">Admin 2: Jabatan Tertinggi (CEO/HRD/Manager)</option>
                        <option value="Admin Perusahaan">Admin 3: Admin Operasional Perusahaan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Nama Lengkap</label>
                    <input type="text" name="name" id="inputEmpName" placeholder="Nama lengkap karyawan..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                </div>
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic" id="labelPassword">Password Akses Akun</label>
                    <input type="text" name="password" id="inputPassword" minlength="8" placeholder="Masukkan password..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">No. WhatsApp / HP</label>
                    <input type="tel" name="no_hp" id="inputNoHp" placeholder="Contoh: 08123456789" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                </div>
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Email Perusahaan</label>
                    <input type="email" name="email" id="inputEmail" placeholder="nama@company.com" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm" required>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Divisi Perusahaan</label>
                <select name="divisi" id="inputEmpDiv" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:bg-white outline-none transition-all font-bold text-sm">
                    <option value="IT Dept">Pusat Data & IT</option>
                    <option value="Keuangan">Biro Keuangan</option>
                    <option value="HR Dept">SDM / HRD</option>
                    <option value="Marketing">Humas & Pemasaran</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Status Hubungan Kerja</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="Aktif" id="radioAktif" class="hidden peer" checked>
                        <div class="p-2 text-center rounded-xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 text-slate-400 peer-checked:text-emerald-700 text-[10px] font-black uppercase transition-all">Aktif</div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="Cuti" id="radioCuti" class="hidden peer">
                        <div class="p-2 text-center rounded-xl border-2 border-slate-100 peer-checked:border-amber-500 peer-checked:bg-amber-50 text-slate-400 peer-checked:text-amber-700 text-[10px] font-black uppercase transition-all">Cuti</div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="Non-Aktif" id="radioNonAktif" class="hidden peer">
                        <div class="p-2 text-center rounded-xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50 text-slate-400 peer-checked:text-rose-700 text-[10px] font-black uppercase transition-all">Non-Aktif</div>
                    </label>
                </div>
            </div>

            <div class="flex space-x-3 pt-2">
                <button type="button" onclick="closeEmpModal()" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-black uppercase text-[11px] tracking-widest hover:bg-slate-200 transition-all">Batal</button>
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-black uppercase text-[11px] tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT OPERASIONAL MANAJEMEN KARYAWAN -->
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    function closeEmpModal() {
        document.getElementById('empModal').classList.add('hidden');
    }

    function openAddModal() {
        document.getElementById('modalEmpTitle').innerText = 'Tambah Personel Baru';
        document.getElementById('empForm').action = "{{ route('admin.karyawan.store') }}";
        document.getElementById('methodField').innerHTML = ''; // Kosongkan method field (murni POST)
        document.getElementById('empForm').reset();
        
        document.getElementById('inputPassword').required = true;
        document.getElementById('labelPassword').innerText = "Password Akses Akun (Min 8 Karakter)";
        document.getElementById('radioAktif').checked = true;
        
        document.getElementById('empModal').classList.remove('hidden');
    }

    function openEditModal(karyawan) {
        document.getElementById('modalEmpTitle').innerText = 'Edit Data Karyawan';
        
        // Melempar form action ke rute Update Karyawan
        document.getElementById('empForm').action = "/admin/karyawan/update/" + karyawan.id;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        // Memasukkan data ke input modal
        document.getElementById('inputEmpId').value = karyawan.id_kerja;
        document.getElementById('inputEmpName').value = karyawan.name;
        document.getElementById('inputJabatan').value = karyawan.role;
        document.getElementById('inputNoHp').value = karyawan.no_hp;
        document.getElementById('inputEmail').value = karyawan.email;
        document.getElementById('inputEmpDiv').value = karyawan.divisi;
        
        // Aturan edit password (opsional)
        document.getElementById('inputPassword').required = false;
        document.getElementById('inputPassword').value = '';
        document.getElementById('labelPassword').innerText = "Password Baru (Kosongkan jika tidak diubah)";

        // Menyesuaikan Radio Button Status
        if(karyawan.status === 'Aktif') document.getElementById('radioAktif').checked = true;
        if(karyawan.status === 'Cuti') document.getElementById('radioCuti').checked = true;
        if(karyawan.status === 'Non-Aktif') document.getElementById('radioNonAktif').checked = true;

        document.getElementById('empModal').classList.remove('hidden');
    }

    function filterEmpTable() {
        const query = document.getElementById('searchKaryawan').value.toLowerCase();
        const rows = document.querySelectorAll('#empTableBody tr');
        let matchCount = 0;

        rows.forEach(row => {
            if (row.cells.length > 1) {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
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
</script>