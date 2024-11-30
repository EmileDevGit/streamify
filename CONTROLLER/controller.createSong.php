<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../MODEL/DAO/SongDAO.php");
include_once("../MODEL/CLASS/Song.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($_POST['songName']) || empty($_POST['playTime']) || empty($_POST['artistID'])) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $imageFileName = null;
        if (!empty($_FILES['imageFileName']['name'])) {
            $uploadDir = '../uploads/song_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);

            if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }

            $imageFileName = basename($_FILES['imageFileName']['name']); // garde juste le nom du fichier
        } else {
            throw new Exception("Une image pour la musique est requise.");
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
            intval($_POST['artistID'])
        );


        if (SongDAO::inserer($song)) {
            echo "Musique ajoutée avec succès.";
        } else {
            throw new Exception("Erreur lors de l'ajout de la musique.");
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
