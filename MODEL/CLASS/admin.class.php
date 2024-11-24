<?php 

class Admin {

    // Attributs
    private $adminID;
    private $password;
    private $email;

    // Constructeur
    public function __construct($adminID, $password, $email = null) {
        $this->adminID = $adminID;
        $this->password = $password;
        $this->email = $email;
    }

    // Getters
    public function getAdminID(): string {
        return $this->adminID;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    // Setters
    public function setAdminID(string $adminID) {
        $this->adminID = $adminID;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setEmail(?string $email) {
        $this->email = $email;
    }

    // Méthodes
    public function toString(): string {
        return "[ Admin: " . $this->adminID . " | Email: " . ($this->email ?? "") . " ]";
    }
    
}

?>
