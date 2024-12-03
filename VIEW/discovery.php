<?php 
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}

    // Fonctions d'Affichage des Éléments du Jour
    function displayMusiqueJour(){
        $tabsongs = SongDAO::chercherTous();
        for ($i=0;$i<4;$i++){
            $song = $tabsongs[$i];
            $album = AlbumDAO::chercher($song->getSongID());
            ?>
                <div class="musique">
                    <div class="musique-content">
                        <div class="musique-info">
                            <div class="picture">
                                <img src="VIEW/IMAGES/song/<?php echo $song->getImageFileName(); ?>" alt="SongImage">
                            </div>
                            <p><?php echo $song->getSongName();?></p>
                            <p><?php echo $album->getAlbumName();?></p>
                        </div>
                    </div>
                    <button class="play-button">PLAY</button>
                    <button class="add-button">ADD</button>
                </div>
            <?php
        }
    }
    function displayArtisteJour(){
        $tabArtists = ArtistDAO::chercherTous();
        for ($i=0;$i<4;$i++){
            $artist = $tabArtists[$i];
            ?>
                <div class="artist">
                    <div class="picture">
                        <img src="VIEW/IMAGES/artist/<?php echo $artist->getImageFileName(); ?>" alt="ArtisteImage">
                    </div>
                    <h4 class="artist-name"><?php echo $artist->getArtisteName();?></h4>
                    <a href="?action=gotoArtistProfile&artistID=<?php echo $artist->getArtisteID();?>"><button class="profile-button">PROFILE</button></a>
                </div>
            <?php
        }
    }
    function displayPlaylistPubliques(){
        $tabPlaylists = PlaylistDAO::chercherTous();
        for ($i=0;$i<count($tabPlaylists);$i++){
            $playlist = $tabPlaylists[$i];
            if($playlist->getVisibility()==1){
                ?>
                    <div class="playlistElement">
                        <div class="playlist-image-container">
                            <a href="?action=gotoPlaylist&playlistID=<?php echo $playlist->getPlaylistID();?>">
                                <img src="VIEW/IMAGES/playlist/<?php echo $playlist->getImageFileName(); ?>" alt="PlaylistImg" class="playlist-image">
                            </a>
                            <button class="addButton">ADD</button>
                            </div>
                        <h4 class="playlist-title"><?php echo $playlist->getPlaylistName();?></h4>
                        
                    </div> 
                <?php
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISCOVERY</title>
    <link rel="stylesheet" href="VIEW/CSS/discoveryStyle.css">
</head>
<body>
    
    <?php 
        // Inclure l'entête
        include_once("commons/header.inc.php");
    ?>

    <main>
        <!-- Section Musiques du jour ( 4 ) -->
        <section class="section">
            <h2 class="sectionTitle">Musiques du jour</h2>
            <div class="content-musique">
                <?php 
                    displayMusiqueJour();
                ?>
            </div>
        </section>
    
        <!-- Section Artistes du jour ( 4 ) -->
        <section class="section">
            <h2 class="sectionTitle">Artistes du jour</h2>
            <div class="content-artiste">
                <?php
                    displayArtisteJour();
                ?>
            </div>
        </section>
        

        <!-- Section Playlists du jour ( ALL ) -->
        <section class="section">
            <h2 class="sectionTitle">Playlists publiques</h2>
            <div class="playlist">
                <?php
                    displayPlaylistPubliques();
                ?>
            </div>
        </section>
    </main>
</body>
</html>