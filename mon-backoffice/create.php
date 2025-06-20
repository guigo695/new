<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    if ($sup && $departemen && $commune && $arrondisse && $quartier && $type_de_pa && $nature_de_ && $proprietai) {
        $stmt = $pdo->prepare('INSERT INTO public."Reserve" (sup, departemen, commune, arrondisse, quartier, type_de_pa, nature_de_, proprietai, commentair, image_du_d, etat_domai) VALUES (:sup, :departemen, :commune, :arrondisse, :quartier, :type_de_pa, :nature_de_, :proprietai, :commentair, :image_du_d, :etat_domai)');
        $stmt->execute([
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
        header('Location: index.php');
        exit;
    } else {
        $error = "Veuillez remplir tous les champs obligatoires.";
    }
}
?>

<?php include 'header.php'; ?>

<h2>Créer une nouvelle Réserve</h2>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="">
  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="sup" class="form-label">Surface *</label>
      <input type="text" class="form-control" id="sup" name="sup" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="departemen" class="form-label">Département *</label>
      <input type="text" class="form-control" id="departemen" name="departemen" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="commune" class="form-label">Commune *</label>
      <input type="text" class="form-control" id="commune" name="commune" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="arrondisse" class="form-label">Arrondissement *</label>
      <input type="text" class="form-control" id="arrondisse" name="arrondisse" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="quartier" class="form-label">Quartier *</label>
      <input type="text" class="form-control" id="quartier" name="quartier" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="type_de_pa" class="form-label">Type de PA *</label>
      <input type="text" class="form-control" id="type_de_pa" name="type_de_pa" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="nature_de_" class="form-label">Nature *</label>
      <input type="text" class="form-control" id="nature_de_" name="nature_de_" required />
    </div>
    <div class="col-md-4 mb-3">
      <label for="proprietai" class="form-label">Propriétaire *</label>
      <input type="text" class="form-control" id="proprietai" name="proprietai" required />
    </div>
    <div class="col-md-8 mb-3">
      <label for="commentair" class="form-label">Commentaire</label>
      <textarea class="form-control" id="commentair" name="commentair" rows="3"></textarea>
    </div>
    <div class="col-md-4 mb-3">
      <label for="image_du_d" class="form-label">Image URL</label>
      <input type="text" class="form-control" id="image_du_d" name="image_du_d" />
    </div>
    <div class="col-md-4 mb-3">
      <label for="etat_domai" class="form-label">État du domaine</label>
      <input type="text" class="form-control" id="etat_domai" name="etat_domai" />
    </div>
  </div>
  <button type="submit" class="btn btn-success">Créer</button>
  <a href="index.php" class="btn btn-secondary">Annuler</a>
</form>

<?php include 'footer.php'; ?>
