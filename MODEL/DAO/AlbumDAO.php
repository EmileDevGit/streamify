<?php 
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\SongDAO.php");
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\CLASS\Album.class.php");
    
    
    class AlbumDAO implements DAO{
        // Méthodes DAO
        public static function chercher(string $playlistID):?object{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $playlist=null;

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM playlist WHERE playlistID LIKE ?");
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
            $query = $connexion->prepare("SELECT * FROM playlist WHERE playlistID LIKE '%".$filtre."%'");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute();
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirPlaylist($e['playlistID']);
                $playlist = new Playlist(
                    $e['playlistID'],
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
            $tabUsers=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM playlist");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute();
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirPlaylist($e['playlistID']);
                $playlist = new Playlist(
                    $e['playlistID'],
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
        public static function inserer($album):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("INSERT INTO album(albumID, artistID, imageFileName) VALUES (?,?,?)");

            // Exécution de la requête
            $retour = $query->execute(array
                                        (
                                            $album->getAlbumID(),
                                            $album->getArtistID(),
                                            $album->imageFileName()
                                        )
                                    );
            
            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();

            // Retour du résultat true|false
            return $retour;
        }
        public static function modifier($album):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("UPDATE album SET imageFileName=? WHERE albumId LIKE ?");
            
            // Exécution de la requête
            $retour = $query->execute(array
                                        (
                                            $album->getImageFileName(),
                                            $album->getPlaylistID()
                                        )
                                    );
            
            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();

            // Retour du résultat true|false
            return $retour;
        }
        public static function supprimer($album):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("DELETE FROM album WHERE albumID LIKE ?");
            $retour = $query->execute(array
                                        (
                                            $album->getAlbumID()
                                        )
                                    );

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
            
            // Retour du résultat true|false
            return $retour;
        }

        // Méthode pour populer un album
        public static function collectAlbum(string $artistID){
            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabAlbums=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM album WHERE artistID LIKE '?'");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute(array($artistID));
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirAlbum($e['albumID']);
                $album = new Album(
                    $e['albumID'],
                    $e['artistID'],
                    $e['imageFileName'],
                    $tabSongs
                );
                $tabAlbums[] = $album;
            }

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
            
            //Renvoie du tableau des User trouvés
            return $tabAlbums;
        }

    }