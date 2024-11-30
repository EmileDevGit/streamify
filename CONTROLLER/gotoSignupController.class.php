<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");




	class gotoSignup extends Controller  {

		public function __construct() {

			parent::__construct();

		}
		
		public function executerAction():string {
			return "signup.php";
		}

		


		
	}	
	
?>