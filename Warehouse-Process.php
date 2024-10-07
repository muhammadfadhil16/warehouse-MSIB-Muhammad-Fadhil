<?php 
class Warehouse {
    private $conn;
    private $table_name = "warehouse";

    // Properti sesuai dengan kolom di table warehouse
    public $id;
    public $name;
    public $location;
    public $capacity;
    public $status;
    public $opening_hour;
    public $closing_hour;

    // Constructor untuk inisialisasi koneksi
    public function __construct($db){
        $this->conn = $db;
    }

    // Fungsi untuk menambahkan data warehouse
    public function create(){
        // Jika status tidak diset, gunakan 'nonaktif' sebagai default
        if (empty($this->status)) {
            $this->status = 'nonaktif';
        }
    
        $stmt = $this->conn->prepare("INSERT INTO ". $this->table_name ." 
        (name, location, capacity, status, opening_hour, closing_hour) 
        VALUES (:name, :location, :capacity, :status, :opening_hour, :closing_hour)");
    
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    

    public function read($filters = []) {
        $query = "SELECT * FROM " . $this->table_name;
        $conditions = [];
        
        if (isset($filters['name'])) {
            $conditions[] = "name LIKE :name";
        }
        if (isset($filters['location'])) {
            $conditions[] = "location LIKE :location";
        }
        if (isset($filters['status'])) {
            $conditions[] = "status = :status";
        }
        
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        
        $stmt = $this->conn->prepare($query);
        
        if (isset($filters['name'])) {
            $stmt->bindValue(':name', '%' . $filters['name'] . '%');
        }
        if (isset($filters['location'])) {
            $stmt->bindValue(':location', '%' . $filters['location'] . '%');
        }
        if (isset($filters['status'])) {
            $stmt->bindValue(':status', $filters['status']);
        }
        
        $stmt->execute();
        return $stmt;
    }
    
    
    

    // Fungsi untuk menampilkan satu warehouse berdasarkan ID
    public function show($id){
        $stmt = $this->conn->prepare("SELECT id, name, location, capacity, status, opening_hour, closing_hour FROM ". $this->table_name ." WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    // Fungsi untuk memperbarui data warehouse berdasarkan ID
    public function update(){

        $stmt = $this->conn->prepare("UPDATE ". $this->table_name ." 
        SET name=:name, location=:location, capacity=:capacity, opening_hour=:opening_hour, closing_hour=:closing_hour 
        WHERE id=:id");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Fungsi untuk menghapus data warehouse berdasarkan ID
    public function delete(){
        $stmt = $this->conn->prepare("DELETE FROM ". $this->table_name ." WHERE id=:id");
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updateStatus($id, $newStatus) {
        // Query untuk memperbarui status warehouse
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':id', $id);
        
        // Eksekusi query dan cek apakah berhasil
        if ($stmt->execute()) {
            return true;
        } else {
            // Jika gagal, tampilkan error untuk debugging
            $error = $stmt->errorInfo();
            echo "Gagal memperbarui status: " . $error[2];
            return false;
        }
    }
    
    public function validate() {
        // Pastikan kapasitas adalah angka
        if (!is_numeric($this->capacity)) {
            return false;
        }
        
        // Validasi jam buka dan tutup (format 24 jam HH:mm:ss)
        if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $this->opening_hour) || 
            !preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $this->closing_hour)) {
            return false;
        }
    
        return true;
    }
    
    


}
?>
