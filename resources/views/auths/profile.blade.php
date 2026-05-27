<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin | Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
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
                        <div class="h-full w-full bg-slate-100 rounded-[36px] flex items-center justify-center text-indigo-600 overflow-hidden">
                            <img id="mainAvatarPreview" src="" alt="" class="hidden w-full h-full object-cover">
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
                            <p id="displayBirth" class="font-bold text-slate-700 italic">24 Mei 2006</p>
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
            <button onclick="toggleModal('modal-settings')" class="absolute top-8 right-8 text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <div id="tab-identitas" class="tab-content space-y-6">
                <h4 class="text-2xl font-black italic">Informasi Pribadi</h4>
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div onclick="document.getElementById('avatarInput').click()" class="h-20 w-20 bg-slate-100 rounded-[28px] border-2 border-dashed border-indigo-200 cursor-pointer flex items-center justify-center overflow-hidden">
                            <img id="modalAvatarPreview" src="" alt="" class="hidden w-full h-full object-cover">
                            <i id="modalAvatarIcon" data-lucide="camera" class="w-6 h-6 text-indigo-400"></i>
                        </div>
                        <input type="file" id="avatarInput" accept="image/*" class="hidden" onchange="previewFile()">
                        <button onclick="document.getElementById('avatarInput').click()" class="text-xs font-black uppercase text-indigo-600 tracking-wider">Ubah Foto Profil</button>
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
    // 1. DATA DEFAULT (Jika belum ada di localStorage)
    const defaultData = {
        name: "Samuel Ambar Pasaribu",
        role: "Administrator",
        location: "Batam, Indonesia",
        bio: "Mahasiswa Teknik Informatika Politeknik Negeri Batam.",
        birth: "2006-05-24",
        avatar: ""
    };

    // 2. FUNGSI LOAD DATA (Dijalankan setiap halaman dibuka)
    function loadData() {
        const savedData = JSON.parse(localStorage.getItem('userProfile')) || defaultData;

        // Update Tampilan Utama
        document.getElementById('displayName').innerText = savedData.name;
        document.getElementById('displayRole').innerText = savedData.role;
        document.getElementById('displayLocationBadge').innerText = savedData.location;
        document.getElementById('displayLocationText').innerText = savedData.location;
        document.getElementById('displayBio').innerText = savedData.bio;
        
        // Format Tanggal
        const dateObj = new Date(savedData.birth);
        document.getElementById('displayBirth').innerText = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

        // Update Input di Modal
        document.getElementById('inputName').value = savedData.name;
        document.getElementById('inputRole').value = savedData.role;
        document.getElementById('inputLocation').value = savedData.location;
        document.getElementById('inputBirth').value = savedData.birth;
        document.getElementById('inputBio').value = savedData.bio;

        // Foto Profil
        if(savedData.avatar) {
            document.getElementById('mainAvatarPreview').src = savedData.avatar;
            document.getElementById('mainAvatarPreview').classList.remove('hidden');
            document.getElementById('mainAvatarIcon').classList.add('hidden');
            
            document.getElementById('modalAvatarPreview').src = savedData.avatar;
            document.getElementById('modalAvatarPreview').classList.remove('hidden');
            document.getElementById('modalAvatarIcon').classList.add('hidden');
        }
    }

    // 3. FUNGSI SIMPAN DATA (Ke localStorage)
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
            avatar: document.getElementById('modalAvatarPreview').src.startsWith('data:image') ? document.getElementById('modalAvatarPreview').src : (JSON.parse(localStorage.getItem('userProfile')) || defaultData).avatar
        };

        setTimeout(() => {
            localStorage.setItem('userProfile', JSON.stringify(newData));
            loadData(); // Segarkan tampilan
            alert('Profil berhasil diperbarui dan disimpan!');
            btn.innerHTML = 'Simpan Perubahan';
            btn.disabled = false;
            toggleModal('modal-settings');
        }, 800);
    }

    // Fungsi Preview Foto
    function previewFile() {
        const file = document.getElementById('avatarInput').files[0];
        const reader = new FileReader();
        reader.onloadend = function () {
            const preview = document.getElementById('modalAvatarPreview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
            document.getElementById('modalAvatarIcon').classList.add('hidden');
        }
        if (file) reader.readAsDataURL(file);
    }

    // Modal & Tab Logic
    function toggleModal(id) { document.getElementById(id).classList.toggle('hidden'); }
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

    // Jalankan Load Data saat pertama kali buka
    window.onload = loadData;
    if (window.lucide) lucide.createIcons();
</script>

</body>
</html>