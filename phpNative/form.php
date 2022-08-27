<?php
include_once('partials/header.php');
if (isset($_REQUEST['oeuvre_id'])) {
    $oeuvre = get_oeuvre(htmlentities($_REQUEST['oeuvre_id']));
}
?>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-body pt-3 pb-2">
                <div class="pagetitle">
                    <?php
                    if (isset($_REQUEST['oeuvre_id'])) {
                    ?>
                        <h1>Editer oeuvre</h1>
                    <?php
                    } else {
                    ?>
                        <h1>Créer oeuvre</h1>
                    <?php
                    }
                    ?>
                </div><!-- End Page Title -->
                <hr>
                <!-- General Form Elements -->
                <form method="post" action="functions.php" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nom oeuvre</label>
                        <div class="col-sm-10">
                            <input type="text" name="nom" value="<?php if (isset($_REQUEST['oeuvre_id'])) echo $oeuvre['nom']; ?>" id="nom" class="form-control" required placeholder="Nom">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Année</label>
                        <div class="col-sm-10">
                            <input type="number" value="<?php if (isset($_REQUEST['oeuvre_id'])) echo $oeuvre['annee'];
                                                        else echo 1960; ?>" min="1000" max="2022" name="annee" id="annee" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Artiste</label>
                        <div class="col-sm-10">
                            <select class="form-select" required name="artiste" id="artiste" aria-label="Default select example">
                                <option value="">Selectionner un artiste</option>
                                <?php
                                if (isset($_REQUEST['oeuvre_id'])) {
                                    if ($oeuvre['idArtiste'] != null) {
                                        echo select_option(get_list_auteur(), 'idArtiste', 'nom', $oeuvre['idArtiste'], 'prenom');
                                    } else {
                                        echo select_option(get_list_auteur(), 'idArtiste', 'nom', -1, 'prenom');
                                    }
                                } else {
                                    echo select_option(get_list_auteur(), 'idArtiste', 'nom', -1, 'prenom');
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Categorie</label>
                        <div class="col-sm-10">
                            <select class="form-select" required name="categorie" id="categorie" aria-label="Default select example">
                                <option value="">Selectioner une catégorie</option>
                                <?php
                                if (isset($_REQUEST['oeuvre_id'])) {
                                    if ($oeuvre['idCategorie'] != null) {
                                        echo select_option(get_list_categorie(), 'idCategorie', 'nomCategorie', $oeuvre['idCategorie']);
                                    } else {
                                        echo select_option(get_list_categorie(), 'idCategorie', 'nomCategorie', -1);
                                    }
                                } else {
                                    echo select_option(get_list_categorie(), 'idCategorie', 'nomCategorie', -1);
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description" style="height: 100px" placeholder="Description..."><?php if (isset($_REQUEST['oeuvre_id'])) echo $oeuvre['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <?php
                            if (isset($_REQUEST['oeuvre_id'])) {
                            ?>
                                <input type="hidden" name="id_oeuvre" value="<?= htmlentities($_REQUEST['oeuvre_id']) ?>">
                                <input type="submit" name="edit_oeuvre" class="btn btn-primary" value="Mettre à jour">
                            <?php
                            } else {
                            ?>
                                <input type="submit" name="creer_oeuvre" class="btn btn-primary" value="Enregistrer">
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php
include_once('partials/footer.php');
