<?php 

class Factory{

    public static function creerController($action){
         
        if($action == ""){
            return new LoginDefault();
        }


    }








}



?>