<?php

class Artiste {

    // Attributs
    private $artistID;
    private $artistName;
    private $imageFileName;

    // Constructeur
    public function __construct($artistID, $artistName, $imageFileName) {
        $this->artistID = $artistID;
        $this->artistName = $artistName;
        $this->imageFileName = $imageFileName;
    }

    // Getters
    public function getArtisteID(): int {
        return $this->artistID;
    }
    public function getArtisteName(): string {
        return $this->artistName;
    }
    public function getImageFileName(): string {
        return $this->imageFileName;
    }

    // Setters
    public function setArtisteName($artistName) {
        $this->artistName = $artistName;
    }
    public function setImageFileName($imageFileName) {
        $this->imageFileName = $imageFileName;
    }

    // Méthodes
    public function toString(): string {
        return "[ #" .$this->artistID . " | Nom: " . $this->artistName . " ]";
    }
}

?>
