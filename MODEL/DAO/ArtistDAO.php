<?php 

include_once("\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\DAO\AlbumDAO.php");
include_once("\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\CLASS\Artist.class.php");

class ArtistDAO implements DAO {

    // Méthodes DAO
    public static function chercher(int $artistID): ?object {
        // Connexion à la base de données & Initialisation
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        $artiste = null;
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM artists WHERE artistID = ?");
        $query->execute(array($artistID));
        $e = $query->fetch();
        // Validation du résultat & création de l'objet Artiste
        if ($query->rowCount() == 0) {
            throw new Exception("L'artiste n'existe pas");
        } else {
            $tabAlbums = [];
            $tabAlbums = AlbumDAO::collectAlbums($artistID);
            $artiste = new Artiste(
                $e['artistID'],
                $e['artistName'],
                $e['imageFileName'],
                $tabAlbums
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
        $query = $connexion->prepare("SELECT * FROM artists WHERE artistName LIKE ?");
        // Exécution de la requête et assemblage du tableau d'artistes
        $query->execute(array("%".$filtre ."%"));
        foreach ($query as $e) {
            $tabAlbums =[];
            $tabAlbums = AlbumDAO::collectAlbums($e['artistID']);
            $artiste = new Artiste(
                $e['artistID'],
                $e['artistName'],
                $e['imageFileName'],
                $tabAlbums
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
        $query = $connexion->prepare("SELECT * FROM artists");
        // Exécution de la requête et assemblage du tableau d'artistes
        $query->execute();
        foreach ($query as $e) {
            $tabAlbums =[];
            $tabAlbums = AlbumDAO::collectAlbums($e['artistID']);
            $artiste = new Artiste(
                $e['artistID'],
                $e['artistName'],
                $e['imageFileName'],
                $tabAlbums
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
        $query = $connexion->prepare("INSERT INTO artists(artistName, imageFileName) VALUES (?,?)");
        // Exécution de la requête 
        $retour = $query->execute(array(
            $artiste->getArtisteName(),
            $artiste->getImageFileName()
        ));
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        // Retour du résultat true|false
        return $retour;
    }
    public static function modifier($artiste): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("UPDATE artists SET artistName=?, imageFileName = ? WHERE artistID = ?");
        // Exécution de la requête 
        $retour = $query->execute(array(
            $artiste->getArtisteName(),
            $artiste->getImageFileName(),
            $artiste->getArtisteID()
        ));
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        // Retour du résultat true|false
        return $retour;
    }
    public static function supprimer($artiste): bool {
        // Connexion à la base de données
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD.");
        }
        // Préparation de la requête
        $query = $connexion->prepare("DELETE FROM artists WHERE artistID = ?");
        // Exécution de la requête 
        $retour = $query->execute(array(
            $artiste->getArtisteID()
        ));
        // Reset ID index
        ArtistDAO::resetID();
        
        // Retour du résultat true|false
        return $retour;
    }

    private static function resetID(){
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $query = $connexion->prepare("ALTER TABLE artists AUTO_INCREMENT = 1");                  
        $query->execute();
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
    }
}
?>
