<?php
header('Content-Type: application/json; charset=utf-8');
require '../db.php'; // ton fichier de connexion PDO

try {
    $sql = '
        SELECT 
            id, sup, departemen, commune, arrondisse, quartier,
            type_de_pa, nature_de_, proprietai, commentair, image_du_d, 
            etat_domai,
            ST_AsGeoJSON(ST_Transform(geom, 4326)) AS geometry
        FROM public."Reserve"
        ORDER BY id ASC
    ';

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $features = array_map(function ($row) {
        return [
            'type' => 'Feature',
            'geometry' => json_decode($row['geometry']), // 🔥 très important
            'properties' => [
                'id' => $row['id'],
                'sup' => $row['sup'],
                'departemen' => $row['departemen'],
                'commune' => $row['commune'],
                'arrondisse' => $row['arrondisse'],
                'quartier' => $row['quartier'],
                'type_de_pa' => $row['type_de_pa'],
                'nature_de_' => $row['nature_de_'],
                'proprietai' => $row['proprietai'],
                'commentair' => $row['commentair'],
                'image_du_d' => $row['image_du_d'],
                'etat_domai' => $row['etat_domai']
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
