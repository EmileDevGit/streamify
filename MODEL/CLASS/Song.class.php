<?php 

    class Song{
        
        // Attributes
        private $songID;
        private $name;
        private $artistID; //pourrait être Artist object...?
        private $feature;
        private $playTime;
        private $timesPlayed;

        //private array $tabPlaylists;

        // Constructor
        public function __construct($songID,$name, $artistID, $feature, $playTime, $timesPlayed){

            $this->songID = $songID;
            $this->name = $name;
            $this->artistID = $artistID;
            $this->feature = $feature;
            $this->playTime = $playTime;
            $this->timesPlayed = $timesPlayed;

        }

        // Getters
        public function getSongID():string{
            return $this->songID;
        }
        public function getName():string{
            return $this->name;
        }
        public function getArtistID():string{
            return $this->artistID;
        }
        public function getFeature():bool{
            return $this->feature;
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
            return "[ #" .$this->songID ." | Nom: " .$this->name ." ]";
        }







    }













?>