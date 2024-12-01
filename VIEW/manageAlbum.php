<?php 
    if (!isset($controller)) header("Location: ../?action=");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Album</title>
    <link rel="stylesheet" href="VIEW/CSS/manageAlbumStyle.css">
</head>
<body>
    <main>
        <h1 class="title">Ajouter des album</h1>
        <form action="?action=createAlbum" method="POST" class="form-container" enctype="multipart/form-data">
            <label for="albumName">Nom de l'album :</label>
            <input type="text" id="albumName" name="albumName" maxlength="50" required placeholder="Entrez le nom de l'album">

            <label for="imageFileName">Photo de l'album :</label>
            <input type="file" id="imageFileName" name="imageFileName" accept="image/*" >
            
            <label for="artistID">Artiste auteur :</label>
            <select id="artistList" name="artistID" required>
                <?php
                    $tabArtist = ArtistDAO::chercherTous(); 
                    foreach($tabArtist as $a){ 
                       echo "<option value='"  .$a->getArtisteID() ."'>" .$a->getArtisteName() ."</option>" ;
                    }
                ?>
            </select>
        <div>
            <button type="submit" class="button button-add">Ajouter l'album</button>
        </form>
            <a href="?action=gotoProfile" class="button" id="btnRetour">Retour</a>
        </div>
    </main>
</body>
</html>