<?php

class User{

    // Attributes
    private $userID;
    private $username;
    private $password;
    private $email;
    private array $tabPlaylists;

    // Constructor
    public function __construct($userID, $username, $password, $email){

        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;

    }

    // Getters
    public function getUserID():string{
        return $this->userID;
    }
    public function getUsername():string{
        return $this->username;
    }
    public function getPassword():string{
        return $this->password;
    }
    public function getEmail():string{
        return $this->email;
    }

    // Setters
    public function setUsername($username){
        $this->username=$username;
    }
    public function setPassword($password){
        $this->password=$password;
    }
    public function setEmail($email){
        $this->email=$email;
    }

    // Methods
    public function ajouterPlaylist(){
    }

    public function retirerPlaylist(){

    }

    public function toString():string{
        return "[ #" .$this->userID ." | Username: " .$this->username ." ]";
    }



}



?>