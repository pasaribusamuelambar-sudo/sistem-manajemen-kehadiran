<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PresensiHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white shadow-2xl rounded-[40px] overflow-hidden border border-slate-100">
        
        <div class="hidden md:flex md:w-1/2 bg-indigo-600 p-16 flex-col justify-between text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur-xl border border-white/30">
                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                </div>
                <h2 class="text-4xl font-extrabold leading-[1.2] tracking-tight">Kelola Absensi <br> Jauh Lebih Mudah</h2>
                <p class="mt-6 text-indigo-100 font-medium text-lg leading-relaxed">Masuk untuk mengakses Home Admin dan pantau kehadiran karyawan secara real-time.</p>
            </div>
            
            <div class="relative z-10">
                <div class="flex items-center space-x-3 text-sm font-bold bg-white/10 w-fit px-4 py-2 rounded-full backdrop-blur-md">
                    <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-ping"></span>
                    <span class="text-indigo-50 tracking-wide uppercase text-xs">Sistem Terenkripsi & Aman</span>
                </div>
            </div>

            <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -bottom-20 -right-10 w-80 h-80 bg-violet-700 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="w-full md:w-1/2 p-10 md:p-20 flex flex-col justify-center">
            <div class="mb-12">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Login Sistem</h1>
                <p class="text-slate-500 font-medium mt-3">Silakan masukkan akun Admin Anda.</p>
            </div>

            @if($errors->any())
            <div class="mb-8 p-4 bg-rose-50 border border-rose-100 rounded-2xl flex items-center space-x-3 text-rose-600">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <p class="text-sm font-bold">{{ $errors->first() }}</p>
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Alamat Email</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </span>
                        <input type="email" name="email" 
                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all font-semibold placeholder:text-slate-300" 
                            placeholder="admin@presensihub.com" required value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-3 ml-1">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Password</label>
                        <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Lupa Sandi?</a>
                    </div>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </span>
                        <input type="password" name="password" 
                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all font-semibold placeholder:text-slate-300" 
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center space-x-3 ml-1">
                    <input type="checkbox" id="remember" class="w-5 h-5 text-indigo-600 border-slate-300 rounded-lg focus:ring-indigo-500 cursor-pointer">
                    <label for="remember" class="text-sm text-slate-500 font-medium cursor-pointer">Ingat perangkat ini</label>
                </div>
                <!-- Input Pilihan Role -->
<div>
    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Daftar Sebagai</label>
    <div class="relative group">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-600 transition-colors">
            <i data-lucide="users" class="w-5 h-5"></i>
        </span>
        <select name="role" required
            class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all font-semibold appearance-none cursor-pointer">
            <option value="" disabled selected>Pilih Role Anda</option>
            <option value="karyawan">Karyawan (Staff)</option>
            <option value="admin">Admin (HR)</option>
        </select>
        <!-- Icon panah kustom untuk select -->
        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
            <i data-lucide="chevron-down" class="w-5 h-5"></i>
        </span>
    </div>
</div>
                <button type="submit" 
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl transition-all duration-300 shadow-xl shadow-indigo-200 transform active:scale-[0.98]">
                    Masuk Sekarang
                </button>
            </form>
            
            <p class="text-center mt-10 text-sm text-slate-500 font-medium">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-extrabold hover:underline transition-all">Daftar Admin(Hr)</a>
                <a href="{{ route('register') }}" class="text-indigo-600 font-extrabold hover:underline transition-all">Daftar Karyawan(staff)</a>
            </p>
        </div>
    </div>

    <script>
      lucide.createIcons();
    </script>
</body>
</html>