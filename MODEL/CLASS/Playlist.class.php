<?php 


    class Playlist{

         // Attributes
        private $playlistID;
        private $timesPlayed;
        private $userID;
        private $public = false;
        private $tabSongs;


         // Constructor
         public function __construct($playlistID, $timesPlayed, $userID, $public, $tabSongs){

            $this->playlistID = $playlistID;
            $this->timesPlayed = $timesPlayed;
            $this->userID = $userID;
            $this->public = $public;
            $this->tabSongs = $tabSongs;

         }
 
         // Getters
         public function getUserID():string{
             return $this->userID;
         }
         public function getPlaylistID():string{
             return $this->playlistID;
         }
         public function getTimesPlayed():int{
             return $this->timesPlayed;
         }
         public function getVisibility():bool{
            return $this->public;
        }
 
         // Setters
         public function setVisibility($bool){
             $this->public=$bool;
         }
         // public function setPlaylistID($playlistID){
         //   $this->playlistID=$playlistID;
         //}
 
         // Methods
         public function ajouterChanson(){
         }
 
         public function retirerChanson(){
 
         }
 
         public function toString():string{
             return "[ Nom: " .$this->playlistID ." | User: " .$this->userID ." ]";
         }





    }




?>