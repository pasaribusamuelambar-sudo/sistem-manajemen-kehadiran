<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User | Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <script src="https://unpkg.com/lucide@0.275.0/dist/lucide.min.js"></script>
<body>
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
        <div class="h-40 bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-500 relative">
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        </div>
        
        <div class="px-10 pb-10">
            <div class="relative flex flex-col md:flex-row justify-between items-center md:items-end -mt-16 mb-8 space-y-4 md:space-y-0">
                <div class="h-32 w-32 bg-white p-2 rounded-[36px] shadow-xl border border-slate-50">
                    <div class="h-full w-full bg-slate-100 rounded-[28px] flex items-center justify-center text-indigo-600">
                        <i data-lucide="user" class="w-14 h-14"></i>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button onclick="toggleModal('modal-settings')" class="px-6 py-3 bg-slate-100 text-slate-700 rounded-2xl font-bold hover:bg-slate-200 transition-all flex items-center space-x-2 group">
                        <i data-lucide="settings" class="w-4 h-4 group-hover:rotate-90 transition-transform duration-500"></i>
                        <span>Pengaturan</span>
                    </button>
                    <button onclick="toggleModal('modal-edit')" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center space-x-2">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        <span>Edit Profil</span>
                    </button>
                </div>
            </div>

            <div class="text-center md:text-left">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight italic">Samuel Ambar Pasaribu</h2>
                <div class="flex items-center justify-center md:justify-start space-x-2 mt-2">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-black uppercase tracking-widest rounded-full">Ast Keuangan</span>
                    <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                    <span class="text-slate-500 font-medium text-sm">Full-time Employee</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100">
                <h4 class="text-lg font-black text-slate-900 mb-8 flex items-center space-x-3 italic">
                    <i data-lucide="info" class="text-indigo-600 w-5 h-5"></i>
                    <span>Informasi Pribadi</span>
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Alamat Email</p>
                        <div class="flex items-center space-x-3 text-slate-700 font-bold italic">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            <span>samuelpasaribu@gmail.com</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Nomor Telepon</p>
                        <div class="flex items-center space-x-3 text-slate-700 font-bold">
                            <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                            <span>+62 81270378193</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">ID Karyawan (NIM)</p>
                        <div class="flex items-center space-x-3 text-slate-700 font-bold">
                            <i data-lucide="hash" class="w-4 h-4 text-slate-400"></i>
                            <span>331307-001</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Departemen</p>
                        <div class="flex items-center space-x-3 text-slate-700 font-bold italic">
                            <i data-lucide="briefcase" class="w-4 h-4 text-slate-400"></i>
                            <span>Keuangan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-indigo-900 p-8 rounded-[40px] shadow-xl shadow-indigo-100 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h4 class="text-lg font-black mb-6 italic text-indigo-100">Status Keamanan</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-indigo-300 font-medium italic">Dua Faktor (2FA)</span>
                            <span class="px-2 py-0.5 bg-emerald-500/20 text-emerald-400 rounded-md text-[10px] font-black uppercase border border-emerald-500/30">Aktif</span>
                        </div>
                        <div class="flex justify-between items-center text-sm border-t border-indigo-800 pt-4">
                            <span class="text-indigo-300 font-medium italic">Sesi Login</span>
                            <span class="font-bold">Batam, ID</span>
                        </div>
                    </div>
                    <button onclick="toggleModal('modal-password')" class="w-full mt-8 py-4 bg-white/10 hover:bg-white text-white hover:text-indigo-900 border border-white/20 rounded-2xl text-xs font-black uppercase tracking-[0.2em] transition-all duration-300">
                        Ganti Password
                    </button>
                </div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-indigo-500 rounded-full blur-3xl opacity-30"></div>
            </div>
            
            <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm text-center">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 italic">Bergabung Sejak</p>
                <p class="text-xl font-black text-slate-900 uppercase tracking-tighter italic">13-09-2025</p>
            </div>
        </div>
    </div>
</div>

<div id="modal-password" class="fixed inset-0 z-[60] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white w-full max-w-md rounded-[40px] p-10 shadow-2xl animate-in zoom-in duration-300">
        <h3 class="text-2xl font-black text-slate-900 italic mb-2">Ganti Password</h3>
        <p class="text-slate-500 text-sm mb-8 font-medium italic">Amankan akun Anda dengan password yang kuat.</p>
        
        <div class="space-y-5">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Password Lama</label>
                <input type="password" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-indigo-600 transition-all font-bold">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Password Baru</label>
                <input type="password" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-indigo-600 transition-all font-bold">
            </div>
        </div>

        <div class="flex space-x-3 mt-10">
            <button onclick="toggleModal('modal-password')" class="flex-1 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-slate-200 transition-all italic">Batal</button>
            <button class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-indigo-700 transition-all italic shadow-lg shadow-indigo-100">Simpan</button>
        </div>
    </div>
</div>

<div id="modal-edit" class="fixed inset-0 z-[60] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg rounded-[40px] p-10 shadow-2xl animate-in zoom-in duration-300">
        <h3 class="text-2xl font-black text-slate-900 italic mb-6">Perbarui Profil</h3>
        
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Nama Lengkap</label>
                <input type="text" value="Samuel Ambar Pasaribu" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-indigo-600 transition-all font-bold italic text-slate-700">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Nomor Telepon</label>
                <input type="text" value="+62 81270378193" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-indigo-600 transition-all font-bold text-slate-700">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Departemen</label>
                <input type="text" value="Keuangan" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-indigo-600 transition-all font-bold italic text-slate-700">
            </div>
        </div>

        <div class="flex space-x-3 mt-10">
            <button onclick="toggleModal('modal-edit')" class="flex-1 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-slate-200 transition-all italic">Tutup</button>
            <button class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-indigo-700 transition-all italic">Update</button>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk Buka/Tutup Modal
    function toggleModal(modalID) {
        const modal = document.getElementById(modalID);
        modal.classList.toggle('hidden');
    }

    // Render Ulang Ikon Lucide
    lucide.createIcons();
</script>

