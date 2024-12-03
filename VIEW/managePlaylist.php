<?php 
    if(!isset($controller)){header("Location: ?action=");}
    if ($_SESSION["connectedUser"] != "user") {header("Location: ?action=");}

    function goBack(){
        if(isset($_SESSION["lastView"])){
            $lastView = $_SESSION["lastView"];
            switch (true){
                case $lastView == "library.php":
                    return "gotoLibrary";
                    break;
                case $lastView == "adminProfile.php":
                default:
                    return "gotoProfile";
                    break;
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des playlists</title>
    <link rel="stylesheet" href="VIEW/CSS/managePlaylistStyle.css">
</head>
<body>

    <main>
        <h1 class="title">Créer une playlist</h1>
        <form action="?action=createPlaylist" method="POST" class="form-container" enctype="multipart/form-data">
            <label for="playlistName">Nom de la playlist :</label>
            <input type="text" id="playlistName" name="playlistName" maxlength="50" required placeholder="Entrez le nom de la playlist">

            <label for="visibility">Visibilité :</label>
            <select id="visibility" name="visibility" required>
                <option value="1">Publique</option>
                <option value="0">Privée</option>
            </select>

            <label for="userID">Utilisateur associé :</label>
            <select id="userID" name="userID" required>
                <?php
                // Récupérer tous les utilisateurs pour choisir l'utilisateur lié
                    $tabUsers = UserDAO::chercherTous(); 
                    foreach ($tabUsers as $user) {
                        echo "<option value='" . $user->getUserID() . "'>" . $user->getUserName() . "</option>";
                    }
                ?>
            </select>

            <label for="imageFileName">Image de la playlist :</label>
            <input type="file" id="imageFileName" name="imageFileName" accept="image/*">

            <div>
                <button type="submit" class="button button-add">Ajouter la playlist</button>
        </form>
        <a href="?action=<?php echo goBack();?>" class="button" id="btnRetour">Retour</a>
            </div>
    </main>

</body>
</html>