<?php 

    class Song{
        
        // Attributes
        private $songID;
        private $artistID;
        private $playTime;
        private $timesPlayed;
        private $imageFileName;

        // Constructor
        public function __construct($songID, $artistID, $playTime, $timesPlayed, $imageFileName){

            $this->songID = $songID;
            $this->artistID = $artistID;
            $this->playTime = $playTime;
            $this->timesPlayed = $timesPlayed;
            $this->imageFileName = $imageFileName;


        }

        // Getters
        public function getSongID():string{
            return $this->songID;
        }
        public function getArtistID():string{
            return $this->artistID;
        }
        public function getPlayTime():string{
            return $this->playTime;
        }
        public function getTimesPlayed():int{
            return $this->timesPlayed;
        }
        public function getImageFileName():string{
            return $this->imageFileName;
        }

        // Setters
        public function setTimesPlayed($timesPlayed){
            $this->timesPlayed = $timesPlayed;
        }

        // Methods

        public function toString():string{
            return "[ " .$this->songID ." | Artiste: " .$this->artistID ." ]";
        }







    }













?>