<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PresensiHub')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-gradient-custom {
            background: radial-gradient(circle at top left, #e0e7ff 0%, #f8fafc 40%);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen overflow-x-hidden @yield('body-class', 'bg-gradient-custom text-slate-900')">

    <main class="flex-grow flex flex-col w-full @yield('main-class', 'justify-center items-center')">
        @yield('content')
    </main>

    <footer class="py-6 px-6 border-t border-indigo-100/30 bg-slate-900 w-full mt-auto">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-indigo-500 rounded-lg flex items-center justify-center shadow-sm">
                    <i class="bi bi-person-check-fill text-white text-[10px]"></i>
                </div>
                <span class="font-bold text-xs text-white tracking-wider uppercase italic">
                    Presensi<span class="text-indigo-400">Hub</span>
                </span>
            </div>
            <div class="order-3 md:order-2">
                <p class="text-slate-500 text-[9px] font-medium uppercase tracking-[0.15em] text-center">
                    © 2026 <span class="text-slate-400">Sistem Manajemen Kehadiran</span> • All Rights Reserved
                </p>
            </div>
            <div class="flex items-center space-x-5 order-2 md:order-3">
                <a href="#" class="text-slate-500 hover:text-indigo-400 transition-all duration-300"><i class="bi bi-shield-lock text-sm"></i></a>
                <a href="#" class="text-slate-500 hover:text-indigo-400 transition-all duration-300"><i class="bi bi-info-circle text-sm"></i></a>
                <div class="h-3 w-[1px] bg-slate-800"></div>
                <a href="#" class="text-slate-500 hover:text-indigo-400 transition-all duration-300"><i class="bi bi-github text-sm"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
         lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>