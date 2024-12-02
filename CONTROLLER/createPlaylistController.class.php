<?php

include_once("CONTROLLER/controller.abstract.class.php");
include_once("MODEL/DAO/PlaylistDAO.php");
include_once("MODEL/CLASS/Playlist.class.php");

class CreatePlaylist extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function executerAction(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['playlistName']) || !isset($_POST['visibility']) || !isset($_POST['userID'])) {
                throw new Exception("Tous les champs obligatoires doivent être remplis.");
            }

            $imageFileName = "defaultPlaylist.png";
            if (!empty($_FILES['imageFileName']['name'])) {
                $uploadDir = 'VIEW/IMAGES/playlist/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadFile = $uploadDir . basename($_FILES['imageFileName']['name']);
                if (!move_uploaded_file($_FILES['imageFileName']['tmp_name'], $uploadFile)) {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }
                $imageFileName = basename($_FILES['imageFileName']['name']);
            }

            $playlist = new Playlist(
                null,
                $_POST['playlistName'],
                0, // (time played) je savais pas trop quoi fair avec sa donc jles mi a 0
                intval($_POST['visibility']),
                $imageFileName,
                [],
                $_POST['userID']
            );

            try {
                PlaylistDAO::inserer($playlist);
            } catch (Exception $e) {
                ?> <script>alert("Erreur : La playlist existe déjà !");</script> <?php
                return "managePlaylist.php";
            }

            ?> <script>alert("Playlist ajoutée avec succès !");</script> <?php
            return "adminProfile.php"; 
        } else {
            ?> <script>alert("Méthode non autorisée.");</script> <?php
            return "adminProfile.php";
        }
    }
}
?>
