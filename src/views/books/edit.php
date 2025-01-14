// books/edit.php

<?php
require_once __DIR__ . '/../config/database.php';

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Obține ID-ul cărții din URL
$id = $_GET['id'];

// Inițializează variabilele pentru formular
$title = '';
$author = '';
$publishedYear = '';
$genre = '';
$copies = '';

// Obține datele cărții din baza de date
$database = new Database();
$db = $database->connect();

$query = 'SELECT * FROM books WHERE id = :id';
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Inițializează variabilele pentru formular cu datele cărții
$title = $book['title'];
$author = $book['author'];
$publishedYear = $book['published_year'];
$genre = $book['genre'];
$copies = $book['copies'];

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publishedYear = $_POST['published_year'];
    $genre = $_POST['genre'];
    $copies = $_POST['copies'];

    // Validare date
    if (empty($title) || empty($author) || empty($publishedYear) || empty($genre) || empty($copies)) {
        $error = 'Toate câmpurile sunt obligatorii!';
    } else {
        // Actualizează cartea în baza de date
        $query = 'UPDATE books SET title = :title, author = :author, published_year = :published_year, genre = :genre, copies = :copies WHERE id = :id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':published_year', $publishedYear);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':copies', $copies);

        if ($stmt->execute()) {
            header('Location: ../books/list.php');
            exit();
        } else {
            $error = 'Eroare la actualizarea cărții!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare carte</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Editare carte</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="edit.php?id=<?= $id ?>">
        <label for="title">Titlu:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
        <br>
        <label for="author">Autor:</label>
        <input type="text" name="author" value="<?= htmlspecialchars($author) ?>">
        <br>
        <label for="published_year">An publicare:</label>
        <input type="number" name="published_year" value="<?= htmlspecialchars($publishedYear) ?>">
        <br>
        <label for="genre">Gen:</label>
        <input type="text" name="genre" value="<?= htmlspecialchars($genre) ?>">
        <br>
        <label for="copies">Exemplare:</label>
        <input type="number" name="copies" value="<?= htmlspecialchars($copies) ?>">
        <br>
        <button type="submit">Actualizează</button>
    </form>
</body>
</html>
