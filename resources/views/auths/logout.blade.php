<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Berakhir | Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white shadow-2xl rounded-3xl overflow-hidden text-center p-10 relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-blue-600"></div>
        
        <div class="mb-8 flex justify-center">
            <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-4xl shadow-inner border border-blue-100">
                <i class="bi bi-box-arrow-right"></i>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-2">Anda Telah Keluar</h1>
        <p class="text-gray-500 leading-relaxed mb-8">
            Terima kasih telah menggunakan **PresensiHub**. Sesi Anda telah diakhiri dengan aman untuk menjaga privasi data.
        </p>

        <div class="space-y-4">
            <a href="{{ route('login') }}" 
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-300 shadow-lg shadow-blue-200 transform active:scale-[0.98]">
                Masuk Kembali
            </a>
            
            <p class="text-xs text-gray-400 pt-4">
                © 2026 Integrated Attendance Management System
            </p>
        </div>
    </div>

</body>
</html>