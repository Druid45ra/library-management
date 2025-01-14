// users/list.php

<?php
require_once __DIR__ . '/../config/database.php';

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Obține toți utilizatorii din baza de date
$database = new Database();
$db = $database->connect();

$query = 'SELECT * FROM users';
$stmt = $db->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista utilizatori</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Lista utilizatori</h1>
    <table>
        <thead>
            <tr>
                <th>Nume</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $user['id'] ?>">Editează</a>
                        <a href="delete.php?id=<?= $user['id'] ?>">Șterge</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
