<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/playlistStyle.css">
    <title>Streamify - Playlist</title>
</head>
<body>

    <?php include_once("commons/header.inc.php");?>
    
    <main>
        <div class="playlistHead">
            <div class="imageContainer">
                <img src="../image/playlistcover.jpg" alt="playlistCover">
            </div>
            <div class="playlistInfo">
                <h1>Titre de la playlist</h1>
                <h2>Artiste</h2>
                <div class="playButton">
                    <button>Play</button>
                </div>
            </div>
        </div>
        

        <div class="songs">
            <div class="songElement">
                <div class="songImageContainer">
                    <img src="../image/" alt="songImage">
                </div>
                <div class="songInfo">
                    <h3>Titre de la chanson</h3>
                    <p>Description ici</p>
                    <button>Play</button>
                </div>
            </div>
            <div class="songElement">
                <div class="songImageContainer">
                    <img src="../image/" alt="songImage">
                </div>
                <div class="songInfo">
                    <h3>Titre de la chanson</h3>
                    <p>Description ici</p>
                    <button>Play</button>
                </div>
            </div>
            <div class="songElement">
                <div class="songImageContainer">
                    <img src="../image/" alt="songImage">
                </div>
                <div class="songInfo">
                    <h3>Titre de la chanson</h3>
                    <p>Description ici</p>
                    <button>Play</button>
                </div>
            </div>

        </div>
        

    </main>
    
</body>
</html>