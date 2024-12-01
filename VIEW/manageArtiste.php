<?php if (!isset($controller)) header("Location: login.php"); ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des artistes</title>
    <link rel="stylesheet" href="VIEW/CSS/manageArtisteStyle.css">

</head>
<body>

    <main>
        <h1 class="title">Ajouter des artistes</h1>
        <form action="?action=createArtist" method="POST" class="form-container" enctype="multipart/form-data">
            <label for="artistName">Nom de l'artiste :</label>
            <input type="text" id="artistName" name="artistName" maxlength="50" required placeholder="Entrez le nom de l'artiste">

            <label for="imageFileName">Photo de l'artiste :</label>
            <input type="file" id="imageFileName" name="imageFileName" accept="image/*" >

            <button type="submit" class="button button-add">Ajouter l'artiste</button>
        </form>
    </main>
</body>
</html>