<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php'; // Connexion PDO à PostgreSQL/PostGIS

try {
    $sql = '
        SELECT 
            id,
            nom,
            ST_AsGeoJSON(ST_Transform(geom, 4326)) AS geometry
        FROM public."Localité"
        ORDER BY id ASC
    ';

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $features = array_map(function ($row) {
        return [
            'type' => 'Feature',
            'geometry' => json_decode($row['geometry']),
            'properties' => [
                'nom' => $row['nom'] // 👉 Affiche seulement la colonne "nom"
            ]
        ];
    }, $rows);

    echo json_encode([
        'type' => 'FeatureCollection',
        'features' => $features
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erreur : ' . $e->getMessage()
    ]);
}
