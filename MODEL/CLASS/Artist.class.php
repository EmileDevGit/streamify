<?php

class Artiste {

    // Attributs
    private $artisteID;
    private $imageFileName;

    // Constructeur
    public function __construct($artisteID, $imageFileName) {
        $this->artisteID = $artisteID;
        $this->imageFileName = $imageFileName;
    }

    // Getters
    public function getArtisteID(): string {
        return $this->artisteID;
    }

    public function getImageFileName(): string {
        return $this->imageFileName;
    }

    // Setters
    public function setArtisteID($artisteID) {
        $this->artisteID = $artisteID;
    }

    public function setImageFileName($imageFileName) {
        $this->imageFileName = $imageFileName;
    }

    // Méthodes
    public function toString(): string {
        return "[ Artiste: " . $this->artisteID . " | Photo: " . $this->imageFileName . " ]";
    }
}

?>
