<?php if (!isset($controller)) header("Location: login.php"); ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="VIEW/CSS/libraryStyle.css">
    <title>Streamify - Library</title>
</head>

<body>

    <?php include_once("commons/header.inc.php");?>

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
                <div class="playlistElement">
                    <div class="playlist-image-container">
                        <a href="playlist.php"><img src="../IMAGES/playlistcover.jpg" alt="PlaylistImg" class="playlist-image"></a>
                        <button class="playButton">PLAY</button>
                    </div>
                    <h4 class="playlist-title">Titre de Playlist</h4>
                    <p class="playlist-description">Description de la playlist ici</p>
                </div>

                <div class="playlistElement">
                    <div class="playlist-image-container">
                        <a href="playlist.php"><img src="../IMAGES/playlistcover.jpg" alt="PlaylistImg" class="playlist-image"></a>
                        <button class="playButton">PLAY</button>
                    </div>
                    <h4 class="playlist-title">Titre de Playlist</h4>
                    <p class="playlist-description">Description de la playlist ici</p>
                </div>

            </div>
        </div>
    </main>
</body>

</html>