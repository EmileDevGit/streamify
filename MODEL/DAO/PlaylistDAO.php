<?php 
    include_once("MODEL\DAO\_DAO.interface.php");
    include_once("MODEL\DAO\SongDAO.php");
    include_once("MODEL\CLASS\Playlist.class.php");
    
    
    class PlaylistDAO implements DAO{
        // Méthodes DAO
        public static function chercher(int $playlistID):?object{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $playlist=null;

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM playlists WHERE playlistID = ?");
            $query->execute(array($playlistID));
            $e = $query->fetch();

            // Validation du résultat & création de l'objet Playlist
            if($query->rowCount()==0){
                throw new Exception("La playlist n'existe pas");
            } else {
                $tabSongs=[];
                $tabSongs= SongDAO::remplirPlaylist($playlistID);
                $playlist = new Playlist(
                    $e['playlistID'],
                    $e['playlistName'],
                    $e['timesPlayed'],
                    $e['userID'],
                    $e['public'],
                    $e['imageFileName'],
                    $tabSongs
                );
            }

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();

            //Renvoie de la playlist trouvée
            return $playlist;
        }
        public static function chercherAvecFiltre(string $filtre):array{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabPlaylist=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM playlists WHERE playlistName = ?");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute(array("%".$filtre ."%"));
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirPlaylist($e['playlistID']);
                $playlist = new Playlist(
                    $e['playlistID'],
                    $e['playlistName'],
                    $e['timesPlayed'],
                    $e['userID'],
                    $e['public'],
                    $e['imageFileName'],
                    $tabSongs
                );
                $tabPlaylist[] = $playlist;
            }

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
            
            //Renvoie du tableau des User trouvés
            return $tabPlaylist;
        }
        public static function chercherTous():array{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabPlaylist=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM playlists");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute();
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirPlaylist($e['playlistID']);
                $playlist = new Playlist(
                    $e['playlistID'],
                    $e['playlistName'],
                    $e['timesPlayed'],
                    $e['userID'],
                    $e['public'],
                    $e['imageFileName'],
                    $tabSongs
                );
                $tabPlaylist[] = $playlist;
            }

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
            
            //Renvoie du tableau des User trouvés
            return $tabPlaylist;
        }
        public static function inserer($playlist):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("INSERT INTO playlists(playlistID, timesPlayed, userID, public, imageFileName) VALUES (?,?,?,?,?)");

            // Exécution de la requête
            $retour = $query->execute(array
                                        (
                                            $playlist->getPlaylistID(),
                                            $playlist->getPlaylistName(),
                                            $playlist->getTimesPlayed(),
                                            $playlist->getVisibility(),
                                            $playlist->getImageFileName(),
                                            $playlist->getUserID()
                                        )
                                    );
            
            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();

            // Retour du résultat true|false
            return $retour;
        }
        public static function modifier($playlist):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("UPDATE playlists SET playlistName=?, timesPlayed=?, public=?, imageFileName=?, userID=? WHERE playlistID LIKE ?");
            
            // Exécution de la requête
            $retour = $query->execute(array
                                        (
                                            $playlist->getPlaylistName(),
                                            $playlist->getTimesPlayed(),
                                            $playlist->getVisibility(),
                                            $playlist->getImageFileName(),
                                            $playlist->getuserID(),
                                            $playlist->getPlaylistID()
                                        )
                                    );
            
            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();

            // Retour du résultat true|false
            return $retour;
        }
        public static function supprimer($playlist):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("DELETE FROM playlists WHERE playlistID = ?");
            $retour = $query->execute(array($playlist->getPlaylistID()));

            // Reset ID index
            PlaylistDAO::resetID();
        
            // Retour du résultat true|false
            return $retour;
        }
        private static function resetID(){
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $query = $connexion->prepare("ALTER TABLE playlists AUTO_INCREMENT = 1");                  
            $query->execute();
            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
        }

        // Méthode additionnelle
        public static function collectPlaylist(string $userID){
            $tabPlaylist = [];
            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabPlaylist=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM playlists WHERE userID = ?");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute(array($userID));
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirPlaylist($e['playlistID']);
                $playlist = new Playlist(
                    $e['playlistID'],
                    $e['playlistName'],
                    $e['timesPlayed'],
                    $e['userID'],
                    $e['public'],
                    $e['imageFileName'],
                    $tabSongs
                );
                $tabPlaylist[] = $playlist;
            }

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
            
            //Renvoie du tableau des User trouvés
            return $tabPlaylist;
        }

    }













?>