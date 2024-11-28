
<h1>[TEST] UserDAO</h1>
<?php
    include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DAO\UserDAO.php");
?>
<br>
<h3>Méthode chercher() [username = Emile]</h3>
<p>
    <?php  
    $userID = 1;
    $user = UserDAO::chercher($userID);
    echo $user->toString();   ?>
</p>
<h3>Méthode chercherAvecFiltre() [username contains 'le']</h3>
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
<h3>Méthode inserer()</h3>
<p>
    <?php
    $tabPlaylist=[];
    $user = new User(0,"addedUser", "noPassword", "email@emali.com", 0, "noImage",$tabPlaylist);
    echo UserDAO::inserer($user)?$user->toString()." à été ajouté" : "User déjà existant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Users</em><br>";
    $tabUser = UserDAO::chercherTous();
    foreach($tabUser as $e){
        echo $e->toString() ."<br>";
    }
    $user = null;
    ?>
</p>
<h3>Méthode modifier()</h3>
<p>
    <?php
    $user = UserDAO::chercher(3);
    $user->setUserName("newUserName");
    $user->setPassword("newPassword");
    $user->setEmail("new@email.com");
    echo UserDAO::modifier($user)?$user->toString()." à été modifié" : "User inexistant";
    $user = null;
    ?>
</p>
<h3>Méthode retirer() [delete moddedUser]</h3>
<p>
    <?php
    $user = UserDAO::chercher(3);
    echo UserDAO::supprimer($user)?$user->toString()." à été supprimé" : "User inexistant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Users</em><br>";
    $tabUser = UserDAO::chercherTous();
    foreach($tabUser as $e){
        echo $e->toString() ."<br>";
    }
    $user = null;
    ?>
</p>

