<?php

class Artiste {

    // Attributs
    private $artisteID;
    private $name;

    // Constructeur
    public function __construct($artisteID, $name) {
        $this->artisteID = $artisteID;
        $this->name = $name;
    }

    // Getters
    public function getArtisteID(): string {
        return $this->artisteID;
    }

    public function getName(): string {
        return $this->name;
    }

    // Setters
    public function setArtisteID($artisteID) {
        $this->artisteID = $artisteID;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Méthodes
    public function toString(): string {
        return "[ Artiste: " . $this->artisteID . " | Nom: " . $this->name . " ]";
    }
}

?>
