<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("CONTROLLER/controller.abstract.class.php");
include_once("MODEL/DAO/UserDAO.php");
include_once("MODEL/CLASS/User.class.php");

class UpdateProfile extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function executerAction(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Gestion image de profil
            $imageFileName = null;
            if (!empty($_FILES['profilePic']['name'])) {
                $uploadDir = 'VIEW/IMAGES/profile/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); 
                }

                $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);
                
                // Déplacement de l'image téléchargée dans le répertoire
                if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
                    $imageFileName = basename($_FILES['profilePic']['name']);
                } else {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }
            }

            // Mise à jour base de données
            $userID = $_SESSION['userID'];
            $user = UserDAO::chercher($userID);
            $user->setImageFileName($imageFileName);

            try {
                UserDAO::modifier($user);
                $_SESSION['success'] = "Votre photo de profil a été mise à jour avec succès.";
            } catch (Exception $e) {
                $_SESSION['error'] = "Erreur lors de la mise à jour de la photo de profil.";
            }
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
        }
        return "userProfile.php";
    }
}
?>

