<?php 

include_once("MODEL\DATA\ConnexionDB.class.php");

interface DAO{

    static public function chercher(int $cles):?object;

    static public function chercherTous():array;

    static public function chercherAvecFiltre(string $filtre):array;

    static public function inserer($unObjet):bool;

    static public function modifier($unObjet):bool;

    static public function supprimer($unObjet):bool;

}



?>