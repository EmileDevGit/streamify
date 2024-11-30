<?php if (!isset($controller)) header("Location: login.php"); ?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="VIEW/CSS/manageUserStyle.css">
<body>
    <main>
        <h1 class="title">Ajouter un utilisateur</h1>
        <form action="/STREAMIFY/streamify_emile-girard_emile-larochelle/CONTROLLER/controller.createuser.php" method="POST" class="form-container" enctype="multipart/form-data">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" maxlength="50" required placeholder="Entrez le nom d'utilisateur">

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" maxlength="50" required placeholder="Entrez le mot de passe">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" maxlength="50" required placeholder="Entrez l'email">

            <label for="adminStatus">Statut administrateur :</label>
            <select id="adminStatus" name="adminStatus" required>
                <option value="1">Admin</option>
                <option value="0">Utilisateur</option>
            </select>

            <label for="image">Photo de profil :</label>
            <input type="file" id="image" name="imageFileName" accept="image/*" required>

            <button type="submit" class="button button-add">Ajouter l'utilisateur</button>
        </form>
    </main>
</body>
</html>
