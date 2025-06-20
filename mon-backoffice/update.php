<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $sup = $_POST['sup'] ?? null;
    $departemen = $_POST['departemen'] ?? null;
    $commune = $_POST['commune'] ?? null;
    $arrondisse = $_POST['arrondisse'] ?? null;
    $quartier = $_POST['quartier'] ?? null;
    $type_de_pa = $_POST['type_de_pa'] ?? null;
    $nature_de_ = $_POST['nature_de_'] ?? null;
    $proprietai = $_POST['proprietai'] ?? null;
    $commentair = $_POST['commentair'] ?? null;
    $image_du_d = $_POST['image_du_d'] ?? null;
    $etat_domai = $_POST['etat_domai'] ?? null;

    if ($id && $sup && $departemen && $commune && $arrondisse && $quartier && $type_de_pa && $nature_de_ && $proprietai) {
        $stmt = $pdo->prepare('UPDATE public."Reserve" SET sup = :sup, departemen = :departemen, commune = :commune, arrondisse = :arrondisse, quartier = :quartier, type_de_pa = :type_de_pa, nature_de_ = :nature_de_, proprietai = :proprietai, commentair = :commentair, image_du_d = :image_du_d, etat_domai = :etat_domai WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'sup' => $sup,
            'departemen' => $departemen,
            'commune' => $commune,
            'arrondisse' => $arrondisse,
            'quartier' => $quartier,
            'type_de_pa' => $type_de_pa,
            'nature_de_' => $nature_de_,
            'proprietai' => $proprietai,
            'commentair' => $commentair,
            'image_du_d' => $image_du_d,
            'etat_domai' => $etat_domai,
        ]);
    }
}

header('Location: index.php');
exit;
?>
