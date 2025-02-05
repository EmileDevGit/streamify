<?php 

    class Album{

        // Attributes
        private ?int $albumID;
        private $albumName;
        private $imageFileName;
        private $artistID;
        
        private $tabSongs;


        // Constructor
        public function __construct(?int $albumID, $albumName, $imageFileName, $artistID, $tabSongs){

            $this->albumID = $albumID;
            $this->albumName = $albumName;
            $this->imageFileName = $imageFileName;
            $this->artistID = $artistID;
            $this->tabSongs = $tabSongs;

        }
  
        // Getters
        public function getAlbumID():?int{
            return $this->albumID;
        }public function getAlbumName():string{
            return $this->albumName;
        }
        public function getImageFileName():string{
            return $this->imageFileName;
        }
        public function getArtistID():int{
            return $this->artistID;
        }
        public function getTabSongs():array{
            return $this->tabSongs;
        }
 
  
        // Setters
        public function setAlbumName($albumName) {
            $this->albumName = $albumName;
        }
        public function setImageFileName($imageFileName) {
            $this->imageFileName = $imageFileName;
        }
        

        // Methods

        public function toString():string{
            return "[ Nom de l'album: " .$this->albumName ." | Artiste: #" .$this->artistID ." ]";
        }


    }









?> 