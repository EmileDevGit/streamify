<?php 

include_once("C:\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("C:\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\CLASS\admin.class.php");

class AdminDAO implements DAO {

    // Méthodes DAO
    public static function chercher(string $adminID): ?object {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $admin = null;
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM admin WHERE adminID = ?");
        $query->execute(array($adminID));
        $e = $query->fetch();
        // Validation du résultat & création de l'objet Admin
        if ($e) {
            $admin = new Admin(
                $e['adminID'],
                $e['password'],
                $e['email']
            );
        } else {
            throw new Exception("L'administrateur avec l'ID $adminID n'existe pas.");
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        // Renvoie de l'Admin trouvé
        return $admin;
    }

    public static function chercherAvecFiltre(string $filtre): array {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $tabAdmins = [];
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM admin WHERE email LIKE ?");
        $query->execute(array("%$filtre%"));
        foreach ($query as $e) {
            $admin = new Admin(
                $e['adminID'],
                $e['password'],
                $e['email']
            );
            $tabAdmins[] = $admin;
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Renvoie du tableau des Admins trouvés
        return $tabAdmins;
    }

    public static function chercherTous(): array {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $tabAdmins = [];
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM admin");
        $query->execute();
        foreach ($query as $e) {
            $admin = new Admin(
                $e['adminID'],
                $e['password'],
                $e['email']
            );
            $tabAdmins[] = $admin;
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Renvoie du tableau des Admins trouvés
        return $tabAdmins;
    }

    public static function inserer($admin): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("INSERT INTO admin (adminID, password, email) VALUES (?, ?, ?)");
        // Exécution de la requête et retour du résultat true|false
        return $query->execute(array(
            $admin->getAdminID(),
            $admin->getPassword(),
            $admin->getEmail()
        ));
    }

    public static function modifier($admin): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("UPDATE admin SET password = ?, email = ? WHERE adminID = ?");
        // Exécution de la requête et retour du résultat true|false
        return $query->execute(array(
            $admin->getPassword(),
            $admin->getEmail(),
            $admin->getAdminID()
        ));
    }

    public static function supprimer($admin): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("DELETE FROM admin WHERE adminID = ?");
        // Exécution de la requête et retour du résultat true|false
        return $query->execute(array($admin->getAdminID()));
    }
}

?>
