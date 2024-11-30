<?php 
	include_once("CONTROLLER/defaultController.class.php");
	include_once("CONTROLLER/loginController.class.php");
	include_once("CONTROLLER/gotoSignupController.class.php");
	include_once("CONTROLLER/gotoProfileController.class.php");
	include_once("CONTROLLER/signupController.class.php");



class Factory{

    public static function creerController($action){

        $controller = null;

        

        switch (true){
            case $action == "gotoProfile":
                $controller =  new gotoProfile();
                break;
            case $action == "gotoSignup":
                $controller =  new gotoSignup();
                break;
            case $action == "login":
                $controller =  new Login();
                break;
            case $action == "signup":
                ?><script>alert("test")</script><?php
                $controller =  new Signup();
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