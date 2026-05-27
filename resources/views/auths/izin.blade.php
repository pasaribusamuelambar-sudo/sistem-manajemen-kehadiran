<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Izin | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Mengunci area tengah agar scroll mandiri tanpa merusak komponen layout luar */
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
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        /* Penstabil lapisan rendering agar elemen form tetap kokoh saat di-scroll */
        .render-stable {
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="content-viewport-isolated custom-scrollbar">
    <div class="p-4 md:p-8 max-w-4xl mx-auto w-full pb-16 render-stable">
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-[24px] flex items-center space-x-3 shadow-sm">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
        @endif

        {{-- Notifikasi Error Umum --}}
        @if($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-[24px] flex flex-col space-y-1 shadow-sm">
            <div class="flex items-center space-x-3">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <span class="font-bold text-sm">Terjadi kesalahan:</span>
            </div>
            <ul class="list-disc list-inside text-xs ml-8">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-start mb-12">
                    <div class="flex items-center space-x-5">
                        <div class="bg-indigo-600 p-4 rounded-[22px] shadow-lg shadow-indigo-100">
                            <i data-lucide="file-plus-2" class="text-white w-7 h-7"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight leading-tight">Pengajuan Izin</h2>
                            <p class="text-slate-400 text-sm font-semibold mt-1 italic uppercase tracking-wider">PT Arthur Teknik Indoprima</p>
                        </div>
                    </div>
                    {{-- Tombol Tutup/Kembali --}}
                    <a href="{{ route('home_karyawan') }}" class="p-3 bg-slate-50 text-slate-400 hover:text-rose-500 rounded-2xl transition-all">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </a>
                </div>

                <form action="{{ route('izin.auths') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Kategori Izin</label>
                            <select name="jenis_izin" required class="w-full px-6 py-4.5 bg-slate-50 border border-slate-200 rounded-2xl focus:border-indigo-500 outline-none font-bold text-slate-700 @error('jenis_izin') border-rose-500 @enderror">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="sakit">Sakit (Lampirkan Surat Dokter)</option>
                                <option value="umum">Izin Umum</option>
                                <option value="cuti_tahunan">Cuti Tahunan</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Dari</label>
                                <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}" required class="w-full px-4 py-4.5 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700 @error('tgl_mulai') border-rose-500 @enderror">
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Sampai</label>
                                <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}" required class="w-full px-4 py-4.5 bg-slate-50 border border-slate-200 rounded-2xl font-bold text-slate-700 @error('tgl_selesai') border-rose-500 @enderror">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Alasan Detail</label>
                        <textarea name="alasan" rows="4" required class="w-full px-6 py-5 bg-slate-50 border border-slate-200 rounded-[24px] outline-none font-medium text-slate-700 @error('alasan') border-rose-500 @enderror">{{ old('alasan') }}</textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Lampiran Bukti (Opsional)</label>
                        <div class="relative">
                            <input type="file" name="surat" id="surat" class="hidden">
                            <label for="surat" class="flex flex-col items-center justify-center w-full h-32 px-6 border-2 border-dashed border-slate-200 rounded-[24px] bg-slate-50/50 cursor-pointer hover:bg-slate-50 transition-all">
                                <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-400 mb-2"></i>
                                <span id="file-name" class="text-sm font-bold text-slate-500">Klik untuk upload dokumen (PDF/JPG)</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-6 rounded-[24px] font-black shadow-xl hover:bg-indigo-700 transition-all transform hover:-translate-y-1 active:scale-95">
                        KIRIM PENGAJUAN
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    // Preview Nama File Saat Selesai Memilih Dokumen
    document.getElementById('surat').onchange = function () {
        if(this.files.length > 0) {
            document.getElementById('file-name').innerHTML = this.files[0].name;
        }
    };
    
    // Inisialisasi Rendering Ikon Lucide Icons
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
</body>
</html>