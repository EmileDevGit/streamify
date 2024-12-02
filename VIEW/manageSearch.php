<?php if (!isset($controller)) { echo "Erreur : contrôleur introuvable."; exit; } 
    
function afficherSongs($searchResults){
    ?><table>
        <caption>Musique</caption>
        <tr>
            <th>Nom</th>
            <th>Durée</th>
            <th>Album</th>
            <th>Image</th>
            <th>Media</th>
        </tr>

        <?php
        foreach($searchResults as $r){
            $albumName = AlbumDAO::chercher($r->getAlbumID())->getAlbumName();
            ?>
            <tr>
                <td><?php echo $r->getSongName();?></td>
                <td><?php echo $r->getPlayTime();?></td>
                <td><?php echo $albumName;?></td>
                <td><?php echo $r->getImageFileName();?></td>
                <td><?php echo $r->getMediaFileName();?></td>
            </tr>
        
    <?php }
    ?> </table> <?php
}
function afficherArtists($searchResults){
    ?> <table>
    <caption>Artistes</caption>
        <tr>
            <th>Nom</th>
            <th>Image</th>
        </tr>

        <?php
        foreach($searchResults as $r){?>
            <tr>
                <td><?php echo $r->getArtisteName();?></td>
                <td><?php echo $r->getImageFileName();?></td>
            </tr>
    <?php } ?> 
    </table> <?php
}
function afficherAlbums($searchResults){
    ?>
    <table>
    <caption>Albums</caption>
        <tr>
            <th>Nom</th>
            <th>Auteur</th>
            <th>Image</th>
        </tr>

        <?php
        foreach($searchResults as $r){
            $artistName = ArtistDAO::chercher($r->getArtistID())->getArtisteName();
            ?>
            <tr>
                <td><?php echo $r->getAlbumName();?></td>
                <td><?php echo $artistName;?></td>
                <td><?php echo $r->getImageFileName();?></td>
            </tr>
    <?php }?> 
    </table> <?php
}
function afficherUsers($searchResults){
    ?>
    <table>
    <caption>Utilisateur</caption>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Image</th>
        </tr>

        <?php
        foreach($searchResults as $r){?>
            <tr>
                <td><?php echo $r->getUserName();?></td>
                <td><?php echo $r->getPassword();?></td>
                <td><?php echo $r->getEmail();?></td>
                <td><?php echo $r->getAdminStatus();?></td>
                <td><?php echo $r->getImageFileName();?></td>
            </tr>
    <?php }?> 
    </table> <?php
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
                <option value="generalSearch" >Recherche générale</option>
            </select>

            <label for="searchQuery">Rechercher :</label>
            <input type="text" id="searchQuery" name="query" placeholder="Entrez un mot-clé">
        <div>
            <button type="submit" class="button button-search">Rechercher</button>
        </form>
        
            <a href="?action=gotoProfile" class="button" id="btnRetour">Retour</a>
        </div>
    </main>
    <div class="result">
        <h2>Résultats de la recherche</h2>
            <?php
                if (isset($_COOKIE['searchResults']) && !empty($_COOKIE['searchResults']) || isset($_COOKIE["generalSearch"])){

                    $category = $_COOKIE["category"];
                    $searchResults = $_COOKIE["searchResults"];

                    if(isset($_COOKIE["generalSearch"]) && $_COOKIE["generalSearch"] == true){
                        $generalSongs = $_COOKIE["generalSongs"];
                        $generalAlbums = $_COOKIE["generalAlbums"];
                        $generalArtists = $_COOKIE["generalArtists"];
                        $generalUsers = $_COOKIE["generalUsers"];

                        // Clear les cookies de résultats
                        unset($_COOKIE["generalSearch"]);
                        unset($_COOKIE["generalSongs"]);
                        unset($_COOKIE["generalSongs"]);
                        unset($_COOKIE["generalSongs"]);
                        unset($_COOKIE["generalSongs"]);
                    }
                    if(isset($_COOKIE["category"])){
                        unset($_COOKIE["category"]);
                    }
                    if(isset($_COOKIE["searchResults"])){
                        unset($_COOKIE["searchResults"]);
                    }

                    switch ($category){
                        case "songs":
                            afficherSongs($searchResults);
                            break;
                        case "artists":
                            afficherArtists($searchResults);
                            break;
                        case "albums":
                            afficherAlbums($searchResults);
                            break;
                        case "users":
                            afficherUsers($searchResults);
                            break;
                        case "generalSearch":
                            if($_SESSION["adminStatus"] == 1){
                                afficherUsers($generalUsers);
                                echo "<br>";
                            }
                            afficherSongs($generalSongs);
                            echo "<br>";
                            afficherAlbums($generalAlbums);
                            echo "<br>";
                            afficherArtists($generalArtists);
                            echo "<br>";
                            break;
                        default:
                            break;
                    }

            ?>
                <?php }else{ echo "Aucun Résultats";}?>
    </div>
</body>
</html>
