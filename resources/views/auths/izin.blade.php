<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Izin & Cuti Karyawan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased p-4 sm:p-8">

    <div class="max-w-6xl mx-auto space-y-6 pb-16">
        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black tracking-tight text-slate-800 italic">Pengajuan Izin & Cuti Karyawan</h1>
                <p class="text-xs text-slate-500 font-semibold mt-0.5">Isi formulir di bawah untuk mengajukan permohonan izin atau sakit secara resmi.</p>
            </div>
            <a href="{{ url('/karyawan/dashboard') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold px-4 py-2 rounded-xl transition inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- NOTIFIKASI SUKSES -->
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

        <!-- FORM INPUT PENGAJUAN -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 sm:p-6 shadow-sm">
            <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Jenis Permohonan <span class="text-rose-500">*</span></label>
                        <select name="jenis_izin" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-semibold text-slate-700 outline-none focus:border-indigo-600 focus:bg-white transition" required>
                            <option value="">-- Pilih Jenis Izin --</option>
                            <option value="Cuti Sakit">Cuti Sakit</option>
                            <option value="Izin Urusan Keluarga">Izin Urusan Keluarga</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Izin Keperluan Mendesak">Izin Keperluan Mendesak</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Mulai Tanggal <span class="text-rose-500">*</span></label>
                        <input type="date" name="mulai" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-semibold text-slate-700 outline-none focus:border-indigo-600 focus:bg-white transition" required>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Sampai Tanggal <span class="text-rose-500">*</span></label>
                        <input type="date" name="selesai" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-semibold text-slate-700 outline-none focus:border-indigo-600 focus:bg-white transition" required>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Alasan Permohonan <span class="text-rose-500">*</span></label>
                    <textarea name="alasan" rows="3" placeholder="Jelaskan alasan permohonan izin kamu secara singkat dan jelas..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-semibold text-slate-700 outline-none focus:border-indigo-600 focus:bg-white transition" required></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase text-slate-500 mb-1.5">Unggah Surat Dokter / Bukti (PDF/Gambar Max 2MB)</label>
                    <input type="file" name="bukti_dokumen" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl text-xs transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Kirim Pengajuan Izin</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- TABEL RIWAYAT PENGAJUAN -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100">
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Riwayat Pengajuan Permohonan Kamu</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="p-4">Jenis Permohonan</th>
                            <th class="p-4">Masa Izin</th>
                            <th class="p-4">Alasan</th>
                            <th class="p-4">Status Otorisasi</th>
                            <th class="p-4">Catatan Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-600">
                        @forelse($izinData ?? [] as $item)
                        <tr class="hover:bg-slate-50/40 transition">
                            <td class="p-4 font-bold text-slate-800">{{ $item->jenis_izin }}</td>
                            <td class="p-4 font-medium text-slate-500">
                                <div>{{ $item->mulai }}</div>
                                <div class="text-[10px] text-slate-400">s/d {{ $item->selesai }}</div>
                            </td>
                            <td class="p-4 max-w-xs truncate" title="{{ $item->alasan }}">{{ $item->alasan }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold 
                                    {{ $item->status == 'Disetujui' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                    {{ $item->status == 'Ditolak' ? 'bg-rose-50 text-rose-700 border border-rose-200' : '' }}
                                    {{ $item->status == 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-4 italic text-slate-400">
                                {{ $item->catatan_admin ?? 'Belum ada tanggapan' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 font-medium">Belum ada riwayat permohonan izin yang dikirim.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>