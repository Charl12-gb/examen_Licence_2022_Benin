<?php
include_once('partials/header.php');
?>
<main id="main" class="main">

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">

        <div class="card pt-3 pb-2">
          <div class="card-body">
            <div class="pagetitle">
              <h1>Liste des oeuvres</h1>
            </div><!-- End Page Title --><hr>
            <?php
            if (isset($_REQUEST['status'])) {
              if ($_REQUEST['status'] == 'success') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Operation effectuée avec succès
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
              }
              if ($_REQUEST['status'] == 'error') {
              ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Erreur survenue lors de l'opération
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
              }
            }
            ?>

            <?php
            if (get_oeuvre() != null) {
            ?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Oeuvre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Année</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach (get_oeuvre() as  $oeuvre) {
                  ?>
                    <tr>
                      <td><?= $oeuvre['nom'] ?></td>
                      <td><?= get_auteur($oeuvre['idArtiste']) ?></td>
                      <td><?= $oeuvre['annee'] ?></td>
                      <td><?= get_categorie($oeuvre['idCategorie']) ?></td>
                      <td>
                        <a class="text-warning" href="form.php?oeuvre_id=<?= $oeuvre['idOeuvre'] ?>">Modifier<i class="bi bi-pencil"></i></a>
                        <a class="text-danger" onclick="return confirm('Voulez-vous vraiment supprimer ?')" href="functions.php?delete&id=<?= $oeuvre['idOeuvre'] ?>">Supprimer<i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            <?php
            } else {
            ?>
              <div class="alert alert-danger text-center">
                Pas d'oeuvre disponible
              </div>
            <?php
            }
            ?>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php
include_once('partials/footer.php');
