<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php'; // Assure-toi que ce fichier connecte bien à ta base PostgreSQL/PostGIS

$sql = "
    SELECT
        arrond,
        sup,
        ST_AsGeoJSON(ST_Transform(geom, 4326)) AS geometry
    FROM arrondissement
";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$features = array_map(function ($row) {
    return [
        'type' => 'Feature',
        'geometry' => json_decode($row['geometry']),
        'properties' => [
            'arrond' => $row['arrond'],
            'sup' => $row['sup']
        ]
    ];
}, $rows);

echo json_encode([
    'type' => 'FeatureCollection',
    'features' => $features
], JSON_UNESCAPED_UNICODE);
