<?php
// UserController.php - Controler pentru gestionarea utilizatorilor

require_once __DIR__ . '/../config/database.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function listUsers() {
        $query = 'SELECT * FROM users';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($id) {
        $query = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($name, $email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $email, $role) {
        $query = 'UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
