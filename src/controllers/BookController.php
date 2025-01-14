<?php
// BookController.php - Controler pentru gestionarea cărților

require_once __DIR__ . '/../config/database.php';

class BookController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function listBooks() {
        $query = 'SELECT * FROM books';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBook($id) {
        $query = 'SELECT * FROM books WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook($title, $author, $publishedYear, $genre, $copies) {
        $query = 'INSERT INTO books (title, author, published_year, genre, copies) VALUES (:title, :author, :published_year, :genre, :copies)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':published_year', $publishedYear);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':copies', $copies);
        return $stmt->execute();
    }

    public function updateBook($id, $title, $author, $publishedYear, $genre, $copies) {
        $query = 'UPDATE books SET title = :title, author = :author, published_year = :published_year, genre = :genre, copies = :copies WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':published_year', $publishedYear);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':copies', $copies);
        return $stmt->execute();
    }

    public function deleteBook($id) {
        $query = 'DELETE FROM books WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
