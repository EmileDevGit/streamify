<?php 
    if(!isset($controller)){header("Location: ?action=");}
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}
    if(isset($_SESSION["userID"])){
        $userObject = UserDAO::chercher($_SESSION["userID"]);
    }


    function displayPlaylist($userObject){
        $tabPlaylists = $userObject->getPlaylists();
        for ($i=0;$i<count($tabPlaylists);$i++){
            $playlist = $tabPlaylists[$i];
            if($playlist->getVisibility() == 1){
                ?>
                    <div class="playlistElement">
                        <div class="playlist-image-container">
                            <a href="?action=gotoPlaylist&playlistID=<?php echo $playlist->getPlaylistID();?>">
                                <img src="VIEW/IMAGES/playlist/<?php echo $playlist->getImageFileName(); ?>" alt="PlaylistImg" class="playlist-image">
                            </a>
                            <button class="makePrivateButton">Make private</button>
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
    <title>UserProfils</title>
    <link rel="stylesheet" href="VIEW/CSS/userProfileStyle.css">
</head>
<body>
    
    <?php include_once("commons/header.inc.php");?>
    
    <main>
        <section class="profile">
            <div class="profile-picture" id="profilePicture">
                <img src="VIEW/IMAGES/profile/<?php echo $userObject->getImageFileName(); ?>" alt="Profil">
            </div>
            <div class="profile-popup" id="profilePopup" style="display: none;">
            <h3>Changer la photo de profil</h3>
            <form action="?action=updateProfile" method="POST" enctype="multipart/form-data">
                <input type="file" name="profilePic" id="profilePic" accept="image/*" required>
                <button type="submit" class="button">Mettre à jour</button>
            </form>
        </div>
            <section class="setting">
                <p>Account Setting</p>
            </section>
            <a href="?action=logout" class="setting">Logout</a>
            <h2>Vos playlists publiques</h2>
        </section>

        <section class="playlists">
            <?php displayPlaylist($userObject); ?>
        </section>
    </main>
    <?php include_once("VIEW/commons/mediaPlayer.inc.php"); ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var profileIcon = document.getElementById("profilePicture");
        var profilePopup = document.getElementById("profilePopup");

        // ouvre le popup si la souris est sur l'image de profil
        profileIcon.addEventListener("mouseover", function() {
            profilePopup.style.display = "block";
    });

        // Fermer le popup si on clique ailleur
    document.addEventListener("click", function(event) {
        if (!profileIcon.contains(event.target) && !profilePopup.contains(event.target)) {
            profilePopup.style.display = "none";
        }});
    });
    </script>

</body>
</html>