<h1>[TEST] ArtisteDAO</h1>
<?php
    include_once("\UwAmp\www\STREAMIFY\streamify_emile-girard_emile-larochelle\MODEL\DAO\artisteDAO.php");
?>
<br>
<h3>Méthode chercher()</h3>
<p>
    <?php  
    $artisteID = "a1";
    $artiste = ArtisteDAO::chercher($artisteID);
    echo $artiste->toString();   
    ?>
</p>
<h3>Méthode chercherAvecFiltre()</h3>
<p>
    <?php  
    $filter = "Ar";
    $tabArtistes = ArtisteDAO::chercherAvecFiltre($filter);
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode chercherTous()</h3>
<p>
    <?php
    $tabArtistes = ArtisteDAO::chercherTous();
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode inserer()</h3>
<p>
    <?php
    $artiste = new Artiste("a5", "DAMSO");
    echo ArtisteDAO::inserer($artiste) ? $artiste->toString() . " a été ajouté" : "Artiste déjà existant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Artistes</em><br>";
    $tabArtistes = ArtisteDAO::chercherTous();
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode modifier()</h3>
<p>
    <?php
    $artiste->setName("DEMS");
    echo ArtisteDAO::modifier($artiste) ? $artiste->toString() . " a été modifié" : "Artiste inexistant";
    ?>
</p>
<h3>Méthode retirer()</h3>
<p>
    <?php
    echo ArtisteDAO::supprimer($artiste) ? $artiste->toString() . " a été supprimé" : "Artiste inexistant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Artistes</em><br>";
    $tabArtistes = ArtisteDAO::chercherTous();
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
