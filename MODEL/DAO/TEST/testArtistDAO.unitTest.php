<h1>[TEST] ArtisteDAO</h1>
<?php
    include_once("MODEL\DAO\ArtistDAO.php");
?>
<br>
<h3>Méthode chercher()</h3>
<p>
    <?php  
    $artisteID = 1;
    $artiste = ArtistDAO::chercher($artisteID);
    echo $artiste->toString();
    $artiste = null;   
    ?>
</p>
<h3>Méthode chercherAvecFiltre()</h3>
<p>
    <?php  
    $filter = "Ar";
    $tabArtistes = ArtistDAO::chercherAvecFiltre($filter);
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode chercherTous()</h3>
<p>
    <?php
    $tabArtistes = ArtistDAO::chercherTous();
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    ?>
</p>
<h3>Méthode inserer()</h3>
<p>
    <?php
    $tabAlbums = [];
    $artiste = new Artiste(0,"ENIGMA","noImage", $tabAlbums);
    echo ArtistDAO::inserer($artiste) ? $artiste->toString() . " a été ajouté" : "Artiste déjà existant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Artistes</em><br>";
    $tabArtistes = ArtistDAO::chercherTous();
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    $artiste = null;
    ?>
</p>
<h3>Méthode modifier()</h3>
<p>
    <?php
    $artiste = ArtistDAO::chercher(3);
    $artiste->setArtisteName("DEMS");
    echo ArtistDAO::modifier($artiste) ? $artiste->toString() . " a été modifié" : "Artiste inexistant";
    $artiste = null;
    ?>
</p>
<h3>Méthode retirer()</h3>
<p>
    <?php
    $artiste = ArtistDAO::chercher(3);
    echo ArtistDAO::supprimer($artiste) ? $artiste->toString() . " a été supprimé" : "Artiste inexistant";
    echo "<br>";
    echo "<br><em>Voici la nouvelle liste de tous les Artistes</em><br>";
    $tabArtistes = ArtistDAO::chercherTous();
    foreach($tabArtistes as $e){
        echo $e->toString() ."<br>";
    }
    $artiste = null;
    ?>
</p>
