<?php

    class User{

        // Attributes
        private int $userID;
        private string $userName;
        private string $password;
        private string $email;
        private bool $adminStatus;
        private string $imageFileName;

        private array $tabPlaylists;

        // Constructor
        public function __construct(int $userID, string $userName, string $password, string $email, bool $adminStatus, string $imageFileName, array $tabPlaylists){

            $this->userID = $userID;
            $this->userName = $userName;
            $this->password = $password;
            $this->email = $email;
            $this->adminStatus = $adminStatus;
            $this->imageFileName=$imageFileName;
            
            $this->tabPlaylists=$tabPlaylists;

        }

        // Getters
        public function getUserID():int{
            return $this->userID;
        }
        public function getUserName():string{
            return $this->userName;
        }
        public function getPassword():string{
            return $this->password;
        }
        public function getEmail():string{
            return $this->email;
        }
        public function getAdminStatus():bool{
            return $this->adminStatus;
        }
        public function getImageFileName():string{
            return $this->imageFileName;
        }
        public function getPlaylists():array{
            return $this->tabPlaylists;
        }

        // Setters
        public function setUserName(string $userName){
            $this->userName=$userName;
        }
        public function setPassword(string $password){
            $this->password=$password;
        }
        public function setEmail(string $email){
            $this->email=$email;
        }
        public function setAdminStatus(bool $adminStatus){
            $this->adminStatus = $adminStatus;
        }
        public function setImageFileName(string $imageFileName){
            $this->imageFileName = $imageFileName;
        }

        public function toString():string{
            return "[ #". $this->userID ." | User: " .$this->userName ." | Email: " .$this->email . " | Statut Admin: " .$this->adminStatus ."]";
        }



    }



?>