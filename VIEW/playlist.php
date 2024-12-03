<?php 
    if(!isset($controller)){header("Location: ?action=");}
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}
    $playlistID = $_GET["playlistID"];
    $playlistObject = PlaylistDAO::chercher($playlistID);

    function displaySongs($playlistObject){
        $tabSongs = $playlistObject->getTabSongs();
        for($i=0;$i<count($tabSongs);$i++){
            $artist = ArtistDAO::chercher($tabSongs[$i]->getSongID());
            ?>
                <div class="songElement">
                    <div class="songImageContainer">
                        <img src="VIEW/IMAGES/song/<?php echo $tabSongs[$i]->getImageFileName(); ?>" alt="songImage">
                    </div>
                    <div class="songInfo">
                        <h3><?php echo $tabSongs[$i]->getSongName();?></h3>
                        <p><?php echo $artist->getArtisteName();?></p>
                        <button>Play</button>
                    </div>
                </div>
            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="VIEW/CSS/playlistStyle.css">
    <title>Streamify - Playlist</title>
</head>
<body>

    <?php include_once("commons/header.inc.php");?>
    
    <main>
        <div class="playlistHead">
            <div class="imageContainer">
                <img src="VIEW/IMAGES/playlist/<?php echo $playlistObject->getImageFileName();?>" alt="playlistCover">
            </div>
            <div class="playlistInfo">
                <h1><?php echo $playlistObject->getPlaylistName(); ?></h1>
                <h1></h1>
                <div class="playButton">
                    <button>Play</button>
                </div>
            </div>
        </div>
        

        <div class="songs">
            <?php 
                // Affichage des chansons dans la playlist
                displaySongs($playlistObject);
            ?>
        </div>
        

    </main>
    
</body>
</html>