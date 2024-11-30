<?php 


include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\CLASS\Song.class.php");


class SongDAO implements DAO{

    // Méthodes DAO
    public static function chercher(int $songID):?object{
        // Connexion à la base de données & Initialisation
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $song=null;
        // Préparation de la requête
        $query = $connexion->prepare("SELECT * FROM songs WHERE songID = ?");
        $query->execute(array($songID));
        $e = $query->fetch();
        // Validation du résultat & création de l'objet User
        if($query->rowCount()==0){
            throw new Exception("La chanson n'existe pas");
        } else {
            $song = new Song(
                $e['songID'],
                $e['songName'],
                $e['playTime'],
                $e['timesPlayed'],
                $e['imageFileName'],
                $e['mediaFileName'],
                $e['albumID']
            );
        }
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        //Renvoie du User trouvé
        return $song;
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
        $query = $connexion->prepare("SELECT * FROM songs WHERE songName LIKE ?");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute(array("%".$filtre ."%"));
        foreach($query as $e){
            $song = new Song(
                $e['songID'],
                $e['songName'],
                $e['playTime'],
                $e['timesPlayed'],
                $e['imageFileName'],
                $e['mediaFileName'],
                $e['albumID']
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
                $e['songName'],
                $e['playTime'],
                $e['timesPlayed'],
                $e['imageFileName'],
                $e['mediaFileName'],
                $e['albumID']
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
        $query = $connexion->prepare("INSERT INTO songs(songName, playTime, timesPlayed, imageFileName, mediaFileName, albumID) VALUES (?,?,?,?,?,?)");

        // Exécution de la requête
        $retour = $query->execute(array
                                    (
                                        $song->getSongName(),
                                        $song->getPlayTime(),
                                        $song->getTimesPlayed(),
                                        $song->getImageFileName(),
                                        $song->getMediaFileName(),
                                        $song->getAlbumID()
                                        
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
        $query = $connexion->prepare("UPDATE songs SET songName=?, playTime=?, timesPlayed=?, imageFileName=?, albumID=? WHERE songID = ?");
        // Exécution de la requête

        $retour = $query->execute(array
                                    (
                                        $song->getSongName(),
                                        $song->getPlayTime(),
                                        $song->getTimesPlayed(),
                                        $song->getImageFileName(),
                                        $song->getMediaFileName(),
                                        $song->getAlbumID(),
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
        $query = $connexion->prepare("DELETE FROM songs WHERE songID = ?");

        // Exécution de la requête
        $retour = $query->execute(array($song->getSongID()));

        // Reset ID index
        SongDAO::resetID();
        
        // Retour du résultat true|false
        return $retour;
    }
    // Méthode additionelles
    private static function resetID(){
        try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $query = $connexion->prepare("ALTER TABLE songs AUTO_INCREMENT = 1");                  
        $query->execute();
        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
    }
    public static function remplirPlaylist(int $playlistID):array{
        // Connexion à la base de données & Initialisation
        try {
           $connexion=ConnexionDB::getInstance();
       } catch (Exception $e) {
           throw new Exception("Impossible d’obtenir la connexion à la BD."); 
       }
       $tabSongs=[];

       // Préparation de la requête
       $query = $connexion->prepare("   SELECT songs.* 
                                        FROM songs, playlists, playlist_song
                                        WHERE songs.songID = playlist_song.songID AND playlist_song.playlistID = playlists.playlistID
                                        AND playlist_song.playlistID = ?");

       // Exécution de la requête et assemblage du tableau d'utilisateurs
       $query->execute(array($playlistID));
       foreach($query as $e){
           $song = new Song(
            $e['songID'],
            $e['songName'],
            $e['playTime'],
            $e['timesPlayed'],
            $e['imageFileName'],
            $e['mediaFileName'],
            $e['albumID']
           );
           $tabSongs[] = $song;
       }

       // Fermeture de la connexion à la DB
       $query->closeCursor();
       ConnexionDB::close();
       
       //Renvoie du tableau des User trouvés
       return $tabSongs;
    }

    public static function remplirAlbum(int $albumID):array{
            // Connexion à la base de données & Initialisation
            try {
            $connexion=ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Impossible d’obtenir la connexion à la BD."); 
        }
        $tabSongs=[];

        // Préparation de la requête
        $query = $connexion->prepare("   SELECT * 
                                            FROM songs
                                            WHERE songs.albumID = ?");

        // Exécution de la requête et assemblage du tableau d'utilisateurs
        $query->execute(array($albumID));
        foreach($query as $e){
            $song = new Song(
                $e['songID'],
                $e['songName'],
                $e['playTime'],
                $e['timesPlayed'],
                $e['imageFileName'],
                $e['mediaFileName'],
                $e['albumID']
            );
            $tabSongs[] = $song;
        }

        // Fermeture de la connexion à la DB
        $query->closeCursor();
        ConnexionDB::close();
        
        //Renvoie du tableau des User trouvés
        return $tabSongs;
        }

}






?>