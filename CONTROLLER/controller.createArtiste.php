<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../MODEL/DAO/ArtistDAO.php");
include_once("../MODEL/CLASS/Album.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($_POST['artistName'])) {
            throw new Exception("Le nom de l'artiste est obligatoire.");
        }

        $imageFileName = null;
        if (!empty($_FILES['imageFileName']['name'])) {
            $uploadDir = '../uploads/artist_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);

            if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }

            $imageFileName = basename($_FILES['imageFileName']['name']);
        } else {
            throw new Exception("Une image pour l'artiste est requise.");
        }

        $artist = new Artiste(
            null,
            $_POST['artistName'],
            $imageFileName,
            [] 
        );

        if (ArtistDAO::inserer($artist)) {
            echo "Artiste ajouté avec succès.";
        } else {
            throw new Exception("Erreur lors de l'ajout de l'artiste.");
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
