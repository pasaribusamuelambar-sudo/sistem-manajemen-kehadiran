<!-- KONTEN UTAMA KELOLA IZIN ADMIN -->
<div class="space-y-6 w-full mx-auto pb-16">
    <div>
        <h1 class="text-2xl font-black tracking-tight text-slate-800 italic">Manajemen Otorisasi Izin & Cuti</h1>
        <p class="text-xs text-slate-500 font-semibold mt-0.5">Berikan persetujuan atau penolakan pengajuan izin karyawan secara legal.</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 flex items-center justify-between text-xs font-semibold shadow-sm">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    {{-- Main Table View Data Admin --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[850px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="p-4">Karyawan</th>
                        <th class="p-4">Jenis Permohonan</th>
                        <th class="p-4">Masa Izin</th>
                        <th class="p-4">Alasan</th>
                        <th class="p-4">Dokumen Bukti</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-600">
                    @forelse($izinData as $item)
                    <tr class="hover:bg-slate-50/40 transition">
                        <td class="p-4">
                            <div class="font-bold text-slate-800">{{ $item->nama }}</div>
                            <div class="text-[10px] text-slate-400 font-medium">{{ $item->role }}</div>
                        </td>
                        <td class="p-4 font-semibold text-slate-700">{{ $item->jenis_izin }}</td>
                        <td class="p-4 font-medium text-slate-500">
                            <div>{{ $item->mulai }}</div>
                            <div class="text-[10px] text-slate-400">s/d {{ $item->selesai }}</div>
                        </td>
                        <td class="p-4 max-w-xs truncate" title="{{ $item->alasan }}">{{ $item->alasan }}</td>
                        <td class="p-4">
                            @if($item->bukti)
                                <button onclick="openModalPreview('{{ asset('storage/' . $item->bukti) }}')" class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 py-1.5 rounded-lg font-bold text-[11px] inline-flex items-center gap-1.5 transition cursor-pointer">
                                    <i class="fa-solid fa-file-medical"></i> Periksa Berkas
                                </button>
                            @else
                                <span class="text-slate-400 italic">No Dokumen</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold 
                                {{ $item->status == 'Disetujui' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                {{ $item->status == 'Ditolak' ? 'bg-rose-50 text-rose-700 border border-rose-200' : '' }}
                                {{ $item->status == 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if($item->status == 'Pending')
                                <button onclick="openAksiModal({{ $item->id }}, '{{ $item->nama }}')" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-[11px] px-3 py-1.5 rounded-lg transition cursor-pointer">
                                    Tinjau Kelayakan
                                </button>
                            @else
                                <div class="text-[11px] text-slate-400 max-w-[150px] truncate italic" title="{{ $item->catatan_admin ?? 'Tidak ada catatan' }}">
                                    Catatan: {{ $item->catatan_admin ?? '-' }}
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400 font-medium">Tidak ada data permohonan izin masuk di database.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL PREVIEW SURAT DOKTER --}}
<div id="modal-preview-berkas" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-[100] flex items-center justify-center p-4 hidden">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl overflow-hidden flex flex-col h-[80vh]">
        <div class="p-4 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
            <h3 class="text-xs font-bold text-slate-800"><i class="fa-solid fa-file-invoice text-blue-600 mr-1.5"></i> Dokumen Lampiran Karyawan</h3>
            <button onclick="closeModalPreview()" class="text-slate-400 hover:text-slate-600 text-lg font-bold p-1 cursor-pointer">&times;</button>
        </div>
        <div id="preview-content-area" class="p-6 bg-slate-100 flex-1 flex items-center justify-center overflow-auto">
            {{-- Di-inject via Javascript secara dinamis --}}
        </div>
    </div>
</div>

{{-- MODAL KEPUTUSAN ADMIN & CATATAN PESAN --}}
<div id="modal-aksi-admin" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-[100] flex items-center justify-center p-4 hidden">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-5 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-xs">Otorisasi Permohonan: <span id="target-nama-karyawan" class="text-blue-600"></span></h3>
            <button onclick="closeAksiModal()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>
        
        <form id="form-modal-aksi" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PATCH')
            
            <input type="hidden" name="status" id="modal-action-status" value="Pending">
            
            <div>
                <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5 tracking-wider">Tulis Catatan / Alasan Keputusan <span class="text-rose-500">*</span></label>
                <textarea id="modal-action-message" name="catatan_admin" rows="4" required placeholder="Tulis alasan persetujuan atau penolakan di sini..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:outline-none focus:border-slate-900 focus:bg-white transition"></textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="submitOtorisasi('Ditolak')" class="flex-1 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold py-3 rounded-xl transition border border-rose-200 cursor-pointer">Tolak Izin</button>
                <button type="button" onclick="submitOtorisasi('Disetujui')" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-3 rounded-xl transition shadow-md shadow-emerald-600/10 cursor-pointer">Setujui Izin</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalPreview(fileUrl) {
        const container = document.getElementById('preview-content-area');
        const modal = document.getElementById('modal-preview-berkas');
        
        if(fileUrl.toLowerCase().endsWith('.pdf')) {
            container.innerHTML = `<iframe src="${fileUrl}" class="w-full h-full rounded-xl border border-slate-200" frameborder="0"></iframe>`;
        } else {
            container.innerHTML = `<img src="${fileUrl}" alt="Surat Dokumen" class="max-w-full max-h-full object-contain rounded-xl shadow-sm">`;
        }
        modal.classList.remove('hidden');
    }

    function closeModalPreview() {
        document.getElementById('modal-preview-berkas').classList.add('hidden');
        document.getElementById('preview-content-area').innerHTML = '';
    }

    function openAksiModal(id, nama) {
        document.getElementById('target-nama-karyawan').textContent = nama;
        document.getElementById('form-modal-aksi').action = `/admin/kelola-izin/${id}/status`;
        
        const modal = document.getElementById('modal-aksi-admin');
        modal.classList.remove('hidden');
    }

    function closeAksiModal() {
        document.getElementById('modal-aksi-admin').classList.add('hidden');
        document.getElementById('modal-action-message').value = '';
    }

    function submitOtorisasi(keputusanStatus) {
        const pesanTxt = document.getElementById('modal-action-message').value.trim();
        if(!pesanTxt) {
            alert('Pesan catatan balasan wajib diisi!');
            return;
        }
        
        document.getElementById('modal-action-status').value = keputusanStatus;
        document.getElementById('form-modal-aksi').submit();
    }
</script>