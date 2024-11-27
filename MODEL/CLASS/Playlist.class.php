<?php 


    class Playlist{

         // Attributes
        private $playlistID;
        private $playlistName;
        private $timesPlayed;
        private $public;
        private $imageFileName;
        private $userID;

        private $tabSongs;


        // Constructor
        public function __construct($playlistID, $playlistName, $timesPlayed, $public, $imageFileName, $tabSongs, $userID){

            $this->playlistID = $playlistID;
            $this->playlistName = $playlistName;
            $this->timesPlayed = $timesPlayed;
            $this->public = $public;
            $this->imageFileName = $imageFileName;
            $this->tabSongs = $tabSongs;
            $this->userID = $userID;

        }
 
         // Getters
        public function getPlaylistID():int{
            return $this->playlistID;
        }
        public function getPlaylistName():string{
        return $this->playlistName;
        }
         public function getTimesPlayed():int{
             return $this->timesPlayed;
        }
        public function getVisibility():bool{
        return $this->public;
        }
        public function getImageFileName():string{
            return $this->imageFileName;
        }
        public function getTabSongs():string{
            return $this->tabSongs;
        }
        public function getUserID():string{
            return $this->userID;
        }

         // Setters
        public function setPlaylistName($playlistName){
            $this->playlistName=$playlistName;
        }
        public function setVisibility($bool){
            $this->public=$bool;
        }
         public function setImageFileName($imageFileName) {
            $this->imageFileName = $imageFileName;
        }
        
        // Methods

        public function toString():string{
            return "[ Nom de playlist: " .$this->playlistName ." | User: #" .$this->userID ." ]";
        }





    }




?>