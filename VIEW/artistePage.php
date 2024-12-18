<?php
    if(!isset($controller)){header("Location: ?action=");}
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}

    if(isset($_GET["artistID"])){
        $artistObject = ArtistDAO::chercher($_GET["artistID"]);
    } else {
        header("Location: ?action=gotoDiscovery");
    }
    $tabAlbums = $artistObject->getTabAlbums();

    // Méthode d'affichage dynamique
    function displayAlbums($tabAlbums){
        for($i=0;$i<count($tabAlbums);$i++){
            ?>
                <div class="album">
                        <div class="album-content">
                            <div class="album-info">
                                <p><?php echo $tabAlbums[$i]->getAlbumName();?></p>
                            </div>
                                <img src="VIEW/IMAGES/album/<?php echo $tabAlbums[$i]->getImageFileName();?>" alt="Album Cover" class="album-image">
                            <div class="album-buttons">
                                <button class="play-button">PLAY</button>
                                <button class="add-button">ADD</button>
                            </div>
                        </div>
                    </div>
            <?php
        }
    }
    function displaySongs($tabAlbums){
        foreach ($tabAlbums as $album){
            $tabSongs = $album->getTabSongs();
            for ($i=0;$i<count($tabSongs);$i++){
                ?>
                    <div class="musique">
                        <div class="musique-content">
                            <div class="musique-info">
                            <div class="picture">
                                <img src="VIEW/IMAGES/song/<?php echo $tabSongs[$i]->getImageFileName(); ?>" alt="SongImage">
                            </div>
                                <p id="songTitle<?php echo $i?>"><?php echo $tabSongs[$i]->getSongName(); ?></p>
                                <p><?php echo $album->getAlbumName(); ?></p>
                            </div>
                        </div>
                        <button class="add-button">ADD</button>
                        <button onclick="playMedia(<?php echo $i?>)" class="play-button">PLAY</button>
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
    <title>artistePage</title>
    <link rel="stylesheet" href="VIEW/CSS/artistePageStyle.css">
</head>
<body>
    <?php include_once("commons/header.inc.php");?>
    
    <!-- Section principale -->
    <main>
        <section class="artist-profile">
            <div class="artist-picture">
                <img src="VIEW/IMAGES/artist/<?php echo $artistObject->getImageFileName(); ?>" alt="Artiste">
            </div>
            <h2><?php echo $artistObject->getArtisteName(); ?></h2>
        </section>

        <!-- Section des albums et musique -->
        <section class="content">
            <!-- Section des albums -->
            <div class="content-album">
                <?php displayAlbums($tabAlbums)?>                   
            </div>
        </section>
            <!-- Section des musiques -->
        <div class="content-musique">
            <?php displaySongs($tabAlbums);?>
        </div>
    </main>
    <?php include_once("VIEW/commons/mediaPlayer.inc.php"); ?>
</body>
</html>