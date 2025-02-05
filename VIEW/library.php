<?php 
    if(!isset($controller)){header("Location: ?action=");}
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}
    $_SESSION["lastView"] = "library.php";

    // Fonction d'affichage des playlists de l'utilisateur
    function displayPlaylists(){
        $tabPlaylists = PlaylistDAO::chercherTous();
        for ($i=0;$i<count($tabPlaylists);$i++){
            $playlist = $tabPlaylists[$i];
            if($playlist->getUserID()==$_SESSION["userID"]){
                ?>
                    <div class="playlistElement">
                        <div class="playlist-image-container">
                            <a href="?action=gotoPlaylist&playlistID=<?php echo $playlist->getPlaylistID();?>">
                                <img src="VIEW/IMAGES/playlist/<?php echo $playlist->getImageFileName(); ?>" alt="PlaylistImg" class="playlist-image">
                            </a>
                            <button onclick="playMedia()" class="playButton">PLAY</button>
                            </div>
                        <h4 class="playlist-title"><?php echo $playlist->getPlaylistName();?></h4>
                    </div>
                <?php
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="VIEW/CSS/libraryStyle.css">
    <title>Streamify - Library</title>
</head>

<body>
    <?php
        // Inclure l'entête
        include_once("commons/header.inc.php");
    ?>
    <main>
        <div class="controls">
            <div class="title">
                <h1>Bibliothèque</h1>
            </div>
            <div class="buttons">
                <a href="?action=gotoManagePlaylist" ><button>+ Playlist</button></a>
            </div>
        </div>
        <div class="h3">
            <h3>My Playlists</h3>
        </div>
        <div class="list">
            <div class="playlists">
                <?php
                    displayPlaylists();
                ?>
            </div>
        </div>
    </main>
    <?php include_once("VIEW/commons/mediaPlayer.inc.php"); ?>
</body>

</html>