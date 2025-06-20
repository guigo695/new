<?php
require 'db.php';
header('Content-Type: application/json');

$stmt = $pdo->query('
  SELECT id, sup, departemen, commune, arrondisse, quartier, type_de_pa, nature_de_, proprietai, commentair, image_du_d, etat_domai,
  ST_X(geom) AS longitude, ST_Y(geom) AS latitude
  FROM public."Reserve"
');
$reserves = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reserves);
