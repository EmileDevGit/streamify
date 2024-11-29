<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");

	class LoginDefault extends Controller  {

		public function __construct() {

			parent::__construct();

		}
		

		public function executerAction():string {
            $view = "login.php";
			return $view;
		}

		


		
	}	
	
?>