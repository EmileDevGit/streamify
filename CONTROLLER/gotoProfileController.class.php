<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");




	class gotoProfile extends Controller  {

		public function __construct() {

			parent::__construct();

		}
		
		public function executerAction():string {
            if($_SESSION["adminStatus"] == 1){
                return "adminProfile.php";
            } else {
                return "userProfile.php";
            }
			
		}

		


		
	}	
	
?>