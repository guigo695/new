<?php
$host = 'localhost';
$db = 'Reserve';
$user = 'postgres';
$pass = 'Attemenou5';
$dsn = "pgsql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}
?>
