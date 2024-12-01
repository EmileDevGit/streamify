<?php if (!isset($controller)) { echo "Erreur : contrôleur introuvable."; exit; } ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="VIEW/CSS/manageSearchStyle.css">
</head>
<body>
    <main>
        <h1 class="title">Recherche</h1>
        <form action="?action=search" method="GET" class="form-container">
            <label for="searchCategory">Catégorie de recherche :</label>
            <select id="searchCategory" name="category" required>
                <option value="songs" <?= isset($_SESSION['searchCategory']) && $_SESSION['searchCategory'] == "songs" ? "selected" : "" ?>>Musique</option>
                <option value="artists" <?= isset($_SESSION['searchCategory']) && $_SESSION['searchCategory'] == "artists" ? "selected" : "" ?>>Artiste</option>
                <option value="albums" <?= isset($_SESSION['searchCategory']) && $_SESSION['searchCategory'] == "albums" ? "selected" : "" ?>>Album</option>
                <option value="users" <?= isset($_SESSION['searchCategory']) && $_SESSION['searchCategory'] == "users" ? "selected" : "" ?>>Utilisateur</option>
            </select>

            <label for="searchQuery">Rechercher :</label>
            <input type="text" id="searchQuery" name="query" placeholder="Entrez un mot-clé" value="<?= $_GET['query'] ?? '' ?>">

            <button type="submit" class="button button-search">Rechercher</button>
        </form>

        <div class="result">
            <?php if (isset($_SESSION['searchResults'])): ?>
                <h2>Résultats de la recherche :</h2>
                <ul>
                    <?php foreach ($_SESSION['searchResults'] as $result): ?>
                        <li><?= htmlspecialchars($result->toString()) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun résultat trouvé.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
