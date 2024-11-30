<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../MODEL/DAO/AlbumDAO.php");
include_once("../MODEL/CLASS/Album.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($_POST['albumName']) || empty($_POST['artistID'])) {
            throw new Exception("Le nom de l'album et l'ID de l'artiste sont obligatoires.");
        }

        // Gestion de l'image de l'album
        $imageFileName = null;
        if (!empty($_FILES['imageFileName']['name'])) {
            $uploadDir = '../uploads/album_covers/'; // Répertoire des images d'albums
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // crée si existe pas
            }
            $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);

            if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }

            $imageFileName = basename($_FILES['imageFileName']['name']); // enregistre juste le nom du fichier
        } else {
            throw new Exception("Une image pour l'album est requise.");
        }

        $album = new Album(
            null, // ID généré automatiquement
            $_POST['albumName'],
            $imageFileName,
            intval($_POST['artistID']),
            []
        );

        if (AlbumDAO::inserer($album)) {
            echo "Album ajouté avec succès.";
        } else {
            throw new Exception("Erreur lors de l'ajout de l'album.");
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}

