<?php

class Artiste {

    // Attributs
    private $artistID;
    private $artistName;
    private $imageFileName;
    private array $tabAlbums;

    // Constructeur
    public function __construct($artistID, $artistName, $imageFileName, $tabAlbums) {
        $this->artistID = $artistID;
        $this->artistName = $artistName;
        $this->imageFileName = $imageFileName;
        $this->tabAlbums = $tabAlbums;
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
    public function getTabAlbums(): array {
        return $this->tabAlbums;
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
