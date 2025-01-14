// books/list.php

<?php
require_once __DIR__ . '/../config/database.php';

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Obține toate cărțile din baza de date
$database = new Database();
$db = $database->connect();

$query = 'SELECT * FROM books';
$stmt = $db->query($query);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista cărți</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Lista cărți</h1>
    <table>
        <thead>
            <tr>
                <th>Titlu</th>
                <th>Autor</th>
                <th>An publicare</th>
                <th>Gen</th>
                <th>Exemplare</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['published_year']) ?></td>
                    <td><?= htmlspecialchars($book['genre']) ?></td>
                    <td><?= htmlspecialchars($book['copies']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $book['id'] ?>">Editează</a>
                        <a href="delete.php?id=<?= $book['id'] ?>">Șterge</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
