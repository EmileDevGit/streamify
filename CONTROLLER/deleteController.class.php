<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");

	class Delete extends Controller  {

		public function __construct() {
			parent::__construct();
		}
        
		public function executerAction():string {

            if(isset($_GET["type"])){
                switch (true){
                    case $_GET["type"] == "album":
                        self::deleteAlbum($_GET["albumID"]);
                        break;
                    case $_GET["type"] == "song":
                        self::deleteSong($_GET["songID"]);
                        break;
                    case $_GET["type"] == "user":
                        if(isset($_GET["userID"])){
                        self::deleteUser($_GET["userID"]);
                        }
                        break;
                    case $_GET["type"] == "playlist":
                        self::deletePlaylist($_GET["playlistID"]);
                        break;
                    case $_GET["type"] == "artist":
                        self::deleteArtist($_GET["artistID"]);
                        break;
                    default:
                        break;
                }
            }
            
            
			return $_SESSION["lastView"];
		}
        function deleteAlbum($albumID){
            try {
                $albumObject = AlbumDAO::chercher($albumID);
                AlbumDAO::supprimer($albumObject);
            } catch (Exception $e) {
                ?> <script>alert("Une erreur est survenue")</script> <?php
            }
        }
        function deleteSong($songID){
            try {
                $songObject = SongDAO::chercher($songID);
                SongDAO::supprimer($songObject);
            } catch (Exception $e) {
                ?> <script>alert("Une erreur est survenue")</script> <?php
            }
        }
        function deleteUser($userID){
            try {
                $userObject = UserDAO::chercher($userID);
                UserDAO::supprimer($userObject);
            } catch (Exception $e) {
                ?> <script>alert("Une erreur est survenue")</script> <?php
            }
        }
        function deletePlaylist($PlaylistID){
            $playlistID = $_GET["playlistID"];
            try {
                $playlistObject = PlaylistDAO::chercher($playlistID);
                PlaylistDAO::supprimer($playlistObject);
            } catch (Exception $e) {
                ?> <script>alert("Une erreur est survenue")</script> <?php
            }
        }
        function deleteArtist($artistID){
            try {
                $artistObject = ArtistDAO::chercher($artistID);
                ArtistDAO::supprimer($artistObject);
            } catch (Exception $e) {
                ?> <script>alert("Une erreur est survenue")</script> <?php
            }
        }
        

		


		
	}	
	
?>