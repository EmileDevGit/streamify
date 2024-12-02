<?php if (!isset($controller)) header("Location: ../?action=login"); ?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISCOVERY</title>
    <link rel="stylesheet" href="VIEW/CSS/discoveryStyle.css">
</head>
<body>
    <?php include_once("commons/header.inc.php");?>

    <main>
        <!-- Section Musiques du jour -->
        <section class="section">
            <h2 class="sectionTitle">Musiques du jour</h2>
            <div class="content-musique">

                <?php 
                    $tabsongs = SongDAO::chercherTous();
                    for ($i=0;$i<4;$i++){
                        $song = $tabsongs[$i];
                        $album = AlbumDAO::chercher($song->getSongID());
                        ?>
                            <div class="musique">
                                <div class="musique-content">
                                    <div class="musique-info">
                                        <p><?php echo $song->getSongName();?></p>
                                        <p><?php echo $album->getAlbumName();?></p>
                                    </div>
                                </div>
                                <button class="play-button">PLAY</button>
                                <button class="add-button">ADD</button>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </section>
    
    
        <!-- Section Artistes du jour -->
        <section class="section">
            <h2 class="sectionTitle">Artistes du jour</h2>
            <div class="content-artiste">
                <div class="artist">
                    <div class="artist-picture">
                        <img src="IMAGES/loginBackground.jpg" alt="Artiste">
                    </div>
                    <h4 class="artist-name">Nom de l'artiste</h4>
                    <a href="artistePage.php"><button class="profile-button">PROFILE</button></a>
                </div>
            </div>
        </section>
        

        <!-- Section Playlists du jour -->
        <section class="section">
            <h2 class="sectionTitle">Playlists publiques</h2>
            <div class="playlist">
                <div class="playlistElement">
                    <div class="playlist-image-container">
                        <a href="playlist.php"><img src="IMAGES/playlistcover.jpg" alt="PlaylistImg" class="playlist-image"></a>
                        <button class="playButton">PLAY</button>
                        <button class="addButton">ADD</button>
                    </div>
                    <h4 class="playlist-title">Titre de Playlist</h4>
                    <p class="playlist-description">Description de la playlist ici</p>
                </div> 
            </div>
        </section>
    </main>
</body>
</html>