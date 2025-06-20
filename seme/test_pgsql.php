<?php
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=Reserve", "postgres", "Attemenou5");
    echo "Connexion réussie à PostgreSQL !";
} catch (PDOException $e) {
    echo "Échec de connexion : " . $e->getMessage();
}
?>
