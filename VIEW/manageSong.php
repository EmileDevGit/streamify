<?php 

    if (!isset($controller)) header("Location: login.php");
    include_once ("MODEL/CLASS/Album.class.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des musique</title>
    <link rel="stylesheet" href="VIEW/CSS/manageSongStyle.css">
</head>
<body>
    <main>
        <h1 class="title">Ajouter des musique</h1>
        <form action="/STREAMIFY/streamify_emile-girard_emile-larochelle/CONTROLLER/controller.createSong.php" method="POST" class="form-container" enctype="multipart/form-data">
            <label for="songName">Nom de la musique :</label>
            <input type="text" id="songName" name="songName" maxlength="50" required placeholder="Entrez le nom de la musique">

            <label for="albumList">Album :</label>
            <select id="albumList" name="albumID" required>
                <?php
                    $tabArtist = AlbumDAO::chercherTous(); 
                    foreach($tabArtist as $a){ 
                       echo "<option value='"  .$a->getAlbumID() ."'>" .$a->getAlbumName() ."</option>" ;
                    }
                ?>
            </select>

            <label for="playTime">Durée de la musique :</label>
            <input type="text" id="playTime" name="playTime" maxlength="50" required placeholder="Exemple : 03:45">

            <label for="imageFileName">Image de la musique :</label>
            <input type="file" id="imageFileName" name="imageFileName" accept="image/*" >

            <label for="mediaFileName">Fichier audio :</label>
            <input type="file" id="mediaFileName" name="mediaFileName" accept="audio/*" required>
            <button type="submit" class="button button-add">Ajouter la musique</button>
            
        </form>
        <a href="?action=gotoProfile"></a>
        <button class="button button-return">Retour</button>
    </main>
</body>
</html>