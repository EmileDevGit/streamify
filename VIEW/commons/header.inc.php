<?php if (!isset($controller)) header("Location: login.php"); ?>

<header>
    <div class="logo">Streamify</div>
    <form action="?action=gotoSearch" method="GET" class="search-bar">
        <input class="search" type="text" name="query" placeholder="Recherche" required>
        <input class="mobileSearch" type="text" name="query" placeholder="🔎︎">
    </form>
    <nav>
        <a href="?action=gotoDiscovery">DISCOVERY</a>
        <a href="?action=gotoLibrary">LIBRARY</a>
    </nav>
    <div class="profile-container">
        <a href="?action=gotoProfile" class="profile-icon" id="profileIcon">
            <img src="VIEW/IMAGES/profile/<?php echo $_SESSION['profilePic']; ?>" alt="Profil">
        </a>
        <div class="profile-popup" id="profilePopup">
            <h3>Changer la photo de profil</h3>
            <form action="?action=updateProfile" method="POST" enctype="multipart/form-data">
                <input type="file" name="profilePic" id="profilePic" accept="image/*" required>
                <button type="submit" class="button">Mettre à jour</button>
            </form>
        </div>
    </div>
</header>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var profileIcon = document.getElementById("profileIcon");
    var profilePopup = document.getElementById("profilePopup");

    // ouvre le popup si la souris est sur l'image de profil
    profileIcon.addEventListener("mouseover", function() {
        profilePopup.style.display = "block";
    });

    // Fermer le popup si on clique ailleur
    document.addEventListener("click", function(event) {
        if (!profileIcon.contains(event.target) && !profilePopup.contains(event.target)) {
            profilePopup.style.display = "none";
        }
    });
});
</script>
