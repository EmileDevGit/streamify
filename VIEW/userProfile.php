<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserProfils</title>
    <link rel="stylesheet" href="CSS/userProfileStyle.css">
</head>
<body>

    <?php include_once("commons/header.inc.php");?>
    
    <main>
        <section class="profile">
            <div class="profile-picture">
                <img src="IMAGES/profileIconpng.png" alt="Profil">
            </div>
            <section class="setting">
                <p>Account Setting</p>
            </section>
            <h2>Vos playlists publiques</h2>
        </section>

        <section class="playlists">
            <div class="playlistElement">
                <div class="playlist-image-container">
                    <a href="playlist.php"><img src="IMAGES/playlistcover.jpg" alt="PlaylistImg" class="playlist-image"></a>
                    <button class="makePrivateButton">Make private</button>
                </div>
                <h4 class="playlist-title">Titre de Playlist</h4>
                <p class="playlist-description">Description de la playlist ici</p>
            </div>
            <div class="playlistElement">
                <div class="playlist-image-container">
                    <a href="playlist.php"><img src="IMAGES/playlistcover.jpg" alt="PlaylistImg" class="playlist-image"></a>
                    <button class="makePrivateButton">Make private</button>
                </div>
                <h4 class="playlist-title">Titre de Playlist</h4>
                <p class="playlist-description">Description de la playlist ici</p>
            </div>
            <div class="playlistElement">
                <div class="playlist-image-container">
                    <a href="playlist.php"><img src="IMAGES/playlistcover.jpg" alt="PlaylistImg" class="playlist-image"></a>
                    <button class="makePrivateButton">Make private</button>
                </div>
                <h4 class="playlist-title">Titre de Playlist</h4>
                <p class="playlist-description">Description de la playlist ici</p>
            </div>
            
        </section>
        <footer>
        </footer>
    </main>
</body>
</html>