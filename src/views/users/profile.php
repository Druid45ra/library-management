// users/profile.php

<?php
require_once __DIR__ . '/../config/database.php';

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

// Obține ID-ul utilizatorului din URL
$id = $_GET['id'];

// Obține informațiile utilizatorului din baza de date
$database = new Database();
$db = $database->connect();

$query = 'SELECT * FROM users WHERE id = :id';
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilizator</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Profil utilizator</h1>
    <div class="profile-info">
        <p>Nume: <?= htmlspecialchars($user['name']) ?></p>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>Rol: <?= htmlspecialchars($user['role']) ?></p>
    </div>
</body>
</html>
