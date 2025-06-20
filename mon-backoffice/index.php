<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM public."Reserve" ORDER BY id ASC');
$reserves = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<h2>Liste des Réserves</h2>

<table class="table table-striped table-hover align-middle">
  <thead class="table-primary">
    <tr>
      <th>ID</th>
      <th>Sup</th>
      <th>Département</th>
      <th>Commune</th>
      <th>Arrondissement</th>
      <th>Quartier</th>
      <th>Type de PA</th>
      <th>Nature</th>
      <th>Propriétaire</th>
      <th>Commentaire</th>
      <th>Image</th>
      <th>État</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($reserves as $r): ?>
      <tr>
        <td><?= htmlspecialchars($r['id']) ?></td>
        <td><?= htmlspecialchars($r['sup']) ?></td>
        <td><?= htmlspecialchars($r['departemen']) ?></td>
        <td><?= htmlspecialchars($r['commune']) ?></td>
        <td><?= htmlspecialchars($r['arrondisse']) ?></td>
        <td><?= htmlspecialchars($r['quartier']) ?></td>
        <td><?= htmlspecialchars($r['type_de_pa']) ?></td>
        <td><?= htmlspecialchars($r['nature_de_']) ?></td>
        <td><?= htmlspecialchars($r['proprietai']) ?></td>
        <td><?= htmlspecialchars($r['commentair']) ?></td>
        <td>
          <?php if ($r['image_du_d']): ?>
            <img src="<?= htmlspecialchars($r['image_du_d']) ?>" alt="Image" style="max-height:50px; max-width:80px;" />
          <?php else: ?>
            N/A
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($r['etat_domai']) ?></td>
        <td>
          <button class="btn btn-sm btn-warning edit-btn"
            data-id="<?= $r['id'] ?>"
            data-sup="<?= htmlspecialchars($r['sup']) ?>"
            data-departemen="<?= htmlspecialchars($r['departemen']) ?>"
            data-commune="<?= htmlspecialchars($r['commune']) ?>"
            data-arrondisse="<?= htmlspecialchars($r['arrondisse']) ?>"
            data-quartier="<?= htmlspecialchars($r['quartier']) ?>"
            data-type_de_pa="<?= htmlspecialchars($r['type_de_pa']) ?>"
            data-nature_de_="<?= htmlspecialchars($r['nature_de_']) ?>"
            data-proprietai="<?= htmlspecialchars($r['proprietai']) ?>"
            data-commentair="<?= htmlspecialchars($r['commentair']) ?>"
            data-image_du_d="<?= htmlspecialchars($r['image_du_d']) ?>"
            data-etat_domai="<?= htmlspecialchars($r['etat_domai']) ?>"
          >Edit</button>
          <a href="delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Supprimer cette réserve ?');" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal édition -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"><!-- largeur élargie -->
    <form id="editForm" method="POST" action="update.php" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modifier Réserve</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body row">
          <input type="hidden" name="id" id="edit-id" />
          <div class="col-md-4 mb-3">
            <label for="edit-sup" class="form-label">Surface</label>
            <input type="text" class="form-control" id="edit-sup" name="sup" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-departemen" class="form-label">Département</label>
            <input type="text" class="form-control" id="edit-departemen" name="departemen" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-commune" class="form-label">Commune</label>
            <input type="text" class="form-control" id="edit-commune" name="commune" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-arrondisse" class="form-label">Arrondissement</label>
            <input type="text" class="form-control" id="edit-arrondisse" name="arrondisse" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-quartier" class="form-label">Quartier</label>
            <input type="text" class="form-control" id="edit-quartier" name="quartier" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-type_de_pa" class="form-label">Type de PA</label>
            <input type="text" class="form-control" id="edit-type_de_pa" name="type_de_pa" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-nature_de_" class="form-label">Nature</label>
            <input type="text" class="form-control" id="edit-nature_de_" name="nature_de_" required />
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-proprietai" class="form-label">Propriétaire</label>
            <input type="text" class="form-control" id="edit-proprietai" name="proprietai" required />
          </div>
          <div class="col-md-8 mb-3">
            <label for="edit-commentair" class="form-label">Commentaire</label>
            <textarea class="form-control" id="edit-commentair" name="commentair" rows="3"></textarea>
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-image_du_d" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="edit-image_du_d" name="image_du_d" />
            <!-- Si tu veux gérer un upload image, il faudra un peu plus de code côté serveur -->
          </div>
          <div class="col-md-4 mb-3">
            <label for="edit-etat_domai" class="form-label">État du domaine</label>
            <input type="text" class="form-control" id="edit-etat_domai" name="etat_domai" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const editButtons = document.querySelectorAll('.edit-btn');
  const editModal = new bootstrap.Modal(document.getElementById('editModal'));

  editButtons.forEach(button => {
    button.addEventListener('click', () => {
      document.getElementById('edit-id').value = button.getAttribute('data-id');
      document.getElementById('edit-sup').value = button.getAttribute('data-sup');
      document.getElementById('edit-departemen').value = button.getAttribute('data-departemen');
      document.getElementById('edit-commune').value = button.getAttribute('data-commune');
      document.getElementById('edit-arrondisse').value = button.getAttribute('data-arrondisse');
      document.getElementById('edit-quartier').value = button.getAttribute('data-quartier');
      document.getElementById('edit-type_de_pa').value = button.getAttribute('data-type_de_pa');
      document.getElementById('edit-nature_de_').value = button.getAttribute('data-nature_de_');
      document.getElementById('edit-proprietai').value = button.getAttribute('data-proprietai');
      document.getElementById('edit-commentair').value = button.getAttribute('data-commentair');
      document.getElementById('edit-image_du_d').value = button.getAttribute('data-image_du_d');
      document.getElementById('edit-etat_domai').value = button.getAttribute('data-etat_domai');

      editModal.show();
    });
  });
});
</script>
