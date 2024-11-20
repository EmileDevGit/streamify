
<h1>[TEST] UserDAO</h1>
<?php
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\UserDAO.php");
?>
<br>
<h3>Méthode chercher() [userID = u3]</h3>
<p>
    <?php  
    $userID = "u3";
    $user = UserDAO::chercher($userID);
    echo $user->toString();   ?>
</p>
<h3>Méthode chercherAvecFiltre() [username contains 'ie']</h3>
<p>
    <?php  
    $filter = "ie";
    $tabUser = UserDAO::chercherAvecFiltre($filter);
    foreach($tabUser as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode chercherTous() [returns all Users]</h3>
<p>
    <?php
    $tabUser=[];
    $tabUser = UserDAO::chercherTous();
    foreach($tabUser as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode inserer() [#u6-addedUser-none-none]</h3>
<p>
    <?php
    $user = new User("u6","addedUser", "none", "none");
    echo UserDAO::inserer($user)?$user->toString()." à été ajouté" : "User déjà existant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Users</em><br>";
    $tabUser = UserDAO::chercherTous();
    foreach($tabUser as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode modifier() [#u6-moddedUser-none-none]</h3>
<p>
    <?php
    $user->setUsername("moddedUser");
    echo UserDAO::modifier($user)?$user->toString()." à été modifié" : "User inexistant";
    ?>
</p>
<h3>Méthode retirer() [delete #u6-moddedUser-none-none]</h3>
<p>
    <?php
    echo UserDAO::supprimer($user)?$user->toString()." à été supprimé" : "User inexistant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Users</em><br>";
    $tabUser = UserDAO::chercherTous();
    foreach($tabUser as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>

