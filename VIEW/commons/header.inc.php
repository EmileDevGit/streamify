<?php if (!isset($controller)) header("Location: login.php"); ?>





<header>
    <div class="logo">Streamify</div>
    <form action="search.html" method="GET" class="search-bar">
        <input class="search" type="text" name="query" placeholder="Recherche" required>
        <input class="mobileSearch" type="text" name="query" placeholder="🔎︎">
    </form>
    <nav>
        <a href="discovery.php">DISCOVERY</a>
        <a href="library.php">LIBRARY</a>
    </nav>
    <div class="profile-icon">
        <a href="?action=gotoProfile">
            <img src="VIEW/IMAGES/profile/<?php echo $_COOKIE["profilePic"];?>" alt="Profil">
        </a>
    </div>
</header>