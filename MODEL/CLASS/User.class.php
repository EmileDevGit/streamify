<?php

    class User{

        // Attributes
        private $userID;
        private $password;
        private $email;
        private $imageFileName;
        //private array $tabPlaylists;

        // Constructor
        public function __construct($userID, $password, $email, $imageFileName){

            $this->userID = $userID;
            $this->password = $password;
            $this->email = $email;
            $this->imageFileName=$imageFileName;

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
        public function getImageFileName():string{
            return $this->imageFileName;
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
        public function setImageFileName($imageFileName){
            $this->imageFileName = $imageFileName;
        }

        public function toString():string{
            return "[ User: " .$this->userID ." | Email: " .$this->email ." ]";
        }



    }



?>