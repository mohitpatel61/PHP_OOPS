<?php
// core/DB.php
class DB {
    private $host = 'localhost';
    private $username = 'root'; // Replace with your DB username
    private $password = '';     // Replace with your DB password
    private $dbname = 'php_oops'; // Replace with your DB name

    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully"; // For testing
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
