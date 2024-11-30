<?php 
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\_DAO.interface.php");
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\SongDAO.php");
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\CLASS\Album.class.php");
    
    
    class AlbumDAO implements DAO{
        // Méthodes DAO
        public static function chercher(int $albumID):?object{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $album=null;

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM albums WHERE albumID = ?");
            $query->execute(array($albumID));
            $e = $query->fetch();

            // Validation du résultat & création de l'objet Playlist
            if($query->rowCount()==0){
                throw new Exception("La playlist n'existe pas");
            } else {
                $tabSongs=[];
                $tabSongs= SongDAO::remplirAlbum($albumID);
                $album = new Album(
                    $e['albumID'],
                    $e['albumName'],
                    $e['imageFileName'],
                    $e['artistID'],
                    $tabSongs
                );
            }

            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();

            //Renvoie de la playlist trouvée
            return $album;
        }
        public static function chercherAvecFiltre(string $filtre):array{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabAlbums=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM albums WHERE albumName LIKE ?");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute(array("%".$filtre ."%"));
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirAlbum($e['albumID']);
                $album = new Album(
                    $e['albumID'],
                    $e['albumName'],
                    $e['imageFileName'],
                    $e['artistID'],
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
        public static function chercherTous():array{

            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabAlbums=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM albums");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute();
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirAlbum($e['albumID']);
                $album = new Album(
                    $e['albumID'],
                    $e['albumName'],
                    $e['imageFileName'],
                    $e['artistID'],
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
        public static function inserer($album):bool{

            // Connexion à la base de données
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }

            // Préparation de la requête
            $query = $connexion->prepare("INSERT INTO albums(albumName, artistID, imageFileName) VALUES (?,?,?)");

            // Exécution de la requête
            $retour = $query->execute(array
                                        (
                                            $album->getAlbumName(),
                                            $album->getArtistID(),
                                            $album->getimageFileName()
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
            $query = $connexion->prepare("UPDATE albums SET albumName=?, imageFileName=? artistID=? WHERE albumId = ?");
            
            // Exécution de la requête
            $retour = $query->execute(array
                                        (
                                            $album->getAlbumName(),
                                            $album->getImageFileName(),
                                            $album->getArtistID(),
                                            $album->getAlbumID()
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
            $query = $connexion->prepare("DELETE FROM albums WHERE albumID = ?");
            $retour = $query->execute(array
                                        (
                                            $album->getAlbumID()
                                        )
                                    );

            // Reset ID index
            AlbumDAO::resetID();
            
            // Retour du résultat true|false
            return $retour;
        }

        private static function resetID(){
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $query = $connexion->prepare("ALTER TABLE albums AUTO_INCREMENT = 1");                  
            $query->execute();
            // Fermeture de la connexion à la DB
            $query->closeCursor();
            ConnexionDB::close();
        }

        // Méthode pour populer un album
        public static function collectAlbums(string $artistID){
            // Connexion à la base de données & Initialisation
            try {
                $connexion=ConnexionDB::getInstance();
            } catch (Exception $e) {
                throw new Exception("Impossible d’obtenir la connexion à la BD."); 
            }
            $tabAlbums=[];

            // Préparation de la requête
            $query = $connexion->prepare("SELECT * FROM albums WHERE artistID = ?");

            // Exécution de la requête et assemblage du tableau d'utilisateurs
            $query->execute(array($artistID));
            foreach($query as $e){
                $tabSongs=[];
                $tabSongs= SongDAO::remplirAlbum($e['albumID']);
                $album = new Album(
                    $e['albumID'],
                    $e['albumName'],
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