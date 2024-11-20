<?php 

include_once("\UwAmp\www\Streamify\streamify_emile-girard_emile-larochelle\MODEL\DATA\ConnexionDB.class.php");

interface DAO{

    static public function chercher(string $cles):?object;

    static public function chercherTous():array;

    static public function chercherAvecFiltre(string $filtre):array;

    static public function inserer($unObjet):bool;

    static public function modifier($unObjet):bool;

    static public function supprimer($unObjet):bool;

}



?>