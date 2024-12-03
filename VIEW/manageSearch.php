<?php 
    if(!isset($controller)){header("Location: ?action=");}
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}
    $_SESSION["lastView"] = "manageSearch.php";

    // fonctions d'affichage des résultats
function afficherSongs($searchResults){
    if($searchResults!=null){
    ?><table>
        <caption>Musique</caption>
        <tr>
            <th>Nom</th>
            <th>Durée</th>
            <th>Album</th>
            <th>Image</th>
            <th>Media</th>
            <th>Actions</th>
        </tr>

        <?php
        for($i=0;$i<count($searchResults);$i++){
            $albumName = AlbumDAO::chercher($searchResults[$i]->getAlbumID())->getAlbumName();
            ?>
            <tr>
                <td><?php echo $searchResults[$i]->getSongName();?></td>
                <td><?php echo $searchResults[$i]->getPlayTime();?></td>
                <td><?php echo $albumName;?></td>
                <td><?php echo $searchResults[$i]->getImageFileName();?></td>
                <td><?php echo $searchResults[$i]->getMediaFileName();?></td>
                <td>
                    <div class=btnModDel>
                        <a href="?action=gotoManageSong" id="modButton">Modifier</a>
                        <a href="?action=delete&type=song&songID=<?php echo $searchResults[$i]->getSongID()?>" id="delButton">Delete</a>
                    </div>
                </td>
            </tr>
        
    <?php }
    ?> </table> <?php
    } 
}
function afficherArtists($searchResults){
    if($searchResults!=null){
        ?> <table>
    <caption>Artistes</caption>
        <tr>
            <th>Nom</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        <?php
        for($i=0;$i<count($searchResults);$i++){
            ?>
            <tr>
                <td><?php echo $searchResults[$i]->getArtisteName();?></td>
                <td><?php echo $searchResults[$i]->getImageFileName();?></td>
                <td>
                    <div class=btnModDel>
                        <a href="?action=gotoManageArtiste" id="modButton">Modifier</a>
                        <a href="?action=delete&type=artist&artistID=<?php echo $searchResults[$i]->getArtisteID()?>" id="delButton">Delete</a>
                    </div>
                </td>
            </tr>
    <?php } ?> 
    </table> <?php
    }
}
function afficherAlbums($searchResults){
    if($searchResults!=null){?>
    <table>
    <caption>Albums</caption>
        <tr>
            <th>Nom</th>
            <th>Auteur</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        <?php
        for($i=0;$i<count($searchResults);$i++){
            $artistName = ArtistDAO::chercher($searchResults[$i]->getArtistID())->getArtisteName();
            ?>
            <tr>
                <td><?php echo $searchResults[$i]->getAlbumName();?></td>
                <td><?php echo $artistName;?></td>
                <td><?php echo $searchResults[$i]->getImageFileName();?></td>
                <td>
                    <div class=btnModDel>
                        <a href="?action=gotoManageAlbum" id="modButton">Modifier</a>
                        <a href="?action=delete&type=album&albumID=<?php echo $searchResults[$i]->getAlbumID()?>" id="delButton">Delete</a>
                    </div>
                </td>
            </tr>
    <?php }?> 
    </table> <?php
    }
}
function afficherPlaylists($searchResults){
    if($searchResults!=null){?>
        <table>
        <caption>Playlists</caption>
            <tr>
                <th>Nom</th>
                <th>Nbre Écoutes</th>
                <th>Visibilitée</th>
                <th>Image</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
    
            <?php
            for($i=0;$i<count($searchResults);$i++){
                $ownerName = UserDAO::chercher($searchResults[$i]->getUserID())->getUserName();
                ?>
                <tr>
                    <td><?php echo $searchResults[$i]->getPlaylistName();?></td>
                    <td><?php echo $searchResults[$i]->getTimesPlayed();?></td>
                    <td><?php echo $searchResults[$i]->getVisibility();?></td>
                    <td><?php echo $searchResults[$i]->getImageFileName();?></td>
                    <td><?php echo $ownerName?></td>
                    <td>
                        <div class=btnModDel>
                            <a href="?action=gotoManageUsers" id="modButton">Modifier</a>
                            <a href="?action=delete&type=playlist&playlistID=<?php echo $searchResults[$i]->getPlaylistID()?>" id="delButton">Delete</a>
                        </div>
                    </td>
                </tr>
        <?php }?> 
        </table> <?php
    }
}
function afficherUsers($searchResults){
    if($searchResults!=null){?>
    <table>
    <caption>Utilisateur</caption>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        <?php
        for($i=0;$i<count($searchResults);$i++){?>
            <tr>
                <td><?php echo $searchResults[$i]->getUserName();?></td>
                <td><?php echo $searchResults[$i]->getPassword();?></td>
                <td><?php echo $searchResults[$i]->getEmail();?></td>
                <td><?php echo $searchResults[$i]->getAdminStatus();?></td>
                <td><?php echo $searchResults[$i]->getImageFileName();?></td>
                <td>
                    <div class=btnModDel>
                        <a href="?action=gotoManageUsers" id="modButton">Modifier</a>
                        <a href="?action=delete&type=user&userID=<?php echo $searchResults[$i]->getUserID()?>" id="delButton">Delete</a>
                    </div>
                </td>
            </tr>
    <?php }?> 
    </table> <?php
    }
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
                <option value="generalSearch" >Recherche générale</option>
                <option value="songs" >Musique</option>
                <option value="artists" >Artiste</option>
                <option value="playlists" >Playlist</option>
                <option value="albums" >Album</option>
                <option value="users" >Utilisateur</option>
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
                if (isset($_COOKIE['searchResults']) && !empty($_COOKIE['searchResults'])|| isset($_COOKIE["generalSearch"])){

                    $category = $_COOKIE["category"];
                    $searchResults = $_COOKIE["searchResults"];

                    if(isset($_COOKIE["generalSearch"]) && $_COOKIE["generalSearch"] == true){
                        $generalSongs = $_COOKIE["generalSongs"];
                        $generalAlbums = $_COOKIE["generalAlbums"];
                        $generalArtists = $_COOKIE["generalArtists"];
                        $generalPlaylists = $_COOKIE["generalPlaylists"];
                        $generalUsers = $_COOKIE["generalUsers"];
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
                        case "playlists":
                            afficherPlaylists($searchResults);
                            break;
                        case "generalSearch":
                            if($_SESSION["adminStatus"] == 1){
                                afficherUsers($generalUsers);
                                echo "<br>";
                            }
                            afficherPlaylists($generalPlaylists);
                            echo "<br>";
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
                <?php }else{ echo "<p>Aucun Résultats</p>";}?>
    </div>
</body>
</html>
