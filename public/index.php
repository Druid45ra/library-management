<?php
require_once __DIR__ . '/../config/database.php';

$database = new Database();
$db = $database->connect();

if ($db) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed.";
}
