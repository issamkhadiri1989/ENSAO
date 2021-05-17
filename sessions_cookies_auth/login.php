<?php
\session_start();
require_once 'Model\Database.php';
require_once 'Model\User.php';
require_once 'Model\Technicien.php';
require_once 'Model\Collaborateur.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
    <?php
        $database = new \Model\Database();
        if (isset($_COOKIE['USER'])) {
            $result = $database->getUserById($_COOKIE['USER']);
        } else {
            //$_POST est un tableau superglobal associatif.
            if ($_POST && isset($_POST['connect'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $result = $database->getUser($username, $password); // recuperer l'objet pour les interactions avec la base de donnees
                $remember = $_POST['remember_me'];
                if (null !== $remember) { // l'utilisateur a choisi de garder sa session
                    \setcookie('USER', $result['id'], time()+3600); // Duree de vie de la cookie est 1h
                }
            }
        }

        if (null !== $result) {
            if ('COLLAB' === $result['type_user']) {
                $user = new \Model\Collaborateur();
            } else {
                $user = new \Model\Technicien();
            }
            $user->setUsername($result['username']);
            $user->setFullName($result['full_name']);
            $user->setId($result['id']);
            $_SESSION['USER'] = $user;

            header('Location: principal.php');
        }
    ?>
    <form method="post">
        <div>
            <label>Login: </label>
            <input type="text" name="username" />
        </div>
        <div>
            <label>Password: </label>
            <input type="password" name="password" />
        </div>
        <div>
            <input type="checkbox" name="remember_me" /> Se souvenir de moi
        </div>
        <button type="submit" name="connect">Envoyer</button>
    </form>
</body>
</html>