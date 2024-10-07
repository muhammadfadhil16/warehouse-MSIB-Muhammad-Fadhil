<?php
require_once 'database.php';
require_once 'Warehouse-Process.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

$warehouse = new Warehouse($db);

if (isset($_GET['id'])) {
    $warehouse->id = $_GET['id'];

    // Memanggil method untuk menghapus data warehouse
    if ($warehouse->delete()) {
        // Redirect setelah sukses
        header("Location: view-data-warehouse.php?message=Data berhasil dihapus");
        exit;
    } else {
        echo "Gagal menghapus data warehouse.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
