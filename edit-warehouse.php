<?php
require_once 'database.php';
require_once 'Warehouse-Process.php'; // Pastikan ini sesuai dengan nama kelas Anda

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek warehouse
$warehouse = new Warehouse($db);

// Mendapatkan ID warehouse dari URL
$warehouse->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan.');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $warehouse->name = $_POST['name'];
    $warehouse->location = $_POST['location'];
    $warehouse->capacity = $_POST['capacity'];
    $warehouse->opening_hour = $_POST['opening_hour'];
    $warehouse->closing_hour = $_POST['closing_hour'];
    
    // Mengupdate data warehouse
    if ($warehouse->update()) {
        header("Location: view-data-warehouse.php"); // Redirect ke halaman daftar warehouse setelah berhasil
        exit;
    } else {
        echo "Gagal mengupdate warehouse.";
    }
} else {
    // Mendapatkan data warehouse berdasarkan ID
    $stmt = $warehouse->show($warehouse->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Memasukkan data ke objek warehouse
    $warehouse->name = $data['name'];
    $warehouse->location = $data['location'];
    $warehouse->capacity = $data['capacity'];

    $warehouse->opening_hour = $data['opening_hour'];
    $warehouse->closing_hour = $data['closing_hour'];
}

ob_start();
?>

<h1>Edit Warehouse</h1>

<form action="edit-warehouse.php?id=<?php echo $warehouse->id; ?>" method="POST">
    <div class="mb-2">
        <label for="name">Warehouse Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($warehouse->name); ?>" required>
    </div>

    <div class="mb-2">
        <label for="location">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="<?php echo htmlspecialchars($warehouse->location); ?>" required>
    </div>
    
    <div class="mb-2">
        <label for="capacity">Capacity:</label>
        <input type="number" class="form-control" name="capacity" id="capacity" value="<?php echo htmlspecialchars($warehouse->capacity); ?>" required>
    </div>

    
    <div class="mb-2">
        <label for="opening_hour">Opening Hour:</label>
        <input type="time" class="form-control" name="opening_hour" id="opening_hour" value="<?php echo htmlspecialchars($warehouse->opening_hour); ?>" required>
    </div>
    
    <div class="mb-2">
        <label for="closing_hour">Closing Hour:</label>
        <input type="time" class="form-control" name="closing_hour" id="closing_hour" value="<?php echo htmlspecialchars($warehouse->closing_hour); ?>" required>
    </div>
    
    <input type="submit" class="btn btn-custom w-100" value="Update Warehouse">

</form>

<br>

<?php
$content = ob_get_clean();

// Include the layout template and pass the content
include 'layout.php';
?>

<style>
    .btn-custom {
    background-color: #5F9EA0; /* Warna dasar */
    color: white; /* Warna teks */
    border: 1px solid #5F9EA0; /* Warna border */
    transition: background-color 0.3s ease, border-color 0.3s ease; /* Transisi untuk efek halus */
    padding: 10px 20px; /* Jarak dalam tombol */
    border-radius: 5px; /* Sudut membulat */
    font-weight: bold;
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

</style>
