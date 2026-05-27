<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Pengembang | PresenceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#fcfdfe] text-slate-900 overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/70 backdrop-blur-lg border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-11 h-11 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                    <i class="bi bi-person-check-fill text-white text-xl"></i>
                </div>
                <span class="font-extrabold text-xl tracking-tight uppercase italic text-slate-800">Presence<span class="text-blue-600">Hub</span></span>
            </div>
            <div class="hidden md:flex space-x-10 font-semibold text-sm text-slate-600 uppercase tracking-widest">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600 transition-colors">Home</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600 transition-colors">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="text-blue-600">Kontak Kami</a>
            </div>
        </div>
    </nav>

    <section class="pt-40 pb-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h1 class="text-5xl font-extrabold mb-4 italic">Tim <span class="text-blue-600">Pengembang</span></h1>
                <p class="text-slate-500 font-medium tracking-wide uppercase text-xs">PBL Project Team - Politeknik Negeri Batam</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-100/50 flex flex-col items-center text-center group hover:-translate-y-2 transition-all duration-300">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mb-6 overflow-hidden border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name=Samuel+Pasaribu&background=0D8ABC&color=fff" alt="Foto Profil" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-1">SAMUEL AMBAR PASARIBU</h3>
                    <p class="text-blue-600 text-[10px] font-black uppercase tracking-widest mb-4 italic">DIREKTUR KEUANGAN</p>
                    <div class="w-full bg-slate-50 rounded-2xl p-4 mb-6 space-y-2">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">NIM Polibatam</p>
                        <p class="text-sm font-bold text-slate-700">3312511048</p> 
                    </div>
                    <div class="flex space-x-3 w-full">
                        <a href="https://wa.me/6282170378193" class="flex-1 bg-green-500 text-white p-3 rounded-xl hover:bg-green-600 transition text-lg shadow-lg shadow-green-100"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:pasaribusamuelambar@gmail.com" class="flex-1 bg-blue-600 text-white p-3 rounded-xl hover:bg-blue-700 transition text-lg shadow-lg shadow-blue-100"><i class="bi bi-envelope"></i></a>
                        <a href="https://www.instagram.com/s13samuel.a.pasaribu0307?igsh=MTF4ZnBheWZhZmRheA==" class="flex-1 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 text-white p-3 rounded-xl hover:opacity-90 transition text-lg"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-100/50 flex flex-col items-center text-center group hover:-translate-y-2 transition-all duration-300">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mb-6 overflow-hidden border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name=Aditya+Kurniawan&background=6366f1&color=fff" alt="Foto Profil" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-1">Aditya Rizki Kurniawan</h3>
                    <p class="text-blue-600 text-[10px] font-black uppercase tracking-widest mb-4 italic">Manager Proyek</p>
                    <div class="w-full bg-slate-50 rounded-2xl p-4 mb-6 space-y-2">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">NIM Polibatam</p>
                        <p class="text-sm font-bold text-slate-700">3312511054</p>
                    </div>
                    <div class="flex space-x-3 w-full">
                        <a href="#" class="flex-1 bg-green-500 text-white p-3 rounded-xl hover:bg-green-600 transition text-lg"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:adityarizki.kurniawan@gmail.com" class="flex-1 bg-blue-600 text-white p-3 rounded-xl hover:bg-blue-700 transition text-lg"><i class="bi bi-envelope"></i></a>
                        <a href="#" class="flex-1 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 text-white p-3 rounded-xl hover:opacity-90 transition text-lg"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-100/50 flex flex-col items-center text-center group hover:-translate-y-2 transition-all duration-300">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mb-6 overflow-hidden border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name=Hoirul+Farhan&background=1e293b&color=fff" alt="Foto Profil" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-1">Muhammad Hoirul Farhan</h3>
                    <p class="text-blue-600 text-[10px] font-black uppercase tracking-widest mb-4 italic">Senior Operator</p>
                    <div class="w-full bg-slate-50 rounded-2xl p-4 mb-6 space-y-2">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">NIM Polibatam</p>
                        <p class="text-sm font-bold text-slate-700">3312511034</p>
                    </div>
                    <div class="flex space-x-3 w-full">
                        <a href="#" class="flex-1 bg-green-500 text-white p-3 rounded-xl hover:bg-green-600 transition text-lg"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:muhammad.hoirul.farhan@gmail.com" class="flex-1 bg-blue-600 text-white p-3 rounded-xl hover:bg-blue-700 transition text-lg"><i class="bi bi-envelope"></i></a>
                        <a href="#" class="flex-1 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 text-white p-3 rounded-xl hover:opacity-90 transition text-lg"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</body>
</html>