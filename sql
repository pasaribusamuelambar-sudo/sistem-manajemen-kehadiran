-- 1. Tabel Divisi
CREATE TABLE divisi (
    id_divisi INT PRIMARY KEY AUTO_INCREMENT,
    nama_divisi VARCHAR(50) NOT NULL,
    keterangan TEXT
);

-- 2. Tabel Jadwal (Jam Kerja)
CREATE TABLE jadwal (
    id_jadwal INT PRIMARY KEY AUTO_INCREMENT,
    nama_jadwal VARCHAR(50) NOT NULL,
    jam_masuk TIME NOT NULL,
    jam_pulang TIME NOT NULL
);

-- 3. Tabel Karyawan (User)
CREATE TABLE karyawan (
    id_karyawan VARCHAR(20) PRIMARY KEY, -- Contoh: KAR-001
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    jabatan VARCHAR(50),
    id_divisi INT,
    id_jadwal INT,
    role ENUM('admin', 'karyawan') DEFAULT 'karyawan',
    foto_profil VARCHAR(255),
    FOREIGN KEY (id_divisi) REFERENCES divisi(id_divisi) ON DELETE SET NULL,
    FOREIGN KEY (id_jadwal) REFERENCES jadwal(id_jadwal) ON DELETE SET NULL
);

-- 4. Tabel Absensi
CREATE TABLE absensi (
    id_absensi INT PRIMARY KEY AUTO_INCREMENT,
    id_karyawan VARCHAR(20),
    tanggal DATE NOT NULL,
    jam_masuk TIME,
    jam_pulang TIME,
    lokasi_lat VARCHAR(50), -- Koordinat Latitude
    lokasi_long VARCHAR(50), -- Koordinat Longitude
    status_kehadiran ENUM('hadir', 'terlambat', 'pulang_awal') DEFAULT 'hadir',
    FOREIGN KEY (id_karyawan) REFERENCES karyawan(id_karyawan) ON DELETE CASCADE
);

-- 5. Tabel Pengajuan Izin / Cuti
CREATE TABLE pengajuan_izin (
    id_izin INT PRIMARY KEY AUTO_INCREMENT,
    id_karyawan VARCHAR(20),
    jenis_izin ENUM('sakit', 'cuti', 'keperluan_mendadak') NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    alasan TEXT,
    bukti_dokumen VARCHAR(255), -- Nama file lampiran
    status_pengajuan ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
    tgl_konfirmasi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_karyawan) REFERENCES karyawan(id_karyawan) ON DELETE CASCADE
);