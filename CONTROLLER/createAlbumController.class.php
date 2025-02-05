<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once("MODEL/DAO/AlbumDAO.php");
    include_once("MODEL/CLASS/Album.class.php");
    
	include_once("CONTROLLER/controller.abstract.class.php");

	class CreateAlbum extends Controller  {

		public function __construct() {
			parent::__construct();
		}
		public function executerAction():string {
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['albumName']) || !isset($_POST['artistID'])) {
                    throw new Exception("Le nom de l'album et l'ID de l'artiste sont obligatoires.");
                }
            
                // Gestion de l'image de l'album
                $imageFileName = null;
                if (!empty($_FILES['imageFileName']['name'])) {
                    $uploadDir = '/VIEW/IMAGES/album/'; // Répertoire des images d'albums
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true); // crée si existe pas
                    }
                    $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);
            
                    if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                        throw new Exception("Erreur lors du téléchargement de l'image.");
                    }
            
                    $imageFileName = basename($_FILES['imageFileName']['name']); // enregistre juste le nom du fichier
                } else {
                    $imageFileName = "defaultAlbum.png";
                }
            
                $album = new Album(
                    null, // ID généré automatiquement
                    $_POST['albumName'],
                    $imageFileName,
                    intval($_POST['artistID']),
                    []
                );
            
                try {
                    AlbumDAO::inserer($album);
                } catch (Exception $e){
                    ?> <script>alert("Album déjà existant!")</script> <?php
                    return "manageAlbum.php";
                }
                // Insertion d'un JS pour demander si veux ajouter un autre user ou retour au menu admin
                ?> <script>alert("Album ajouté avec succès!")</script> <?php
                // return "manageAlbum.php";
                return "adminProfile.php";
            } else {
                ?> <script>alert("Méthode non authorisée.")</script> <?php
                return "adminProfile.php";
            }
		}

	}	





