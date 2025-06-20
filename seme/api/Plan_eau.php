<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php'; // fichier de connexion PDO à la base PostgreSQL/PostGIS

try {
    $sql = '
        SELECT 
            id, 
            name1_,
            ST_AsGeoJSON(ST_Transform(geom, 4326)) AS geometry
        FROM public."Plan_eau"
        ORDER BY id ASC
    ';

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Conversion en GeoJSON FeatureCollection
    $features = array_map(function ($row) {
        return [
            'type' => 'Feature',
            'geometry' => json_decode($row['geometry']),
            'properties' => [
                'id' => $row['id'],
                'name1_' => $row['name1_']
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
