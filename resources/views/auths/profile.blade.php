<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin | Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Mengunci area tengah agar scroll mandiri tanpa merusak Sidebar dan Header luar */
        .content-viewport-isolated {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: calc(100vh - 110px); /* Menyesuaikan batas tinggi agar tidak menabrak header */
            overflow-y: auto;             /* Guliran hanya terjadi di dalam kontainer ini */
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Desain kustom scrollbar modern yang tipis */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        /* Penstabil lapisan rendering agar element tidak melayang di browser Chromium */
        .render-stable {
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }

        /* Style tambahan untuk avatar yang sedang dipilih */
        .avatar-option {
            transition: all 0.2s ease-in-out;
        }
        .avatar-option.selected {
            border-color: #4f46e5 !important;
            background-color: #eef2ff;
            transform: scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }

        /* Transisi halus untuk Accordion Buka Tutup */
        .accordion-content {
            transition: max-height 0.3s ease-in-out, opacity 0.2s ease-in-out, padding 0.3s ease-in-out;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
        .accordion-content.open {
            max-height: 1000px; /* Nilai maksimal tinggi penampung saat terbuka */
            opacity: 1;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="content-viewport-isolated custom-scrollbar">
    <div class="p-8 space-y-8 max-w-7xl mx-auto w-full pb-16">
        
        <div class="render-stable bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
            <div class="h-48 bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-500 relative">
                <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            </div>
            
            <div class="px-10 pb-10">
                <div class="relative flex flex-col md:flex-row justify-between items-center md:items-end -mt-20 mb-8 space-y-4 md:space-y-0">
                    <div class="h-40 w-40 bg-white p-2 rounded-[44px] shadow-xl border border-slate-50 overflow-hidden">
                        <div class="h-full w-full bg-slate-100 rounded-[36px] flex items-center justify-center text-indigo-600 overflow-hidden relative">
                            <img id="mainAvatarPreview" src="" alt="Avatar Utama" class="hidden w-full h-full object-cover">
                            <i id="mainAvatarIcon" data-lucide="user" class="w-16 h-16"></i>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button onclick="toggleModal('modal-settings')" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center space-x-2 group">
                            <i data-lucide="settings" class="w-5 h-5 group-hover:rotate-90 transition-transform duration-500"></i>
                            <span>Pengaturan Akun</span>
                        </button>
                    </div>
                </div>

                <div class="text-center md:text-left">
                    <h2 id="displayName" class="text-4xl font-black tracking-tight italic text-slate-800">Samuel Ambar Pasaribu</h2>
                    <p id="displayBio" class="text-slate-500 mt-2 max-w-2xl font-medium italic">Mahasiswa Teknik Informatika Politeknik Negeri Batam.</p>
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mt-4">
                        <span id="displayRole" class="px-4 py-1.5 bg-indigo-50 text-indigo-600 text-xs font-black uppercase tracking-widest rounded-full">Administrator</span>
                        <span id="displayLocationBadge" class="px-4 py-1.5 bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest rounded-full italic">Batam, Indonesia</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="render-stable bg-white p-10 rounded-[40px] shadow-sm border border-slate-100">
                <h4 class="text-lg font-black mb-8 flex items-center space-x-3 italic">
                    <i data-lucide="info" class="text-indigo-600 w-5 h-5"></i>
                    <span>Detail Informasi</span>
                </h4>
                <div class="flex flex-wrap gap-y-8">
                    <div class="w-full sm:w-1/2 pr-4 space-y-6">
                        <div class="break-words">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Email</p>
                            <p id="displayEmail" class="font-bold text-slate-700">samuelpasaribu@gmail.com</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Telepon</p>
                            <p id="displayPhone" class="font-bold text-slate-700">+62 812 7037 8193</p>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 space-y-6 border-t sm:border-t-0 sm:border-l border-slate-100 pt-6 sm:pt-0 sm:pl-8">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Lahir</p>
                            <p id="displayBirth" class="font-bold text-slate-700 italic">13 Maret 2007</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Lokasi</p>
                            <p id="displayLocationText" class="font-bold text-slate-700">Batam, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-settings" class="fixed inset-0 z-[60] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white w-full max-w-4xl h-[85vh] rounded-[40px] shadow-2xl flex flex-col md:flex-row overflow-hidden scale-95 transition-transform duration-300">
        
        <div class="w-full md:w-64 bg-slate-50 p-8 border-r border-slate-100">
            <h3 class="text-xl font-black italic mb-8">Pengaturan</h3>
            <nav class="space-y-2">
                <button onclick="switchTab('tab-identitas')" class="tab-btn w-full flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all bg-indigo-600 text-white shadow-lg" id="btn-tab-identitas">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>Identitas</span>
                </button>
                <button onclick="switchTab('tab-keamanan')" class="tab-btn w-full flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm text-slate-500" id="btn-tab-keamanan">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    <span>Keamanan</span>
                </button>
            </nav>
        </div>

        <div class="flex-1 p-10 overflow-y-auto custom-scrollbar relative">
            <button onclick="toggleModal('modal-settings')" class="absolute top-8 right-8 text-slate-400 hover:text-slate-600 z-20">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <div id="tab-identitas" class="tab-content space-y-6">
                <h4 class="text-2xl font-black italic">Informasi Pribadi</h4>
                
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div onclick="document.getElementById('avatarInput').click()" class="h-20 w-20 bg-slate-100 rounded-[28px] border-2 border-dashed border-indigo-200 cursor-pointer flex items-center justify-center overflow-hidden group relative" title="Upload dari device">
                            <img id="modalAvatarPreview" src="" alt="Pratinjau Avatar" class="hidden w-full h-full object-cover">
                            <i id="modalAvatarIcon" data-lucide="camera" class="w-6 h-6 text-indigo-400 group-hover:scale-110 transition-transform"></i>
                        </div>
                        <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="previewFile()">
                        <div>
                            <button onclick="document.getElementById('avatarInput').click()" class="text-xs font-black uppercase text-indigo-600 tracking-wider block hover:text-indigo-700">Unggah Foto Kustom</button>
                            <p class="text-[10px] text-slate-400 mt-1">Atau pilih koleksi avatar Admin di bawah ini:</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        
                        <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
                            <button onclick="toggleAccordion('accordion-tech-dev', this)" class="w-full flex items-center justify-between px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors focus:outline-none">
                                <span class="text-[12px] font-black text-indigo-600 uppercase tracking-wider flex items-center gap-2">
                                    <i data-lucide="terminal" class="w-4 h-4"></i> Admin Tech & Developer Avatars
                                </span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-300 transform rounded-full"></i>
                            </button>
                            
                            <div id="accordion-tech-dev" class="accordion-content">
                                <div class="p-5 grid grid-cols-4 sm:grid-cols-6 gap-3 bg-white">
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/bottts/svg?seed=InformaticsCode', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Full-Stack Coder">
                                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed=InformaticsCode" alt="Full-Stack Coder" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/bottts/svg?seed=ArtificialIntelligence', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="AI Engineer">
                                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed=ArtificialIntelligence" alt="AI Engineer" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/bottts/svg?seed=CyberSecurity', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Cyber Security">
                                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed=CyberSecurity" alt="Cyber Security" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/bottts/svg?seed=DatabaseServer', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Database Master">
                                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed=DatabaseServer" alt="Database Master" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/bottts/svg?seed=PolibatamMalamB', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Informatics Scholar">
                                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed=PolibatamMalamB" alt="Informatics Scholar" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/bottts/svg?seed=LaravelFramework', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="DevOps Specialist">
                                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed=LaravelFramework" alt="DevOps Specialist" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Christian', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Tech Bro Male">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Christian" alt="Tech Bro Male" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Liam', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Casual Male">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Liam" alt="Casual Male" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/adventurer/svg?seed=Shadow', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Gamer Male">
                                        <img src="https://api.dicebear.com/7.x/adventurer/svg?seed=Shadow" alt="Gamer Male" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Mason', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Professional Male">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Mason" alt="Professional Male" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/lorelei/svg?seed=Leo', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Chibi Male">
                                        <img src="https://api.dicebear.com/7.x/lorelei/svg?seed=Leo" alt="Chibi Male" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Ava', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Tech Sis Female">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ava" alt="Tech Sis Female" class="w-full h-full object-contain rounded-xl bg-slate-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Felix&eyebrows=flatNatural&mouth=smile', this)" class="avatar-option border-2 border-slate-200 p-1 rounded-2xl cursor-pointer hover:border-indigo-400" title="Manager">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix&eyebrows=flatNatural&mouth=smile" class="w-full h-full">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Jack&top=shortCurly', this)" class="avatar-option border-2 border-slate-200 p-1 rounded-2xl cursor-pointer hover:border-indigo-400" title="Developer">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Jack&top=shortCurly" class="w-full h-full">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Avery&top=bob', this)" class="avatar-option border-2 border-slate-200 p-1 rounded-2xl cursor-pointer hover:border-indigo-400" title="Staff">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Avery&top=bob" class="w-full h-full">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Sasha&accessories=round', this)" class="avatar-option border-2 border-slate-200 p-1 rounded-2xl cursor-pointer hover:border-indigo-400" title="Finance">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sasha&accessories=round" class="w-full h-full">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/notionists/svg?seed=Jasper', this)" class="avatar-option border-2 border-slate-200 p-1 rounded-2xl cursor-pointer hover:border-indigo-400" title="Admin Tech">
                                        <img src="https://api.dicebear.com/7.x/notionists/svg?seed=Jasper" class="w-full h-full">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://api.dicebear.com/7.x/notionists/svg?seed=Lola', this)" class="avatar-option border-2 border-slate-200 p-1 rounded-2xl cursor-pointer hover:border-indigo-400" title="Female Staff 2">
                                        <img src="https://api.dicebear.com/7.x/notionists/svg?seed=Lola" class="w-full h-full">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
                            <button onclick="toggleAccordion('accordion-anime', this)" class="w-full flex items-center justify-between px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors focus:outline-none">
                                <span class="text-[12px] font-black text-orange-600 uppercase tracking-wider flex items-center gap-2">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i> Special Naruto Anime Edition
                                </span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-300 transform rounded-full"></i>
                            </button>
                            
                            <div id="accordion-anime" class="accordion-content">
                                <div class="p-5 grid grid-cols-4 sm:grid-cols-6 gap-3 bg-white">
                                    <div onclick="selectDefaultAvatar('https://img.icons8.com/color/96/naruto.png', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Naruto Uzumaki">
                                        <img src="https://img.icons8.com/color/96/naruto.png" alt="Naruto" class="w-full h-full object-contain rounded-xl bg-orange-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://img.icons8.com/color/96/sasuke-uchiha.png', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Sasuke Uchiha">
                                        <img src="https://img.icons8.com/color/96/sasuke-uchiha.png" alt="Sasuke" class="w-full h-full object-contain rounded-xl bg-slate-100">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://aws-images-prod.sindonews.com/dyn/600/pena/sindo-article/original/2024/02/06/naruto%207.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Might Guy">
    <img src="https://aws-images-prod.sindonews.com/dyn/600/pena/sindo-article/original/2024/02/06/naruto%207.jpg" alt="Might Guy" class="w-full h-full object-cover rounded-xl bg-green-50">
</div>
                                    <div onclick="selectDefaultAvatar('https://img.icons8.com/color/96/itachi-uchiha.png', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Itachi Uchiha">
                                        <img src="https://img.icons8.com/color/96/itachi-uchiha.png" alt="Itachi" class="w-full h-full object-contain rounded-xl bg-red-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/736x/66/c2/cc/66c2cc12b0fd32a353eeaa21720a6934.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Gaara">
                                        <img src="https://i.pinimg.com/736x/66/c2/cc/66c2cc12b0fd32a353eeaa21720a6934.jpg" alt="Gaara" class="w-full h-full object-cover rounded-xl bg-red-100">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/736x/f0/0c/a1/f00ca19c4e43932b2025c821db3930a8.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Kankuro">
                                        <img src="https://i.pinimg.com/736x/f0/0c/a1/f00ca19c4e43932b2025c821db3930a8.jpg" alt="Kankuro" class="w-full h-full object-cover rounded-xl bg-purple-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/170x/44/0b/e1/440be12ba79c8f27bd3e2976f2d8cb94.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Hinata Hyuga">
                                        <img src="https://i.pinimg.com/170x/44/0b/e1/440be12ba79c8f27bd3e2976f2d8cb94.jpg" alt="Hinata" class="w-full h-full object-cover rounded-xl bg-purple-50">
                                    </div>
                                   <div onclick="selectDefaultAvatar('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvFDVOKxbGN3KJGACsw7ZcECGZhmnlxpElPA&s', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Shizune & Tonton">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvFDVOKxbGN3KJGACsw7ZcECGZhmnlxpElPA&s" alt="Shizune" class="w-full h-full object-cover rounded-xl bg-pink-50">
</div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/236x/90/c1/9e/90c19ea3ca167cd3871a62787372c61c.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Ino Yamanaka">
                                        <img src="https://i.pinimg.com/236x/90/c1/9e/90c19ea3ca167cd3871a62787372c61c.jpg" alt="Ino" class="w-full h-full object-cover rounded-xl bg-purple-100">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/736x/1b/df/4e/1bdf4e64c1aaa3c3017fa6033b56e6ba.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Tenten">
                                        <img src="https://i.pinimg.com/736x/1b/df/4e/1bdf4e64c1aaa3c3017fa6033b56e6ba.jpg" alt="Tenten" class="w-full h-full object-cover rounded-xl bg-amber-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/236x/fe/69/58/fe695807c77f9f26c687b96739478ae6.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Kurenai Yuhi">
                                        <img src="https://i.pinimg.com/236x/fe/69/58/fe695807c77f9f26c687b96739478ae6.jpg" alt="Kurenai" class="w-full h-full object-cover rounded-xl bg-red-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://w0.peakpx.com/wallpaper/650/44/HD-wallpaper-sakura-pretty-naruto-naruto-shippuuden-blush-beautiful-sakura-haruno-sweet-nice-anime-shippuuden-beauty-anime-girl-pink-haruno-sakura-haruno-ninja-shinobi-female-lovely-short-hair.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Sakura Haruno">
                                        <img src="https://w0.peakpx.com/wallpaper/650/44/HD-wallpaper-sakura-pretty-naruto-naruto-shippuuden-blush-beautiful-sakura-haruno-sweet-nice-anime-shippuuden-beauty-anime-girl-pink-haruno-sakura-haruno-ninja-shinobi-female-lovely-short-hair.jpg" alt="Sakura" class="w-full h-full object-cover rounded-xl bg-pink-50">
                                    </div>
                                   <div onclick="selectDefaultAvatar('https://images.weserv.nl/?url=https://static.wikia.nocookie.net/naruto/images/2/24/Shodai_Hokage.PNG/revision/latest/scale-to-width-down/732?cb=20150131122713&path-prefix=id', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Hashirama Senju (Hokage Pertama)">
    <img src="https://images.weserv.nl/?url=https://static.wikia.nocookie.net/naruto/images/2/24/Shodai_Hokage.PNG/revision/latest/scale-to-width-down/732?cb=20150131122713&path-prefix=id" alt="Hashirama" class="w-full h-full object-cover rounded-xl bg-red-50">
</div>

<div onclick="selectDefaultAvatar('https://lh3.googleusercontent.com/d/11SAzKlnNETn_xz7SZjEG0e-VojctBX_Y', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Tobirama Senju (Hokage Kedua)">
    <img src="https://lh3.googleusercontent.com/d/11SAzKlnNETn_xz7SZjEG0e-VojctBX_Y" alt="Tobirama" class="w-full h-full object-cover rounded-xl bg-blue-50">
</div>
                                    <div onclick="selectDefaultAvatar('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEizoLqQUM5RJI5ufhyRhbqkGU50I4cn7n_gX6lBBC6ZOM5AyRBYvEmV2k2hviNeBkR4awWovt-LLu6y9VVV_3D4y0q9uSlmPfca0r-5fTmRGhonhz2e-mQFBrtUbS7nRR-07_wqNZIPdMca/s1600/hokage+keempat.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Hiruzen Sarutobi (Hokage Ketiga)">
                                          <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEizoLqQUM5RJI5ufhyRhbqkGU50I4cn7n_gX6lBBC6ZOM5AyRBYvEmV2k2hviNeBkR4awWovt-LLu6y9VVV_3D4y0q9uSlmPfca0r-5fTmRGhonhz2e-mQFBrtUbS7nRR-07_wqNZIPdMca/s1600/hokage+keempat.jpg" alt="Hiruzen" class="w-full h-full object-cover rounded-xl bg-amber-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://wallpaperaccess.com/full/5359660.png', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Minato Namikaze (Hokage Keempat)">
                                         <img src="https://wallpaperaccess.com/full/5359660.png" alt="Minato" class="w-full h-full object-cover rounded-xl bg-yellow-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdQjm6P3ct9TgCgXP6tVBTYg91_14SZwox2g&s', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Tsunade Senju (Hokage Kelima)">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdQjm6P3ct9TgCgXP6tVBTYg91_14SZwox2g&s" alt="Tsunade" class="w-full h-full object-cover rounded-xl bg-green-50">
                                    </div>
                                    <div onclick="selectDefaultAvatar('https://i.pinimg.com/736x/de/f4/64/def464eee5c00c4cb509be0eb6a3babb.jpg', this)" class="avatar-option border-2 border-slate-200 bg-white p-1 rounded-2xl cursor-pointer hover:border-indigo-300" title="Kakashi Hatake (Hokage Keenam)">
                                            <img src="https://i.pinimg.com/736x/de/f4/64/def464eee5c00c4cb509be0eb6a3babb.jpg" alt="Kakashi" class="w-full h-full object-cover rounded-xl bg-slate-100">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Nama Lengkap</label>
                            <input type="text" id="inputName" class="w-full p-4 bg-slate-50 border rounded-2xl font-bold outline-none focus:border-indigo-600">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Role</label>
                            <input type="text" id="inputRole" class="w-full p-4 bg-slate-50 border rounded-2xl font-bold outline-none focus:border-indigo-600">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Lokasi</label>
                            <input type="text" id="inputLocation" class="w-full p-4 bg-slate-50 border rounded-2xl font-bold outline-none focus:border-indigo-600 italic">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Tanggal Lahir</label>
                            <input type="date" id="inputBirth" class="w-full p-4 bg-slate-50 border rounded-2xl font-bold outline-none focus:border-indigo-600">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase">Biodata Singkat</label>
                        <textarea id="inputBio" class="w-full p-4 bg-slate-50 border rounded-2xl font-medium h-24 outline-none focus:border-indigo-600"></textarea>
                    </div>
                </div>
            </div>

            <div id="tab-keamanan" class="tab-content hidden space-y-6">
                <h4 class="text-2xl font-black italic">Keamanan Akun</h4>
                <div class="space-y-4">
                    <div class="p-6 bg-slate-50 rounded-3xl space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Password Lama</label>
                            <input type="password" placeholder="••••••••" class="w-full p-4 bg-white border rounded-2xl font-bold outline-none focus:border-indigo-600">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Password Baru</label>
                            <input type="password" placeholder="Masukkan Password Baru" class="w-full p-4 bg-white border rounded-2xl font-bold outline-none focus:border-indigo-600">
                        </div>
                    </div>
                </div>
            </div>

            <div class="sticky bottom-0 bg-white pt-6 mt-10 border-t flex space-x-3 z-10">
                <button onclick="toggleModal('modal-settings')" class="flex-1 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black uppercase text-[11px] tracking-widest italic hover:bg-slate-200">Batal</button>
                <button onclick="saveChanges()" id="saveBtn" class="flex-[2] py-4 bg-indigo-600 text-white rounded-2xl font-black uppercase text-[11px] tracking-widest shadow-lg italic hover:bg-indigo-700 transition-all">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. DATA DEFAULT (Jika admin baru pertama kali mendaftar/belum ada data)
    const defaultData = {
        name: "Samuel Ambar Pasaribu",
        role: "Administrator",
        location: "Batam, Indonesia",
        bio: "Mahasiswa Teknik Informatika Politeknik Negeri Batam.",
        birth: "2006-05-24",
        avatar: "https://api.dicebear.com/7.x/bottts/svg?seed=InformaticsCode" 
    };

    let selectedAvatarUrl = "";

    // 2. FUNGSI LOAD DATA (Sinkronisasi LocalStorage ke Tampilan Utama)
    function loadData() {
        const savedData = JSON.parse(localStorage.getItem('userProfile')) || defaultData;

        document.getElementById('displayName').innerText = savedData.name;
        document.getElementById('displayRole').innerText = savedData.role;
        document.getElementById('displayLocationBadge').innerText = savedData.location;
        document.getElementById('displayLocationText').innerText = savedData.location;
        document.getElementById('displayBio').innerText = savedData.bio;
        
        const dateObj = new Date(savedData.birth);
        document.getElementById('displayBirth').innerText = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

        document.getElementById('inputName').value = savedData.name;
        document.getElementById('inputRole').value = savedData.role;
        document.getElementById('inputLocation').value = savedData.location;
        document.getElementById('inputBirth').value = savedData.birth;
        document.getElementById('inputBio').value = savedData.bio;

        if(savedData.avatar) {
            selectedAvatarUrl = savedData.avatar;
            
            const mainImg = document.getElementById('mainAvatarPreview');
            mainImg.src = savedData.avatar;
            mainImg.classList.remove('hidden');
            document.getElementById('mainAvatarIcon').classList.add('hidden');
            
            const modalImg = document.getElementById('modalAvatarPreview');
            modalImg.src = savedData.avatar;
            modalImg.classList.remove('hidden');
            document.getElementById('modalAvatarIcon').classList.add('hidden');

            highlightSelectedAvatarInGallery(savedData.avatar);
        }
    }

    // 3. FUNGSI BARU: TOGGLE ACCORDION (Buka Tutup Menu Avatar)
    function toggleAccordion(id, buttonEl) {
        const content = document.getElementById(id);
        const icon = buttonEl.querySelector('[data-lucide="chevron-down"], [data-lucide="chevron-up"]');
        
        // Cek status buka/tutup
        const isOpen = content.classList.contains('open');
        
        // Tutup semua accordion terlebih dahulu agar rapi (Opsional)
        document.querySelectorAll('.accordion-content').forEach(acc => acc.classList.remove('open'));
        document.querySelectorAll('.accordion-content').previousElementSibling?.querySelectorAll('i').forEach(i => i.classList.remove('rotate-180'));

        if (!isOpen) {
            content.classList.add('open');
            if (icon) icon.classList.add('rotate-180');
        } else {
            content.classList.remove('open');
            if (icon) icon.classList.remove('rotate-180');
        }
    }

    // 4. FUNGSI PILIH AVATAR
    function selectDefaultAvatar(url, element) {
        selectedAvatarUrl = url;
        
        const modalImg = document.getElementById('modalAvatarPreview');
        modalImg.src = url;
        modalImg.classList.remove('hidden');
        document.getElementById('modalAvatarIcon').classList.add('hidden');

        document.querySelectorAll('.avatar-option').forEach(opt => opt.classList.remove('selected'));
        element.classList.add('selected');

        document.getElementById('avatarInput').value = "";
    }

    // Fungsi Pembantu Pencari & Penanda Avatar di Galeri (Otomatis Membuka Accordion Tempat Avatar Berada)
    function highlightSelectedAvatarInGallery(url) {
        document.querySelectorAll('.avatar-option').forEach(opt => {
            const img = opt.querySelector('img');
            if(img && img.src === url) {
                opt.classList.add('selected');
                
                // Otomatis buka kontainer accordion induknya agar admin tahu letak gambar aktifnya
                const parentAccordion = opt.closest('.accordion-content');
                if (parentAccordion) {
                    parentAccordion.classList.add('open');
                    const btn = parentAccordion.previousElementSibling;
                    const icon = btn.querySelector('.lucide-chevron-down');
                    if (icon) icon.classList.add('rotate-180');
                }
            } else {
                opt.classList.remove('selected');
            }
        });
    }

    // 5. FUNGSI PREVIEW FILE UNTUK UPLOAD MANDIRI
    function previewFile() {
        const file = document.getElementById('avatarInput').files[0];
        const reader = new FileReader();
        
        reader.onloadend = function () {
            selectedAvatarUrl = reader.result;
            
            const preview = document.getElementById('modalAvatarPreview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
            document.getElementById('modalAvatarIcon').classList.add('hidden');

            document.querySelectorAll('.avatar-option').forEach(opt => opt.classList.remove('selected'));
        }
        if (file) reader.readAsDataURL(file);
    }

    // 6. FUNGSI SIMPAN DATA KE LOCALSTORAGE
    function saveChanges() {
        const btn = document.getElementById('saveBtn');
        btn.innerHTML = '<span>Menyimpan...</span>';
        btn.disabled = true;

        const newData = {
            name: document.getElementById('inputName').value,
            role: document.getElementById('inputRole').value,
            location: document.getElementById('inputLocation').value,
            birth: document.getElementById('inputBirth').value,
            bio: document.getElementById('inputBio').value,
            avatar: selectedAvatarUrl 
        };

        setTimeout(() => {
            localStorage.setItem('userProfile', JSON.stringify(newData));
            loadData(); 
            
            alert('Profil berhasil diperbarui dan disimpan!');
            btn.innerHTML = 'Simpan Perubahan';
            btn.disabled = false;
            toggleModal('modal-settings');
        }, 800);
    }

    function toggleModal(id) { 
        document.getElementById(id).classList.toggle('hidden'); 
        if(!document.getElementById(id).classList.contains('hidden')) {
            const savedData = JSON.parse(localStorage.getItem('userProfile')) || defaultData;
            highlightSelectedAvatarInGallery(savedData.avatar);
        }
    }

    function switchTab(tabID) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
        document.getElementById(tabID).classList.remove('hidden');
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg');
            b.classList.add('text-slate-500');
        });
        const activeBtn = document.getElementById('btn-' + tabID);
        activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
        activeBtn.classList.remove('text-slate-500');
    }

    window.onload = loadData;
    if (window.lucide) lucide.createIcons();
</script>

</body>
</html>