<?php
require_once 'database.php';
require_once 'Warehouse-Process.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek warehouse
$warehouse = new Warehouse($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap data dari form dan mengisi properti objek warehouse
    $warehouse->name = $_POST['name'];
    $warehouse->location = $_POST['location'];
    $warehouse->capacity = $_POST['capacity'];
    $warehouse->status = $_POST['status'];  // Harus 'aktif' atau 'tidak_aktif'
    $warehouse->opening_hour = $_POST['opening_hour'];  // Format: HH:MM:SS
    $warehouse->closing_hour = $_POST['closing_hour'];  // Format: HH:MM:SS
    
    // Memanggil fungsi create() untuk menyimpan data ke database
    if ($warehouse->create()) {
        header("Location: view-data-warehouse.php");  // Redirect ke halaman index jika berhasil
        exit;
    } else {
        echo "Gagal menambah warehouse.";
    }
}
ob_start();
?>

<div class="container mt-4 mb-4">
    <h2>Tambah Warehouse</h2>
    <form action="Create-warehouse.php" method="POST">
        <div class="form-group">
            <label for="name">Warehouse Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" name="location" id="location" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" class="form-control" name="capacity" id="capacity" required>
        </div>

        <div class="form-group">
            <label for="opening_hour">Opening Hour:</label>
            <input type="time" class="form-control" name="opening_hour" id="opening_hour" required>
        </div>

        <div class="form-group">
            <label for="closing_hour">Closing Hour:</label>
            <input type="time" class="form-control" name="closing_hour" id="closing_hour" required>
        </div>

        <button type="submit" class="btn btn-custom mt-4 w-100">Create Warehouse</button>
    </form>
</div>


<style>
    h2 {
        text-align: center; 
        color: #5F9EA0; 
        margin-bottom: 20px; 
    }

    .form-group {
        margin-bottom: 20px; 
    }

    label {
        font-weight: bold; 
        color: #333333; 
    }

    input.form-control, select.form-control {
        border-radius: 4px; 
        border: 1px solid #ccc; 
        transition: border-color 0.3s; 
    }

    input.form-control:focus, select.form-control:focus {
        border-color: #5F9EA0; 
        box-shadow: 0 0 5px rgba(95, 158, 160, 0.5); 
    }

    .btn-custom {
        background-color: #5F9EA0; /* Warna dasar */
        color: white; /* Warna teks */
        border: 1px solid #5F9EA0; /* Warna border */
        transition: background-color 0.3s ease, border-color 0.3s ease; /* Transisi untuk efek halus */
        font-weight: bold;
        padding: 10px 20px; /* Jarak dalam tombol */
        border-radius: 5px; /* Sudut membulat */
    }

    .btn-custom:hover {
        background-color: #4f8693; /* Warna saat hover */
        color: white; /* Tetap warna teks putih */
        border-color: #4f8693; /* Warna border saat hover */
    }

    .btn-custom:focus,
    .btn-custom:active {
        background-color: #417077; /* Warna saat aktif/klik */
        border-color: #417077; /* Warna border saat aktif/klik */
        outline: none; /* Menghilangkan outline default */
    }

    .mt-4 {
        margin-top: 20px;
    }
</style>

<?php
$content = ob_get_clean(); 
include 'layout.php'; 
?>

