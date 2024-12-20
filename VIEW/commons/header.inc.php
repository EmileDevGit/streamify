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
    </div>
</header>

