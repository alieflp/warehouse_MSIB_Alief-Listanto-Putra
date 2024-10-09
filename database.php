<?php
class Database {
    private $host = "localhost";
    private $db_name = "warehouse_barang";
    private $username = "root";
    private $password = "";
    private $port = "3306";
    private $conn;
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;port=$this->port", $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (\Throwable $err) {
            echo "Connection failed: " . $err->getMessage();
        }
        return $this->conn;
    }

}
$database = new Database();
$db = $database->getConnection();
?>