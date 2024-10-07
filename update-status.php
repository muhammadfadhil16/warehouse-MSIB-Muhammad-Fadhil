<?php
require_once 'database.php';
require_once 'Warehouse-Process.php'; // Pastikan ini sesuai dengan nama kelas Anda

// Dapatkan ID dan status dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan.');
$currentStatus = isset($_GET['status']) ? $_GET['status'] : die('Status tidak ditemukan.');

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek warehouse
$warehouse = new Warehouse($db);

// Update status warehouse menggunakan method updateStatus
if ($warehouse->updateStatus($id, $currentStatus)) {
    // Setelah berhasil mengupdate status, kembali ke halaman sebelumnya
    header("Location: view-data-warehouse.php");
    exit;
} else {
    echo "Gagal memperbarui status.";
}
?>
