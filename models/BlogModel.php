<?php

class BlogModel {
    private $table = 'Blog';
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Example: Fetch all rows
    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}