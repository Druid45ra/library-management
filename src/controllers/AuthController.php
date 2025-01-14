<?php
// AuthController.php - Controler pentru gestionarea autentificării utilizatorilor

require_once __DIR__ . '/../config/database.php';

class AuthController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function login($email, $password) {
        $query = 'SELECT * FROM users WHERE email = :email LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            return true;
        }

        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function register($name, $email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }

    public function isAuthenticated() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public function getAuthenticatedUser() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'role' => $_SESSION['user_role']
            ];
        }
        return null;
    }
}

?>
