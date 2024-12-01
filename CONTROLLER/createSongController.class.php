<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once("MODEL/DAO/SongDAO.php");
    include_once("MODEL/CLASS/Song.class.php");
	include_once("CONTROLLER/controller.abstract.class.php");

	class CreateSong extends Controller  {

		public function __construct() {
			parent::__construct();
		}
		public function executerAction():string {
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (!isset($_POST['songName']) || !isset($_POST['playTime']) || !isset($_POST['albumID'])) {
                    throw new Exception("Tous les champs sont obligatoires.");
                }
            
                $imageFileName = null;
                if (!empty($_FILES['imageFileName']['name'])) {
                    $uploadDir = 'VIEW/IMAGES/song';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);
            
                    if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                        throw new Exception("Erreur lors du téléchargement de l'image.");
                    }
            
                    $imageFileName = basename($_FILES['imageFileName']['name']); // garde juste le nom du fichier
                } else {
                    $imageFileName = "defaultSong.png";
                }
            
                $mediaFileName = null;
                if (!empty($_FILES['mediaFileName']['name'])) {
                    $uploadDir = '../uploads/audio_files/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true); 
                    }
                    $uploadFile = $uploadDir . basename($_FILES['mediaFileName']['name']);
            
                    //code erreur(a enlever)
                    if ($_FILES['mediaFileName']['error'] !== UPLOAD_ERR_OK) {
                        throw new Exception("Erreur: " . $_FILES['mediaFileName']['error']);
                    }
                    
            
                    if (!move_uploaded_file($_FILES['mediaFileName']['tmp_name'], $uploadFile)) {
                        throw new Exception("Erreur lors du téléchargement du fichier audio.");
                    }
            
                    $mediaFileName = basename($_FILES['mediaFileName']['name']); 
                } else {
                    throw new Exception("Un fichier audio est requis.");
                }
            
                $song = new Song(
                    null,
                    $_POST['songName'],
                    $_POST['playTime'],
                    0,
                    $imageFileName,
                    $mediaFileName,
                    intval($_POST['albumID'])
                );
            
                try{
                    SongDAO::inserer($song);
                } catch (Exception $e){
                    ?> <script>alert("Chanson déjà existante!")</script> <?php
                    return "manageSong.php";
                }
                // Insertion d'un JS pour demander si veux ajouter un autre user ou retour au menu admin
                ?> <script>alert("Utilisateur ajouté avec succès!")</script> <?php
                // return "manageSong.php";
                return "adminProfile.php";
            } else {
                ?> <script>alert("Méthode non authorisée.")</script> <?php
                return "adminProfile.php";
            }
		}

	}	




