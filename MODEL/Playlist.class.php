<?php

class Playlist{

    // Attributes
    private $playlistID;
    private $nom;
    private array $chansons;
    private $visible = false;
    private $imgUrl;

    // Construct
    public function __construct(){

    }

    // Getters
    public function getPLaylistID(){

    }
    public function getNom(){

    }
    public function getChanson(){

    }
    public function getVisibility(){
         
    }
    public function getOwner(){

    }
    public function getImgUrl(){

    }
    // Setters
    public function setVisibility($visible){
        $this->visible = $visible;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }

    // Other Methods
    public function ajouterChanson(Chanson $chanson){

    }
    public function retirerChanson(Chanson $chanson){

    }
    public function modVisibility($boolean){

    }



    public function toString():string{
        return "";
    }


}


?>