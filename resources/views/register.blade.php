<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4">

    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white shadow-2xl rounded-3xl overflow-hidden">
        <div class="hidden md:flex md:w-1/2 bg-blue-600 p-12 flex-col justify-between text-white relative">
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-6 backdrop-blur-md">
                    <i class="bi bi-person-plus-fill text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold leading-tight">Bergabung dengan Sistem Absensi</h2>
                <p class="mt-4 text-blue-100 font-light">Kelola kehadiran dengan lebih efisien, transparan, dan akurat di dalam satu platform terintegrasi.</p>
            </div>
            
            <div class="relative z-10">
                <p class="text-sm text-blue-200">© 2026 Sistem Manajemen Kehadiran</p>
            </div>

            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-blue-500 rounded-full opacity-50"></div>
            <div class="absolute bottom-0 left-0 -ml-12 -mb-12 w-48 h-48 bg-blue-700 rounded-full opacity-50"></div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="mb-10">
                <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm mt-2">Silakan lengkapi data di bawah ini untuk mendaftar.</p>
            </div>

            <form action="/register" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="bi bi-person text-lg"></i>
                        </span>
                        <input type="text" name="name" 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-all @error('name') border-red-500 @enderror" 
                            placeholder="Contoh: Samuel Ambar" required value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="bi bi-envelope text-lg"></i>
                        </span>
                        <input type="email" name="email" 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-all @error('email') border-red-500 @enderror" 
                            placeholder="email@perusahaan.com" required value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Daftar Sebagai</label>
    <div class="relative">
        <select name="role" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-all cursor-pointer appearance-none">
            <option value="admin">Admin (Pengelola Sistem)</option> 
            <option value="karyawan">Karyawan (User Absensi)</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>
</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Password</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-all @error('password') border-red-500 @enderror" 
                            placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Konfirmasi</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-all" 
                            placeholder="••••••••" required>
                    </div>
                </div>
                @error('password')
                    <p class="text-red-500 text-[10px] mt-1 font-medium">{{ $message }}</p>
                @enderror

                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-300 shadow-lg shadow-blue-200 mt-6 transform active:scale-[0.98]">
                    Daftar Sekarang
                </button>
                
                <div class="text-center mt-8 text-sm text-gray-500">
                    Sudah memiliki akun? 
                    <a href="/login" class="text-blue-600 hover:text-blue-700 font-bold decoration-2 underline-offset-4 hover:underline">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>