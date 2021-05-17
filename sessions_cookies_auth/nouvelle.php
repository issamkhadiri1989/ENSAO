<?php
require_once 'Model\Database.php';
require_once 'Model\User.php';
require_once 'Model\Collaborateur.php';
require_once 'Model\Technicien.php';
require_once 'Model\Demande.php';
use \Model\Collaborateur;
use \Model\Technicien;
session_start();
/** @var Collaborateur $user */
$user = $_SESSION['USER'];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Nouvelle demande</title>
    </head>
    <body>
        <h1>Nouvelle demande</h1>
        <?php
            if ($_POST && isset($_POST['demande'])) {
                $database = new \Model\Database();
                $titre = $_POST['titre'];
                $description = $_POST['description'];
                $type_demande = $_POST['type_demande'];
                $demandeur = $_SESSION['USER'];
                $type = $_POST['type_demande'];

                $demande = new \Model\Demande();
                $demande->setDescription($description);
                $demande->setTitre($titre);
                $demande->setType($type_demande);
                $demande->setDemandeur($demandeur);

                $database->addDemand($demande);
               header('Location: principal.php');
            }
        ?>
        <form method="post">
            <div>
                <label>Titre</label>
                <input type="text" name="titre"/>
            </div>
            <div>
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>
            <div>
                <label>Type de demande</label>
                <select name="type_demande">
                    <option>Incident</option>
                    <option>Demande</option>
                </select>
            </div>
            <button type="submit" name="demande">Envoyer</button>
        </form>
    </body>
</html>