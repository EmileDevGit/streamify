<?php 


include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\CLASS\Song.class.php");


class UserDAO implements DAO{

    // Méthodes DAO
    public static function chercher(string $songID):?object{
        // Connexion à la base de données & Initialisation
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $song=null;
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM song WHERE songID LIKE ?");
        $query->execute(array($songID));
        $e = $query->fetch();
        // Validation du résultat & création de l'objet User
        if($query->rowCount()==0){
            throw new Exception("La chanson n'existe pas");
        } else {
            $user = new Song(
                $e['songID'],
                $e['artistID'],
                $e['playTime'],
                $e['timesPlayed']
            );
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        //Renvoie du User trouvé
        return $user;
    }
    public static function chercherAvecFiltre(string $filtre):array{
         // Connexion à la base de données & Initialisation
         try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $tabSongs=[];

        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM song WHERE songID LIKE '%".$filtre."%'");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute();
        foreach($query as $e){
            $song = new Song(
                $e['songID'],
                $e['artistID'],
                $e['playTime'],
                $e['timesPlayed']
            );
            $tabSongs[] = $song;
        }

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        
        //Renvoie du tableau des User trouvés
        return $tabSongs;
    }
    public static function chercherTous():array{

        // Connexion à la base de données & Initialisation
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $tabSongs=[];

        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM songs");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute();
        foreach($query as $e){
            $song = new Song(
                $e['songID'],
                $e['artistID'],
                $e['playTime'],
                $e['timesPlayed']
            );
            $tabSongs[] = $song;
        }

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        
        //Renvoie du tableau des User trouvés
        return $tabSongs;
    }
    public static function inserer($song):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("INSERT INTO song(songID, artistID, playTime, timesPlayed) VALUES (?,?,?,?)");

        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $song->getSongID(),
                                        $song->getArtistID(), 
                                        $song->getPlayTime(),
                                        $song->getTimesPlayed()
                                    )
                                );

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
        
    }
    public static function modifier($song):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("UPDATE song SET timesPlayed=? WHERE songID = ?");
        // Exécution de la requête

        $retour = $query->execute(array
                                    (
                                        $song->getTimesPlayed(),
                                        $song->getSongID()
                                    )
                                );

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
    }
    public static function supprimer($song):bool{

        // Connexion à la base de données
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }

        // Préparation de la requête
        $query = $connexion->prepare("DELETE FROM song WHERE songID LIKE ?");

        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $song->getSongID()
                                    )
                                );

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();

        // Retour du résultat true|false
        return $retour;
    }

}






?>