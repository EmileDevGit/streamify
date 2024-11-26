<?php 

    class Song{
        
        // Attributes
        private $songID;
        private $artistID;
        private $playTime;
        private $timesPlayed;

        // Constructor
        public function __construct($songID, $artistID, $playTime, $timesPlayed){

            $this->songID = $songID;
            $this->artistID = $artistID;
            $this->playTime = $playTime;
            $this->timesPlayed = $timesPlayed;

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