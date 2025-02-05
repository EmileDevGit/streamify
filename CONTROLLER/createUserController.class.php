<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once("CONTROLLER/controller.abstract.class.php");
    include_once("MODEL/DAO/UserDAO.php");
    include_once("MODEL/CLASS/User.class.php");


	class CreateUser extends Controller  {

		public function __construct() {
			parent::__construct();
		}

		public function executerAction():string {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['adminStatus'])) {
                    throw new Exception("Tous les champs sont obligatoires.");
                }
        
                // Gestion de l'image de profil
                $imageFileName = null;
                if (!empty($_FILES['imageFileName']['name'])) {
                        $uploadDir = 'VIEW/IMAGES/profile/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true); // Créer le répertoire s'il n'existe pas
                        }
                        $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);
            
                        // déplacement de l'image
                        if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                            throw new Exception("Erreur lors du téléchargement de l'image.");
                        }
                        $imageFileName = basename($_FILES['imageFileName']['name']);
                    } else {
                        $imageFileName = "defaultProfile.png";
                    }
        
                $user = new User(
                    null, // ID utilisateur 
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['email'],
                    intval($_POST['adminStatus']),
                    $imageFileName,
                    [] 
                );
                try{
                    UserDAO::inserer($user);
                } catch (Exception $e){
                    ?> <script>alert("Nom d'utilisateur ou courriel déjà existant!")</script> <?php
                    return "manageUsers.php";
                }

                // Insertion d'un JS pour demander si veux ajouter un autre user ou retour au menu admin
                ?> <script>alert("Utilisateur ajouté avec succès!")</script> <?php
                // return "manageUsers";
                return "adminProfile.php";
            } else {
                ?> <script>alert("Méthode non authorisée.")</script> <?php
                return "adminProfile.php";
            }
            
		}
	}



