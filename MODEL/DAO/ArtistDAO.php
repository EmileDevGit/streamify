<?php 

include_once("\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\CLASS\Artist.class.php");

class ArtisteDAO implements DAO {

    // Méthodes DAO
    public static function chercher(string $artisteID): ?object {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $artiste = null;
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM artist WHERE artistID LIKE ?");
        $query->execute(array($artisteID));
        $e = $query->fetch();
        // Validation du résultat & création de l'objet Artiste
        if ($query->rowCount() == 0) {
            throw new Exception("L'artiste n'existe pas");
        } else {
            $artiste = new Artiste(
                $e['artistID'],
                $e['imageFileName']
            );
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        // Renvoie de l'Artiste trouvé
        return $artiste;
    }

    public static function chercherAvecFiltre(string $filtre): array {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $tabArtistes = [];
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM artist WHERE artistID LIKE '%" . $filtre . "%'");
        // Exécution de la requête et assemblage du tableau d'artistes
        $query->execute();
        foreach ($query as $e) {
            $artiste = new Artiste(
                $e['artistID'],
                $e['imageFileName']
            );
            $tabArtistes[] = $artiste;
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Renvoie du tableau des Artistes trouvés
        return $tabArtistes;
    }

    public static function chercherTous(): array {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $tabArtistes = [];
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM artist");
        // Exécution de la requête et assemblage du tableau d'artistes
        $query->execute();
        foreach ($query as $e) {
            $artiste = new Artiste(
                $e['artistID'],
                $e['imageFileName']
            );
            $tabArtistes[] = $artiste;
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Renvoie du tableau des Artistes trouvés
        return $tabArtistes;
    }

    public static function inserer($artiste): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("INSERT INTO artist(artistID, imageFileName) VALUES (?, ?)");
        // Exécution de la requête et retour du résultat true|false
        return $query->execute(array(
            $artiste->getArtisteID(),
            $artiste->getImageFileName()
        ));
    }

    public static function modifier($artiste): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("UPDATE artist SET imageFileName = ? WHERE artistID = ?");
        // Exécution de la requête et retour du résultat true|false
        return $query->execute(array(
            $artiste->getImageFileName(),
            $artiste->getArtisteID()
        ));
    }

    public static function supprimer($artiste): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("DELETE FROM artist WHERE artistID LIKE ?");
        // Exécution de la requête et retour du résultat true|false
        return $query->execute(array($artiste->getArtisteID()));
    }
}
?>
