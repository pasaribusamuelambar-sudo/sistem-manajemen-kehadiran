<div class="bg-white rounded-[40px] border border-slate-100 shadow-sm overflow-hidden animate-in slide-in-from-bottom duration-500">
    <div class="p-8 border-b border-slate-50 flex justify-between items-center">
        <h2 class="font-black text-slate-800 ...">
    Daftar Karyawan: 
    <span class="text-indigo-600 ml-1">
        {{ ucwords(str_replace('_', ' ', $statusFilter)) }}
    </span>
</h2>
        <a href="{{ route('home_admin') }}" class="text-[10px] font-black text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-[0.2em]">
            ✕ Tutup Detail
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">Karyawan</th>
                    <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100">Divisi</th>
                    <th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-100 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($data as $item)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-xs">
                                {{ substr($item->nama_lengkap, 0, 2) }}
                            </div>
                            <div>
                                <p class="font-black text-slate-900 text-sm uppercase italic">{{ $item->nama_lengkap }}</p>
                                <p class="text-[9px] text-slate-400 font-bold tracking-widest uppercase">{{ $item->nim_atau_id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-6">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-full uppercase tracking-tighter italic">
                            {{ $item->divisi->nama_divisi ?? 'STAFF' }}
                        </span>
                    </td>
                    <td class="p-6 text-right">
                        <button class="p-2 hover:bg-indigo-50 rounded-xl transition-all text-slate-400 hover:text-indigo-600">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-20 text-center">
                        <div class="flex flex-col items-center opacity-30">
                            <i data-lucide="database" class="w-12 h-12 mb-4"></i>
                            <p class="text-sm font-black italic uppercase tracking-widest">Tidak ada data untuk kategori ini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>