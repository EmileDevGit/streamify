<?php 
    if (!isset($controller)) header("Location: login.php");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="VIEW/CSS/adminProfileStyle.css">
    <title>Admin - Profile</title>
</head>
<body>
    <header>Administration</header>
    <main>
        <div class="container">
            <a href="?action=gotoManageSearch" class="button" id="btnRecherche">Recherche</a>
            <a href="?action=gotoManageUsers" class="button" id="btnUser">Ajoue utilisateurs</a>
            <a href="?action=gotoManageArtiste" class="button" id="btnArtiste">Ajoue artiste</a>
            <a href="?action=gotoManageAlbum" class="button" id="btnAlbum">Ajoue album</a>
            <a href="?action=gotoManageSong" class="button" id="btnMusique">Ajoue musique</a>
            <br>
            <a href="?action=gotoDiscovery" class="button" id="btnRetour">Retour</a>
        </div>
    </main>
</body>
</html>