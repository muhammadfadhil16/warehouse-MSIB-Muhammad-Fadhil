<?php
class Database {
    private $host = "localhost";       
    private $username = "root";        
    private $password = "";            
    private $db = "warehouse_msib"; 
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
            // Mengatur mode error PDO untuk menangkap kesalahan
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }
    public function getConnection() {
        return $this->conn;  // Mengembalikan koneksi
    }
}


// Membuat objek database
$warehouse_msib = new Database();

?>
