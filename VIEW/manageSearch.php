<?php if (!isset($controller)) {header("Location: login.php");} ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="VIEW/CSS/manageSearchStyle.css">
</head>
<body>
    <main>
        <h1 class=title>Recherche</h1>
        <form action="search.php" method="GET" class="form-container">
            <label for="searchCategory">Catégorie de recherche :</label>
            <select id="searchCategory" name="category" required>
                <option value="songs">Musique</option>
                <option value="artists">Artiste</option>
                <option value="albums">Album</option>
                <option value="users">Utilisateur</option>
            </select>

            <label for="searchQuery">Rechercher :</label>
            <input type="text" id="searchQuery" name="query">

            <button type="submit" class="button button-search">Rechercher</button>
        </form>


    <div class="result">

    </div>

    </main>
</body>
</html>
