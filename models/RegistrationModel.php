<?php
// models/RegistrationModel.php

require_once 'core/DB.php';

class RegistrationModel {
    private $conn;

    public function __construct() {
        $this->conn = (new DB())->getConnection();
    }

    // Register user in the database
    public function registerUser($dataArr) {
        try {
            // Hash the password before saving
            $hashedPassword = password_hash($dataArr['password'], PASSWORD_DEFAULT);

            // SQL query to insert user data into users table
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $dataArr['name']);
            $stmt->bindParam(':email', $dataArr['email']);
            $stmt->bindParam(':password', $hashedPassword);

            // Execute query
            if ($stmt->execute()) {
                return true; // User registered successfully
            } else {
                return false; // Failed to register user
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Check if the email already exists in the database
    public function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true; // Email already exists
        } else {
            return false; // Email is available
        }
    }

    public function loginCheck($data){
        // Query to retrieve the user data, including the stored password hash
        $sql = "SELECT id, password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $data['email']);
    
        $stmt->execute();
    
        // Check if a user exists with that email
        if ($stmt->rowCount() > 0) {
            // Fetch the user's data (including the hashed password)
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Use password_verify() to check if the entered password matches the hashed password
            if (password_verify($data['password'], $user['password'])) {
                return true; // Correct password
            } else {
                return false; // Incorrect password
            }
        } else {
            return false; // No user found with that email
        }
    }
    
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return user data as an associative array
    }
    
}
