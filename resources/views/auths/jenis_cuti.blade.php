<div class="space-y-5 max-w-7xl mx-auto p-1 text-slate-800 font-sans">
    
    {{-- ========================================== --}}
    {{-- SECTION 1: SISA & JATAH CUTI KARYAWAN     --}}
    {{-- ========================================== --}}
    <div class="space-y-3">
        {{-- Header Menu Jatah Cuti --}}
        <div class="flex items-center justify-between flex-wrap gap-3 pb-2 border-b border-slate-100">
            <div class="flex items-center space-x-2.5">
                <div class="bg-indigo-50 p-2 rounded-xl text-indigo-600 shadow-sm">
                    <i data-lucide="calendar-range" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base text-slate-800 tracking-tight">Sisa & Jatah Cuti Karyawan</h3>
                    <p class="text-[11px] text-slate-400 font-medium">Pantau akumulasi jatah, total terpakai, dan sisa cuti tahunan berjalan</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-2">
                <select class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:outline-none focus:border-indigo-500 transition-all cursor-pointer shadow-sm">
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                </select>
                <button onclick="openModal('modal-tambah-jatah')" class="flex items-center space-x-1.5 px-3.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all">
                    <i data-lucide="plus" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                    <span>Tambah Jatah</span>
                </button>
            </div>
        </div>

        {{-- Grid Statistik Minimalis --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-white p-3.5 rounded-xl border border-slate-200/80 shadow-sm flex items-center space-x-3">
                <div class="w-9 h-9 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600"><i data-lucide="users" class="w-4 h-4"></i></div>
                <div>
                    <span class="block text-xs font-medium text-slate-400">Total Karyawan</span>
                    <span class="text-lg font-extrabold text-slate-800 leading-none">3</span>
                </div>
            </div>
            <div class="bg-white p-3.5 rounded-xl border border-slate-200/80 shadow-sm flex items-center space-x-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600"><i data-lucide="calendar-days" class="w-4 h-4"></i></div>
                <div>
                    <span class="block text-xs font-medium text-slate-400">Total Jatah Hari</span>
                    <span class="text-lg font-extrabold text-emerald-600 leading-none">36</span>
                </div>
            </div>
            <div class="bg-white p-3.5 rounded-xl border border-slate-200/80 shadow-sm flex items-center space-x-3">
                <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600"><i data-lucide="pie-chart" class="w-4 h-4"></i></div>
                <div>
                    <span class="block text-xs font-medium text-slate-400">Total Terpakai</span>
                    <span class="text-lg font-extrabold text-amber-500 leading-none">22</span>
                </div>
            </div>
        </div>

        {{-- Tabel Sisa Cuti Karyawan Minimalis --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/70">
                            <th class="py-3 px-4">Karyawan</th>
                            <th class="py-3 px-4">Jenis Cuti</th>
                            <th class="py-3 px-4 text-center">Tahun</th>
                            <th class="py-3 px-4 text-center">Jatah</th>
                            <th class="py-3 px-4 text-center">Terpakai</th>
                            <th class="py-3 px-4 text-center">Sisa</th>
                            <th class="py-3 px-4 w-40">Progress</th>
                            <th class="py-3 px-4 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-700">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-2.5 px-4 flex items-center space-x-2.5">
                                <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-[10px] font-bold">A</div>
                                <span class="font-bold text-slate-800">Aditya Rizki Kurniaawan</span>
                            </td>
                            <td class="py-2.5 px-4 text-slate-500 font-medium">Izin Pribadi</td>
                            <td class="py-2.5 px-4 text-center text-slate-500 font-medium">2026</td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[11px] rounded-md font-medium">12 hari</span></td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[11px] rounded-md font-medium">0 hari</span></td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[11px] rounded-md font-bold">12 hari</span></td>
                            <td class="py-2.5 px-4">
                                <div class="flex items-center space-x-1.5">
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-indigo-500 h-full rounded-full" style="width: 0%"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium">0%</span>
                                </div>
                            </td>
                            <td class="py-2.5 px-4 text-right pr-6">
                                <div class="flex items-center justify-end space-x-1">
                                    <button class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                                    <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-2.5 px-4 flex items-center space-x-2.5">
                                <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-[10px] font-bold">D</div>
                                <span class="font-bold text-slate-800">Dewi Lestari</span>
                            </td>
                            <td class="py-2.5 px-4 text-slate-500 font-medium">Cuti Game</td>
                            <td class="py-2.5 px-4 text-center text-slate-500 font-medium">2026</td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[11px] rounded-md font-medium">12 hari</span></td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[11px] rounded-md font-medium">10 hari</span></td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-amber-50 text-amber-600 text-[11px] rounded-md font-bold">2 hari</span></td>
                            <td class="py-2.5 px-4">
                                <div class="flex items-center space-x-1.5">
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-amber-500 h-full rounded-full" style="width: 83%"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium">83%</span>
                                </div>
                            </td>
                            <td class="py-2.5 px-4 text-right pr-6">
                                <div class="flex items-center justify-end space-x-1">
                                    <button class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                                    <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-2.5 px-4 flex items-center space-x-2.5">
                                <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-[10px] font-bold">S</div>
                                <span class="font-bold text-slate-800">Samuel Ambar Pasaribu</span>
                            </td>
                            <td class="py-2.5 px-4 text-slate-500 font-medium">Cuti Tahunan</td>
                            <td class="py-2.5 px-4 text-center text-slate-500 font-medium">2026</td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[11px] rounded-md font-medium">12 hari</span></td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[11px] rounded-md font-medium">12 hari</span></td>
                            <td class="py-2.5 px-4 text-center"><span class="px-2 py-0.5 bg-rose-50 text-rose-600 text-[11px] rounded-md font-bold">0 hari</span></td>
                            <td class="py-2.5 px-4">
                                <div class="flex items-center space-x-1.5">
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-rose-500 h-full rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium">100%</span>
                                </div>
                            </td>
                            <td class="py-2.5 px-4 text-right pr-6">
                                <div class="flex items-center justify-end space-x-1">
                                    <button class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                                    <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Separator Tipis --}}
    <div class="h-px bg-slate-200/60 my-2"></div>

    {{-- ========================================== --}}
    {{-- SECTION 2: CONFIG / MASTER DATA JENIS CUTI --}}
    {{-- ========================================== --}}
    <div class="space-y-3">
        {{-- Header Menu Jenis Cuti --}}
        <div class="flex items-center justify-between flex-wrap gap-3 pb-2 border-b border-slate-100">
            <div class="flex items-center space-x-2.5">
                <div class="bg-indigo-50 p-2 rounded-xl text-indigo-600 shadow-sm">
                    <i data-lucide="settings-2" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base text-slate-800 tracking-tight">Master Konfigurasi Jenis Cuti</h3>
                    <p class="text-[11px] text-slate-400 font-medium">Atur durasi maksimal regulasi untuk masing-masing hak operasional cuti</p>
                </div>
            </div>
            
            <button onclick="openModal('modal-tambah-jenis-cuti')" class="flex items-center space-x-1.5 px-3.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all">
                <i data-lucide="plus" class="w-3.5 h-3.5 stroke-[2.5]"></i>
                <span>Tambah Jenis Cuti</span>
            </button>
        </div>

        {{-- Tabel Utama Durasi Jenis Cuti Minimalis --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/70">
                        <th class="py-3 px-5">Jenis Izin/Cuti</th>
                        <th class="py-3 px-5">Durasi Batas Maksimal</th>
                        <th class="py-3 px-5 text-right pr-6">Aksi Pengelolaan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-700">
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-2.5 px-5 font-bold text-slate-800">Cuti Game</td>
                        <td class="py-2.5 px-5 text-slate-500 font-medium">5 hari kerja</td>
                        <td class="py-2.5 px-5 text-right pr-6">
                            <div class="flex items-center justify-end space-x-1">
                                <button onclick="openModal('modal-edit-jenis-cuti', 'Cuti Game', 5)" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                                <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-2.5 px-5 font-bold text-slate-800">Cuti Tahunan</td>
                        <td class="py-2.5 px-5 text-slate-500 font-medium">12 hari kerja</td>
                        <td class="py-2.5 px-5 text-right pr-6">
                            <div class="flex items-center justify-end space-x-1">
                                <button onclick="openModal('modal-edit-jenis-cuti', 'Cuti Tahunan', 12)" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                                <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-2.5 px-5 font-bold text-slate-800">Cuti Sakit</td>
                        <td class="py-2.5 px-5 text-slate-500 font-medium">14 hari kerja</td>
                        <td class="py-2.5 px-5 text-right pr-6">
                            <div class="flex items-center justify-end space-x-1">
                                <button onclick="openModal('modal-edit-jenis-cuti', 'Cuti Sakit', 14)" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                                <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ========================================== --}}
{{-- MODAL SYSTEM (FIXED STRUCTURE)            --}}
{{-- ========================================== --}}
<div id="modal-backdrop-cuti" class="fixed inset-0 bg-slate-900/40 z-[999] hidden opacity-0 transition-opacity duration-200 backdrop-blur-[2px]"></div>

{{-- Modal Tambah Jenis Cuti --}}
<div id="modal-tambah-jenis-cuti" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl p-5 shadow-xl z-[1000] hidden opacity-0 scale-95 transition-all duration-200">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-base text-slate-800">Tambah Jenis Cuti</h3>
        <button onclick="closeModal('modal-tambah-jenis-cuti')" class="p-1.5 hover:bg-slate-100 rounded-lg text-slate-400 hover:text-slate-600 transition-all">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    <form action="#" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-600 mb-1.5">Jenis Izin/Cuti</label>
            <input type="text" placeholder="Contoh: Cuti Khusus" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-600 mb-1.5">Durasi Maksimal (hari)</label>
            <input type="number" value="1" min="1" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
        </div>
        <div class="flex items-center justify-end space-x-2 pt-2">
            <button type="button" onclick="closeModal('modal-tambah-jenis-cuti')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-xl transition-all">Batal</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all">Simpan</button>
        </div>
    </form>
</div>

{{-- Modal Edit Jenis Cuti --}}
<div id="modal-edit-jenis-cuti" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm bg-white rounded-2xl p-5 shadow-xl z-[1000] hidden opacity-0 scale-95 transition-all duration-200">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-base text-slate-800">Edit Jenis Cuti</h3>
        <button onclick="closeModal('modal-edit-jenis-cuti')" class="p-1.5 hover:bg-slate-100 rounded-lg text-slate-400 hover:text-slate-600 transition-all">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    <form action="#" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-600 mb-1.5">Jenis Izin/Cuti</label>
            <input id="edit-jenis-name" type="text" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-600 mb-1.5">Durasi Maksimal (hari)</label>
            <input id="edit-jenis-duration" type="number" min="1" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
        </div>
        <div class="flex items-center justify-end space-x-2 pt-2">
            <button type="button" onclick="closeModal('modal-edit-jenis-cuti')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-xl transition-all">Batal</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all">Simpan</button>
        </div>
    </form>
</div>

{{-- ========================================== --}}
{{-- JAVASCRIPT CONTROLLER                      --}}
{{-- ========================================== --}}
<script>
    function openModal(modalId, name = '', duration = '') {
        const backdrop = document.getElementById('modal-backdrop-cuti');
        const modal = document.getElementById(modalId);
        
        if(modalId === 'modal-edit-jenis-cuti') {
            document.getElementById('edit-jenis-name').value = name;
            document.getElementById('edit-jenis-duration').value = duration;
        }

        if(backdrop && modal) {
            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                backdrop.classList.add('opacity-100');
                modal.classList.remove('opacity-0', 'scale-95');
                modal.classList.add('opacity-100', 'scale-100');
            }, 20);
        }
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function closeModal(modalId) {
        const backdrop = document.getElementById('modal-backdrop-cuti');
        const modal = document.getElementById(modalId);

        if(modal && backdrop) {
            modal.classList.remove('opacity-100', 'scale-100');
            modal.classList.add('opacity-0', 'scale-95');
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                backdrop.classList.add('hidden');
            }, 200);
        }
    }
</script>