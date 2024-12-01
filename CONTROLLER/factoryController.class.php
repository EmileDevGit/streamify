<?php 
    // Default
    include_once("CONTROLLER/defaultController.class.php");

    // Navigation
	include_once("CONTROLLER/navigationController.class.php");

    // Action
	include_once("CONTROLLER/loginController.class.php");
	include_once("CONTROLLER/signupController.class.php");

    // AdminAction
	include_once("CONTROLLER/createUserController.class.php");
	include_once("CONTROLLER/createArtistController.class.php");
	include_once("CONTROLLER/createAlbumController.class.php");
	include_once("CONTROLLER/createSongController.class.php");
    include_once("CONTROLLER/factoryController.class.php");



class Factory{

    public static function creerController($action){

        $controller = null;

        switch (true){
            // controller de navigation
            case substr($action,0,4) == "goto":
                $controller =  new Navigation();
                break;
            // controller d'actions
            case $action == "login":
                $controller =  new Login();
                break;
            case $action == "signup":
                $controller =  new Signup();
                break;

            // controller administratifs
            case $action == "createUser":
                $controller =  new CreateUser();
                break;
            case $action == "createArtist":
                $controller =  new CreateArtist();
                break;
            case $action == "createAlbum":
                $controller =  new CreateAlbum();
                break;
            case $action == "createSong":
                $controller =  new CreateSong();
                break;
            case $action == "search":
                $controller = new SearchController();
                break;
            default:
                $controller = new DefaultController();
                break;
        }

        return $controller;
    } 
    
    // ?<script>alert("test")</script><?php







}



?>