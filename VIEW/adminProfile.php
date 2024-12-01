<?php if (!isset($controller)) header("Location: login.php"); ?>




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
            <a href="?action=gotoManageSearch" class="button">Recherche</a>
            <a href="?action=gotoManageUsers" class="button">Ajoue utilisateurs</a>
            <a href="?action=gotoManageArtiste" class="button">Ajoue artiste</a>
            <a href="?action=gotoManageAlbum" class="button">Ajoue album</a>
            <a href="?action=gotoManageSong" class="button">Ajoue musique</a>
        </div>
    </main>
</body>
</html>