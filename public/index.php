<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Bun venit, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <p>Rol: <?= htmlspecialchars($_SESSION['user_role']) ?></p>
    <a href="../auth/logout.php">Logout</a>
</body>
</html>
