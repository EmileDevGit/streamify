<h1>[TEST] AdminDAO</h1>
<?php
    include_once("C:\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\DAO\adminDAO.php");

?>
<br>
<h3>Méthode chercher()</h3>
<p>
    <?php  
    $adminID = "admin";
    try {
        $admin = AdminDAO::chercher($adminID);
        echo $admin->toString();   
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</p>
<h3>Méthode chercherAvecFiltre()</h3>
<p>
    <?php  
    $filter = "gmail";
    try {
        $tabAdmins = AdminDAO::chercherAvecFiltre($filter);
        foreach ($tabAdmins as $e) {
            echo $e->toString() . "<br>";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</p>
<h3>Méthode chercherTous()</h3>
<p>
    <?php
    try {
        $tabAdmins = AdminDAO::chercherTous();
        foreach ($tabAdmins as $e) {
            echo $e->toString() . "<br>";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</p>
<h3>Méthode inserer()</h3>
<p>
    <?php
    $admin = new Admin("admin2", "password123", "admin2@example.com");
    try {
        echo AdminDAO::inserer($admin) ? $admin->toString() . " a été ajouté" : "Admin déjà existant";
        echo "<br>";
        echo "<br><em>Voici la nouvelle liste de tous les Admins</em><br>";
        $tabAdmins = AdminDAO::chercherTous();
        foreach ($tabAdmins as $e) {
            echo $e->toString() . "<br>";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</p>
<h3>Méthode modifier()</h3>
<p>
    <?php
    $admin->setPassword("newpassword123");
    $admin->setEmail("u_admin2@example.com");
    try {
        echo AdminDAO::modifier($admin) ? $admin->toString() . " a été modifié" : "Admin inexistant";
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</p>
<h3>Méthode retirer()</h3>
<p>
    <?php
    try {
        echo AdminDAO::supprimer($admin) ? $admin->toString() . " a été supprimé" : "Admin inexistant";
        echo "<br>";
        echo "<br><em>Voici la nouvelle liste de tous les Admins</em><br>";
        $tabAdmins = AdminDAO::chercherTous();
        foreach ($tabAdmins as $e) {
            echo $e->toString() . "<br>";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</p>
