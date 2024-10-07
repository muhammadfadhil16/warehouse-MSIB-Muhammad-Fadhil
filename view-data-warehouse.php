<?php
require_once 'database.php';
require_once 'Warehouse-Process.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek warehouse
$warehouse = new Warehouse($db);

// Membaca data warehouse dengan filter
$filters = [];
if (isset($_GET['name']) && !empty(trim($_GET['name']))) {
    $filters['name'] = htmlspecialchars(strip_tags(trim($_GET['name']))); 
}
if (isset($_GET['location']) && !empty(trim($_GET['location']))) {
    $filters['location'] = htmlspecialchars(strip_tags(trim($_GET['location']))); 
}
if (isset($_GET['status']) && !empty(trim($_GET['status']))) {
    $filters['status'] = htmlspecialchars(strip_tags(trim($_GET['status']))); 
}


$stmt = $warehouse->read($filters);
$num = $stmt->rowCount();

$title = "Daftar Warehouse";

ob_start();
?>

<!-- Form Filter -->
<form method="GET" action="" class="mb-1 mt-2">
    <div class="row justify-content-center">
        <div class="col-md-3 mb-2">
            <input type="text" name="name" class="form-control" placeholder="Nama Warehouse" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
        </div>
        <div class="col-md-3 mb-2">
            <input type="text" name="location" class="form-control" placeholder="Lokasi Warehouse" value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
        </div>
        <div class="col-md-3 mb-2">
            <select name="status" class="form-control">
                <option value="">-- Pilih Status --</option>
                <option value="nonaktif" <?php echo (isset($_GET['status']) && $_GET['status'] == 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>   
                <option value="aktif" <?php echo (isset($_GET['status']) && $_GET['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
            </select>
        </div>
        <div class="col-md-1">  
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

<div class="container mt-3 pt-4 mb-5 justify-content-center">
    <?php    
    // Check if there are any warehouses
    if ($num > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-hover table-bordered'>";
        echo "<thead class='table-dark text-center'><tr>
        <th>ID</th>
        <th>Warehouse Name</th>
        <th>Location</th>
        <th>Capacity</th>
        <th>Status</th>
        <th>Opening Hour</th>
        <th>Closing Hour</th>
        <th>Action</th>
        </tr></thead>";
        echo "<tbody class='text-center'>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$name}</td>";
            echo "<td>{$location}</td>";
            echo "<td>{$capacity}</td>";
            
            // Tombol Aktif/Nonaktif di kolom Status
            echo "<td>";
            $newStatus = ($status == 'aktif') ? 'nonaktif' : 'aktif';
            $statusClass = ($status == 'aktif') ? 'btn-success' : 'btn-secondary';
            $statusLabel = ($status == 'aktif') ? 'aktif' : 'nonaktif';

            echo "<a href='update-status.php?id={$id}&status={$newStatus}' class='btn {$statusClass}'>";
            echo $statusLabel;
            echo "</a>";
            echo "</td>";


            // Data lainnya
            echo "<td>{$opening_hour}</td>";
            echo "<td>{$closing_hour}</td>";
            
            // Tombol Edit dan Hapus di kolom Action
            echo "<td>";
            echo "<a href='edit-warehouse.php?id={$id}' class='btn btn-sm btn-warning mx-1'>
            <i class='bi bi-pencil-square'></i> Edit
            </a>";
            
            echo "<a href='delete-warehouse.php?id={$id}' class='btn btn-sm btn-danger mx-1' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>
            <i class='bi bi-trash'></i> Hapus
            </a>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='alert alert-info'>Tidak ada data warehouse.</p>";
    }
    ?>
    <a href="Create-warehouse.php" class="btn mb-3" style="background-color: #5F9EA0; outline-color:#5F9EA0; color:white">
        <i class="bi bi-plus-circle"></i> Tambah Warehouse
    </a>
</div>

<?php
// Capture the content for the layout
$content = ob_get_clean();
include 'layout.php';
?>

<!-- css.view-data-warehouse -->
<style>
    /* Style untuk container filter */
    .container.mt-3.pt-4.mb-5 {
        background-color: #f8f9fa; 
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    /* Style untuk form filter */
    form.mb-4 {
        margin-bottom: 20px;
    }

    /* Style untuk input dan select */
    input.form-control,
    select.form-control {
        border: 1px solid #5F9EA0;
        border-radius: 4px;
    }

    /* Style untuk button filter */
    button.btn-primary {
        background-color: #5F9EA0; 
        border: none; 
        transition: background-color 0.3s; /* Efek transisi saat hover */
    }

    button.btn-primary:hover {
        background-color: #4cae4f; /* Warna saat hover */
    }

    /* Responsive design */
    @media (max-width: 576px) {
        .row > div {
            margin-bottom: 10px; /* Jarak antar elemen form */
        }
    }
</style>
