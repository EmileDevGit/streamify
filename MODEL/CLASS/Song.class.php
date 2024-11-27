<?php 

    class Song{
        
        // Attributes
        private int $songID;
        private string $songName;
        private string $playTime;
        private int $timesPlayed;
        private string $imageFileName;
        private string $mediaFileName;
        private int $artistID;

        // Constructor
        public function __construct(int $songID, string $songName, string $playTime, int $timesPlayed, string $imageFileName, string $mediaFileName, int $artistID){

            $this->songID = $songID;
            $this->songName = $songName;
            $this->playTime = $playTime;
            $this->timesPlayed = $timesPlayed;
            $this->imageFileName = $imageFileName;
            $this->mediaFileName = $mediaFileName;
            $this->artistID = $artistID;

        }

        // Getters
        public function getSongID():int{
            return $this->songID;
        }
        public function getSongName():string{
            return $this->songName;
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
        public function getMediaFileName():string{
            return $this->mediaFileName;
        }
        public function getArtistID():int{
            return $this->artistID;
        }

        // Setters
        public function setSongName(string $songName){
            $this->songName = $songName;
        }
        public function setPlayTime(string $playTime){
            $this->playTime = $playTime;
        }
        public function setTimesPlayed(int $timesPlayed){
            $this->timesPlayed = $timesPlayed;
        }
        public function setImageFileName(string $imageFileName){
            $this->imageFileName = $imageFileName;
        }
        public function setMediaFileName(string $mediaFileName){
            $this->mediaFileName = $mediaFileName;
        }
        public function setArtistID(int $artistID){
            $this->artistID = $artistID;
        }

        


        // Methods

        public function toString():string{
            return "[ #" .$this->songID ." | Titre: " .$this->songName ." | Artiste: #" .$this->artistID ." ]";
        }







    }













?>