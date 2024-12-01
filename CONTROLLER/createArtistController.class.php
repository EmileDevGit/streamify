
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("MODEL/DAO/ArtistDAO.php");
include_once("MODEL/CLASS/Album.class.php");
include_once("CONTROLLER/controller.abstract.class.php");

class CreateArtist extends Controller  {

    public function __construct() {
        parent::__construct();
    }
    public function executerAction():string {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_POST['artistName'])) {
                throw new Exception("Le nom de l'artiste est obligatoire.");
            }

            // Gestion de l'image de l'artiste
            $imageFileName = null;
            if (!empty($_FILES['imageFileName']['name'])) {
                $uploadDir = 'VIEW/IMAGES/artist/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Créer le répertoire s'il n'existe pas
                }
                $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);
    
                if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }
    
                $imageFileName = basename($_FILES['imageFileName']['name']);
            } else {
                $imageFileName = "defaultArtist.png";
            }
            // Création de l'objet Artiste
            $artist = new Artiste(
                null, // ID utilisateur
                $_POST['artistName'],
                $imageFileName,
                [] 
            );

            // Insertition de l'objet Artiste dans la BD
            try {
                ArtistDAO::inserer($artist);
            } catch (Exception $e){
                ?> <script>alert("Artiste déjà existant!")</script> <?php
                return "manageArtiste.php";
            }

            // **** AJOUTER JS pour demander si veux ajouter un autre Artiste ou retour au menu admin
            ?> <script>alert("Artiste ajouté avec succès!")</script> <?php
            // return "manageArtiste";
            return "adminProfile.php";
        } else {
            ?> <script>alert("Méthode non authorisée.")</script> <?php
        }
        return "manageArtiste.php";
    }

}	

