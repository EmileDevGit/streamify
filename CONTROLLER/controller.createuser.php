<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../MODEL/DAO/UserDAO.php");
include_once("../MODEL/CLASS/User.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || !isset($_POST['adminStatus'])) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // Gestion de l'image de profil
        $imageFileName = null;
        if (!empty($_FILES['imageFileName']['name'])) {
            $uploadDir = '../uploads/profile_pictures/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Cré le répertoire s'il n'existe pas
            }
            $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);

            // déplacement de l'image
            if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }
            $imageFileName = $uploadFile;
        } else {
            throw new Exception("Une image de profil est requise.");
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

        if (UserDAO::inserer($user)) {
            echo "Utilisateur ajouté avec succès.";
        } else {
            throw new Exception("Erreur lors de l'ajout de l'utilisateur.");
        }
    } catch (Exception $e) {

        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}

