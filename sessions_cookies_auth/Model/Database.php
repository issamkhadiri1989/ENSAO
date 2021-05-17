<?php

declare(strict_types=1);

namespace Model;

require_once 'Model\Demande.php';

class Database
{
    /**
     * Connection to the database.
     *
     * @return \PDO
     */
    public function connect()
    {
        //$dsn = 'mysql:host=localhost;dbname=NOM_DATABASE';
        $dsn = 'mysql:host=projet_mysql_1;dbname=docker';
        $username = 'root';
        $password = 'tiger';
        try {
            // Tester s'il y a des erreurs au moment de la connexion
            return new \PDO($dsn, $username, $password);
        } catch (\Exception $exception) {// S'il y a des erreurs,
            die($exception->getMessage()); // Arrete l'execution en affichant le message d'erreur
        }
    }

    /**
     * Connect a user.
     *
     * @param string $username
     * @param string $password
     * @return Collaborateur|Technicien|null
     */
    public function getUser(string $username, string $password)
    {
        try {
            // Se connecter à la base de donnees
            $pdo = $this->connect();
            // pour eviter l'attaque: Injection de dependance
            $query = $pdo->prepare('select * from connexion where username=:u and password=:p');
            $query->bindParam(':u', $username, \PDO::PARAM_STR);
            $query->bindParam(':p', $password, \PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch();
            if (false === $result) {
                return null;
            }
            $user = null;
            // verifier si l'utilisateur  est un collaborateur
            /*var_dump($result['type_user']);
            if ('COLLAB' === $result['type_user']) {
                echo 'COLLAB';
                require_once 'Collaborateur.php';
                $user = new Collaborateur();
            } else {
                $user = new Technicien();
            }
            var_dump($user);*/


//            $user->setUsername($result['username']);
//            $user->setFullName($result['full_name']);
//            $user->setId($result['id']);

            return $result;
        } catch (\Exception $exception) {
            echo $exception->getMessage();

            return null;
        }
    }

    public function addDemand(Demande $demande)
    {
        try {
            $pdo = $this->connect();
            $query = $pdo->prepare('insert into demande 
(demandeur_id, titre, description, type_demande) 
values (:demandeur, :titre, :description, :type_demande)');
            $inserted = $query->execute([
                'demandeur' => $demande->getDemandeur()->getId(),
                'titre' => $demande->getTitre(),
                'description' => $demande->getDescription(),
                'type_demande' => $demande->getType()
            ]);
            var_dump($inserted);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function getDemandsTech($user)
    {
        try {
            $pdo = $this->connect();
            $query = $pdo->prepare('
SELECT 
    `demande`.*,
    `connexion`.`full_name` 
FROM `demande` join `connexion` on `demande`.`demandeur_id` = `connexion`.`id`
where 
 responsable_id=:responsable or responsable_id is null'
            );
            $query->bindParam(':responsable', $user->getId());
            $query->execute();
            $demandes = $query->fetchAll();
            $result = [];
            foreach ($demandes as $demande) {
                $user = new Collaborateur();
                $user->setId($demande['demandeur_id']);
                $user->setFullName($demande['full_name']);
                $item = new Demande();
                $item->setId($demande['id']);
                $item->setType($demande['type_demande']);
                $item->setTitre($demande['titre']);
                $item->setDescription($demande['description']);
                $item->setDemandeur($user);
                $result[] = $item;
            }

            return $result;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function getUserById($id)
    {
        // Se connecter à la base de donnees
        $pdo = $this->connect();
        // pour eviter l'attaque: Injection de dependance
        $query = $pdo->prepare('select * from connexion where id=:u');
        $query->bindParam(':u', $id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        var_dump($pdo->errorInfo());

        return $result;
    }
}