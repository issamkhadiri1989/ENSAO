<?php
require_once 'Model\User.php';
require_once 'Model\Database.php';
require_once 'Model\Collaborateur.php';
require_once 'Model\Technicien.php';
use \Model\Collaborateur;
use \Model\Technicien;
session_start();
/** @var Collaborateur|Technicien $user */
$user = $_SESSION['USER'];
$database = new \Model\Database();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page principale</title>
</head>
<body>
<h1>Bonjour '<?php echo $user->getFullName() ?>'</h1>
<a href="logout.php">Deconnecter</a>
<?php if ($user instanceof Collaborateur)  {?>
<a href="nouvelle.php">Ajouter un incident</a>
<?php } else {
    $demandes = $database->getDemandsTech($user);
}?>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Type</th>
        <th>Demandeur</th>
    </tr>
    </thead>
    <tbody>

    <?php
        /** @var \Model\Demande $demande */
    foreach ($demandes as $demande) {   ?>
        <tr>
            <td><?php echo $demande->getId() ?></td>
            <td><?php echo $demande->getTitre() ?></td>
            <td><?php echo $demande->getDescription() ?></td>
            <td><?php echo $demande->getType() ?></td>
            <td><?php echo $demande->getDemandeur()->getFullName() ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>