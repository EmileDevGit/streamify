<?php

    class User{

        // Attributes
        private $userID;
        private $password;
        private $email;
        //private array $tabPlaylists;

        // Constructor
        public function __construct($userID, $password, $email){

            $this->userID = $userID;
            $this->password = $password;
            $this->email = $email;

        }

        // Getters
        public function getUserID():string{
            return $this->userID;
        }
        public function getPassword():string{
            return $this->password;
        }
        public function getEmail():string{
            return $this->email;
        }

        // Setters
        public function setUserID($userID){
            $this->userID=$userID;
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
            return "[ User: " .$this->userID ." | Email: " .$this->email ." ]";
        }



    }



?>