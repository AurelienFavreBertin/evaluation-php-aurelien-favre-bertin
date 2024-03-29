<?php

require 'db.php';
require 'helpers.php';


$error = '';

if (!empty($_POST)) {

    // var_dump($_FILES);
    $photo_db = 'default.jpg';   // photo par défaut


    // Vérif titre
    if (empty($_POST["titre"])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner un titre</div>';
    }
    if (strlen($_POST['titre']) > 150) {
        $error .= '<div class="alert alert-danger">Le titre est trop long</div>';
    }
    // Vérif adresse
    if (empty($_POST["adresse"])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner une adresse</div>';
    }
    if (strlen($_POST['adresse']) > 255) {
        $error .= '<div class="alert alert-danger">L\'adresse est trop longue</div>';
    }
    // Vérif ville
    if (empty($_POST["ville"])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner une ville</div>';
    }
    if (strlen($_POST['ville']) > 150) {
        $error .= '<div class="alert alert-danger">Le nom de la ville est trop long</div>';
    }
    if (ctype_alpha($_POST['ville']) == false) {
        $error .= '<div class="alert alert-danger">Le nom de la ville doit être uniquement en lettre</div>';
    }
    // Vérif cp
    if (empty($_POST["cp"])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner un code postal</div>';
    } else {
        $verif_cp = preg_match('#^[0-9]{5}$#', $_POST["cp"]);
        if (!$verif_cp) {
            $error .= '<div class="alert alert-danger">Veuillez renseigner un code postal avec 5 chiffres</div>';
        }
    }
    // Vérif surface
    if (empty($_POST["surface"])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner une surface</div>';
    }
    if (!is_numeric($_POST['surface'])) {
        $error .= '<div class="alert alert-danger">La surface n\'est pas un nombre</div>';
    }
    // Vérif prix
    if (empty($_POST["prix"])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner un prix</div>';
    }
    if (!is_numeric($_POST['prix'])) {
        $error .= '<div class="alert alert-danger">Le prix n\'est pas un nombre</div>';
    }
    // Vérif type
    if (empty($_POST["type"][0])) {
        $error .= '<div class="alert alert-danger">Veuillez renseigner un type de logement</div>';
    }
    // fin des tests d'erreurs de champs du form


    if (empty($error) && !empty($_FILES['photo']['name'])  && ($_FILES['photo']['error']) == 0) {

        $infosfichier = pathinfo($_FILES['photo']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

        if ($_FILES['photo']['size'] > 2000000) {
            $error .= '<div class="alert alert-danger">Veuillez choisir une photo de 2Mo max</div>';
        } else if (!in_array($extension_upload, $extensions_autorisees)) {
            $error .= '<div class="alert alert-danger">Veuillez choisir une photo au format JPG, JPEG, PNG ou GIF</div>';
        } else {

            $photo_db_ancien = $_FILES['photo']['name'];
            $photo_db_ancien = substr($photo_db_ancien, 0, 5);
            $photo_db_ancien = $photo_db_ancien . rand(1, 9999);
            $photo_db = $photo_db_ancien . "." . $extension_upload;
            $file_tmp_name = $_FILES['photo']['tmp_name'];
            $file_dest = 'photo/' . $photo_db;



            move_uploaded_file($file_tmp_name, $file_dest);

            // partie miniature
            $titreAncienneImage = $photo_db;  // Le nom de l'image de départ AVEC extension
            $extension = $extension_upload;   // L'extension de départ
            $dossierEnregistrement = "photo";   // Le dossier de stockage des images, sans "/" !!!
            $titreNouvelleImage = $photo_db_ancien . '_300x300.' . $extension;   // Le nom de la nouvelle image AVEC extension

            // Enfin, on appelle la fonction !
            createMiniature($titreAncienneImage, $extension, $dossierEnregistrement, $titreNouvelleImage);
        }
    } // fin test photo

    if (empty($error)) {

        $request = 'INSERT INTO logement (titre, adresse, ville, cp, surface, type, description, prix, photo)
                    VALUES (:titre, :adresse, :ville, :cp, :surface, :type, :description, :prix, :photo)';

        $response = $db->prepare($request);

        $response->execute([
            'titre' => $_POST['titre'],
            'adresse' => $_POST['adresse'],
            'ville' => $_POST['ville'],
            'cp' => $_POST['cp'],
            'surface' => $_POST['surface'],
            'type' => $_POST['type'],
            'description' => $_POST['description'],
            'prix' => $_POST['prix'],
            'photo' => $photo_db
        ]);


        $error = '<div class="alert alert-success">Votre logement a bien été ajouté!</div>';
    } // fin de l'insertion des données dans la DB




    // test du nom avec l'id mais ne fonctionne pas
    // if (empty($error)) {

    //     $request = 'INSERT INTO logement (titre, adresse, ville, cp, surface, type, description, prix, photo)
    //                 VALUES (:titre, :adresse, :ville, :cp, :surface, :type, :description, :prix, :photo)';

    //     $response = $db->prepare($request);

    //     $response->execute([
    //         'titre' => $_POST['titre'],
    //         'adresse' => $_POST['adresse'],
    //         'ville' => $_POST['ville'],
    //         'cp' => $_POST['cp'],
    //         'surface' => $_POST['surface'],
    //         'type' => $_POST['type'],
    //         'description' => $_POST['description'],
    //         'prix' => $_POST['prix'],
    //         'photo' => $photo_db
    //     ]);
    //     $id = $db->lastInsertId();
    //     $newName = photo_ . $id;

    //     if (empty($error) && !empty($_FILES['photo']['name'])  && ($_FILES['photo']['error']) == 0) {

    //         $infosfichier = pathinfo($_FILES['photo']['name']);
    //         $extension_upload = $infosfichier['extension'];
    //         $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

    //         if ($_FILES['photo']['size'] > 2000000) {
    //             $error .= '<div class="alert alert-danger">Veuillez choisir une photo de 2Mo max</div>';
    //         } else if (!in_array($extension_upload, $extensions_autorisees)) {
    //             $error .= '<div class="alert alert-danger">Veuillez choisir une photo au format JPG, JPEG, PNG ou GIF</div>';
    //         } else {

    //             $photo_db = $_FILES['photo']['name'];
    //             $photo_db = $photo_db . "." . $extension_upload;

    //             $file_tmp_name = $_FILES['photo']['tmp_name'];
    //             $file_dest = 'photo/' . $photo_db;



    //             move_uploaded_file($file_tmp_name, "'photo/' . $newName . '.' $extension_upload");

    //             $request = "UPDATE logement SET photo = :photo WHERE id_logement = :id";

    //             $response = $db->prepare($request);

    //             $response->execute([
    //                 'id' => $id,
    //                 'photo' => $file_tmp_name, "'photo/' . $newName . '.' $extension_upload"
    //             ]);
    //         }
    //     } 


} // fin de if $_post

include('partials/_header.php');
?>
<div class="col-4">
    <a href="listeBiens.php" class="btn btn-sm btn-secondary">
        Liste des biens en vente
    </a>
</div>
<h1 class="col-md-12 text-center">Ajouter un Logement</h1>

<p class=" col-md-8"> <?= $error ?></p>

<div class=" container">

    <form method="post" action="ajoutBien.php" enctype="multipart/form-data">


        <label for=" titre">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" placeholder="Veuillez saisir un titre ..." required><br>

        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Veuillez saisir une adresse ..." required><br>

        <label for="ville">Ville</label>
        <input type="text" name="ville" id="ville" class="form-control" placeholder="Veuillez saisir une ville ..." required><br>

        <label for="cp">Code Postal</label>
        <input type="number" name="cp" id="cp" class="form-control" placeholder="Veuillez saisir un code postal ..." required><br>

        <label for="surface">Surface en m²</label>
        <input type="number" name="surface" id="surface" class="form-control" placeholder="Veuillez saisir une surface ..." required><br>

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" class="form-control" placeholder="Veuillez saisir un prix ..." required><br>

        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control"><br>

        <label for="type">Type de logement</label>
        <select name="type" id="type" class="form-control" required>
            <option value="0" class="form-control">Veuillez choisir votre type de logement ...</option>
            <option value="location" class="form-control">Location</option>
            <option value="vente" class="form-control">Vente</option>
        </select><br>


        <label for="description">Description</label>
        <textarea name="description" id="description" cols="20" rows="5" class="form-control" placeholder="Veuillez saisir une description ..."></textarea><br>

        <input type="submit" value="Ajouter le logement" class="btn btn-success mb-5">


    </form>


    <!-- // Inclusion du footer -->
    <?php include('partials/_footer.php'); ?>