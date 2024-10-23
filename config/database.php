<?php

$host = "localhost";
$dbname = "mylibrary";
$username = "root";
$password = "Awaslupa1234";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection fail: " . $e->getMessage());
}
