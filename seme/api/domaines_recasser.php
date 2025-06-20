<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php';

try {
    $sql = '
        SELECT 
            id,
            code_insae,
            type_parce,
            lotissemen,
            surf_sig,
            user_creat,
            date_creat,
            user_modif,
            date_modif,
            ST_AsGeoJSON(ST_Transform(geom, 4326)) AS geometry
        FROM public."domaine recasser"
        ORDER BY id ASC
    ';

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $features = array_map(function ($row) {
        return [
            'type' => 'Feature',
            'geometry' => json_decode($row['geometry']),  // décoder la géométrie ici
            'properties' => [
                'id' => $row['id'],
                'code_insae' => $row['code_insae'],
                'type_parce' => $row['type_parce'],
                'lotissemen' => $row['lotissemen'],
                'surf_sig' => $row['surf_sig'],
                'user_creat' => $row['user_creat'],
                'date_creat' => $row['date_creat'],
                'user_modif' => $row['user_modif'],
                'date_modif' => $row['date_modif']
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
