@extends('layouts.app')

@section('title', 'Daftar Akun Baru | PresensiHub')

@section('body-class', 'bg-slate-50 text-slate-900')

@section('content')
<section class="w-full min-h-[calc(100vh-80px)] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 relative z-10">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-200 rounded-full blur-[120px] opacity-30 -z-10"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-200 rounded-full blur-[120px] opacity-20 -z-10"></div>

    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white/80 backdrop-blur-md shadow-2xl rounded-[2.5rem] border border-slate-200/60 overflow-hidden">
        
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-indigo-500 rounded-full opacity-30 blur-sm"></div>
            <div class="absolute bottom-0 left-0 -ml-12 -mb-12 w-48 h-48 bg-blue-600 rounded-full opacity-30 blur-sm"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.05),transparent_70%)]"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20 shadow-lg">
                        <i class="bi bi-person-check-fill text-white text-lg"></i>
                    </div>
                    <span class="font-black text-base tracking-wider uppercase italic text-white">
                        Presensi<span class="text-indigo-300">Hub</span>
                    </span>
                </div>

                <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6 border border-white/10 shadow-inner">
                    <i class="bi bi-person-plus-fill text-xl text-indigo-200"></i>
                </div>
                <h2 class="text-3xl font-black leading-tight tracking-tight">Bergabung dengan<br>Ekosistem Modern</h2>
                <p class="mt-4 text-indigo-100/80 text-xs leading-relaxed font-medium">
                    Kelola kehadiran, pengajuan izin digital, serta unduh rekapitulasi laporan berkas secara efisien, transparan, dan akurat di dalam satu platform terpadu.
                </p>
            </div>
            
            <div class="relative z-10 border-t border-white/10 pt-4">
                <p class="text-[10px] font-bold uppercase tracking-widest text-indigo-300/80">PBL Project Platform</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 sm:p-10 md:p-12 flex flex-col justify-center bg-white">
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Buat Akun Baru</h1>
                <p class="text-slate-400 text-xs font-medium mt-1">Silakan lengkapi data administratif Anda untuk mendaftar ke sistem.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                            <i class="bi bi-person text-base"></i>
                        </span>
                        <input type="text" name="name" 
                            class="w-full pl-10 pr-4 py-3 bg-slate-50/60 border border-slate-200/80 rounded-xl font-medium text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all duration-200 @error('name') border-red-400 bg-red-50/30 @enderror" 
                            placeholder="Contoh: Samuel Ambar Pasaribu" required value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-[10px] mt-1.5 font-semibold flex items-center"><i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                            <i class="bi bi-envelope text-base"></i>
                        </span>
                        <input type="email" name="email" 
                            class="w-full pl-10 pr-4 py-3 bg-slate-50/60 border border-slate-200/80 rounded-xl font-medium text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all duration-200 @error('email') border-red-400 bg-red-50/30 @enderror" 
                            placeholder="samuel@arthurteknik.com" required value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1.5 font-semibold flex items-center"><i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Daftar Sebagai</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                            <i class="bi bi-shield-lock text-base"></i>
                        </span>
                        <select name="role" class="w-full pl-10 pr-10 py-3 bg-slate-50/60 border border-slate-200/80 rounded-xl font-semibold text-sm text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all duration-200 cursor-pointer appearance-none">
                            <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan (User Absensi)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pengelola Sistem)</option> 
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400">
                            <i class="bi bi-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Password</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200/80 rounded-xl font-medium text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all duration-200 @error('password') border-red-400 bg-red-50/30 @enderror" 
                            placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200/80 rounded-xl font-medium text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all duration-200" 
                            placeholder="••••••••" required>
                    </div>
                </div>
                @error('password')
                    <p class="text-red-500 text-[10px] mt-1.5 font-semibold flex items-center"><i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror

                <button type="submit" 
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl transition duration-200 shadow-xl shadow-indigo-200 mt-6 transform active:scale-[0.98] text-xs uppercase tracking-wider">
                    Daftar Sekarang
                </button>
                
                <div class="text-center mt-6 text-xs font-medium text-slate-400">
                    Sudah memiliki akun terdaftar? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-bold decoration-2 underline-offset-4 hover:underline ml-1">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection