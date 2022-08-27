<?php

try {
    $connexion = new PDO('mysql:host=localhost;dbname=tresor', "root", "");
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    die();
}

if (isset($_REQUEST['delete'])) {
    $id = htmlentities($_REQUEST['id']);
    if (delete_($id)) header('Location: liste.php?status=success');
    else header('Location: liste.php?status=error');
    exit;
}

if (isset($_POST['creer_oeuvre'])) {
    $status = 'error';
    if ((!empty($_POST['nom']))) {
        $request = $connexion->prepare("INSERT INTO oeuvres(nom, description, annee, idArtiste, idCategorie) VALUES( ?, ?, ?, ?, ? )");
        $out = $request->execute(array(
            htmlentities($_POST['nom']),
            htmlentities($_POST['description']),
            htmlentities($_POST['annee']),
            htmlentities($_POST['artiste']),
            htmlentities($_POST['categorie']),
        ));
        if ($out) $status = 'success';
        else $status = 'error';
    }
    header("Location: liste.php?status=$status");
    exit;
}

if (isset($_POST['edit_oeuvre'])) {
    $status = 'error';
    $id =  htmlentities($_POST['id_oeuvre']);
    if ((!empty($_POST['nom']))) {
        $request = $connexion->prepare("UPDATE oeuvres SET nom=?,description=?,annee=?,idArtiste=?,idCategorie=? WHERE idOeuvre=" . $id);
        $out = $request->execute(array(
            htmlentities($_POST['nom']),
            htmlentities($_POST['description']),
            htmlentities($_POST['annee']),
            htmlentities($_POST['artiste']),
            htmlentities($_POST['categorie']),
        ));
        if ($out) $status = 'success';
        else $status = 'error';
    }
    header("Location: liste.php?status=$status");
    exit;
}

function delete_($id)
{
    global $connexion;
    $sql = $connexion->prepare('DELETE FROM oeuvres WHERE idOeuvre=?');
    $out = $sql->execute(array($id));
    return $out;
}

function get_oeuvre($id = null)
{
    global $connexion;
    if ($id == null) {
        $sql = $connexion->prepare('SELECT * FROM oeuvres');
        $sql->execute();
        $output = $sql->fetchAll();
    } else {
        $sql = $connexion->prepare('SELECT * FROM oeuvres WHERE idOeuvre=?');
        $sql->execute(array($id));
        $output = $sql->fetch();
    }
    $sql->closeCursor();
    if ($output != null) return $output;
    else return null;
}

function get_auteur($id)
{
    global $connexion;
    $sql = $connexion->prepare('SELECT * FROM artistes WHERE idArtiste=?');
    $sql->execute(array($id));
    $output = $sql->fetch();
    $sql->closeCursor();
    if ($output != null) return $output['nom'] . ' ' . $output['prenom'];
    else return null;
}

function get_categorie($id)
{
    global $connexion;
    $sql = $connexion->prepare('SELECT * FROM categories WHERE idCategorie=?');
    $sql->execute(array($id));
    $output = $sql->fetch();
    $sql->closeCursor();
    if ($output != null) return $output['nomCategorie'];
    else return null;
}

function get_list_auteur()
{
    global $connexion;
    $sql = $connexion->prepare('SELECT * FROM artistes');
    $sql->execute();
    $output = $sql->fetchAll();
    $sql->closeCursor();
    if ($output != null) return $output;
    else return null;
}

function get_list_categorie()
{
    global $connexion;
    $sql = $connexion->prepare('SELECT * FROM categories');
    $sql->execute();
    $output = $sql->fetchAll();
    $sql->closeCursor();
    if ($output != null) return $output;
    else return null;
}

/**
 * Transformer les éléments d'un tableau en option d'un select
 */
function select_option(array $arrays, string $key, string $valeur, $default, $cat = null)
{
    $option = '';
    if ($default != -1) {
        if ($cat != null) {
            foreach ($arrays as $array) {
                if ($array[$key] == $default)
                    $option .= "<option value='" . $array[$key] . "' selected >" . $array[$valeur] . " " . $array[$cat] . "</option>";
                else
                    $option .= "<option value='" . $array[$key] . "' >" . $array[$valeur] . " " . $array[$cat] . "</option>";
            }
        } else {
            foreach ($arrays as $array) {
                if ($array[$key] == $default)
                    $option .= "<option value='" . $array[$key] . "' selected >" . $array[$valeur] . "</option>";
                else
                    $option .= "<option value='" . $array[$key] . "' selected >" . $array[$valeur] . "</option>";
            }
        }
    } else {
        if ($cat != null) {
            foreach ($arrays as $array) {
                $option .= "<option value='" . $array[$key] . "' >" . $array[$valeur] . " " . $array[$cat] . "</option>";
            }
        } else {
            foreach ($arrays as $array) {
                $option .= "<option value='" . $array[$key] . "' >" . $array[$valeur] . "</option>";
            }
        }
    }

    return $option;
}
