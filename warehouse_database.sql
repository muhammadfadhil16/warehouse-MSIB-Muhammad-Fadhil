-- Membuat database
CREATE DATABASE warehouse_msib;

-- Menggunakan database yang baru dibuat
USE warehouse_msib;

-- Membuat tabel gudang tanpa ENUM
CREATE TABLE gudang (
    id INT PRIMARY KEY IDENTITY(1,1),                  -- Kolom ID sebagai Primary Key dan Auto Increment
    name VARCHAR(255) NOT NULL,                        -- Kolom nama gudang (tidak boleh kosong)
    location VARCHAR(255) NOT NULL,                    -- Kolom lokasi gudang (tidak boleh kosong)
    capacity INT NOT NULL,                             -- Kolom kapasitas (tidak boleh kosong)
    status VARCHAR(10) DEFAULT 'aktif',                -- Kolom status dengan nilai 'aktif' atau 'nonaktif'
    opening_hour TIME,                                 -- Kolom jam buka
    closing_hour TIME                                  -- Kolom jam tutup
);
