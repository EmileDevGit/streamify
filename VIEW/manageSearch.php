<?php if (!isset($controller)) { echo "Erreur : contrôleur introuvable."; exit; } 
    
function afficherSongs($searchResults){
    ?>
                        <tr>
                            <th>Nom</th>
                            <th>Durée</th>
                            <th>Image</th>
                            <th>Media</th>
                        </tr>

                        <?php
                        foreach($searchResults as $r){?>
                            <tr>
                                <td><?php echo $r->getSongName();?></td>
                                <td><?php echo $r->getPlayTime();?></td>
                                <td><?php echo $r->getImageFileName();?></td>
                                <td><?php echo $r->getMediaFileName();?></td>
                            </tr>
                    <?php }
}


?>

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

        <h1 class="title">Recherche</h1>
        <form action="?action=search" method="POST" class="form-container">
            <label for="searchCategory">Catégorie de recherche :</label>
            <select id="searchCategory" name="category" required>
                <option value="">Choisir une catégorie</option>
                <option value="songs" >Musique</option>
                <option value="artists" >Artiste</option>
                <option value="albums" >Album</option>
                <option value="users" >Utilisateur</option>
            </select>

            <label for="searchQuery">Rechercher :</label>
            <input type="text" id="searchQuery" name="query" placeholder="Entrez un mot-clé">

            <button type="submit" class="button button-search">Rechercher</button>
        </form>
        
            <a href="?action=gotoProfile" class="button" id="btnRetour">Retour</a>
        </div>

        <div class="result">
        <h2>Résultats de la recherche</h2>
        <table ><?php
             if (isset($_COOKIE['searchResults']) && !empty($_COOKIE['searchResults'])){

                $category = $_COOKIE["category"];
                $searchResults = $_COOKIE["searchResults"];

                switch ($category){
                    case "songs":
                        afficherSongs($searchResults);
                        break;
                    case "artists":
                        //afficherArtists($searchResults);
                        break;
                    case "albums":
                        //afficherAlbums($searchResults);
                        break;
                    case "users":
                        //afficherUsers($searchResults);
                        break;
                    case "showAll":
                        afficherSongs($searchResults);
                        //afficherUsers($searchResults);
                        break;
                    default:
                        break;
                }

        ?></table>
            <?php }else{ echo "Aucun Résultats";}?>
        </div>
    </main>
</body>
</html>
