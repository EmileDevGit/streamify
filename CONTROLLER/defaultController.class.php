<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");

	class DefaultController extends Controller  {

		public function __construct() {
			parent::__construct();
		}
		public function executerAction():string {
			session_unset();
			return "login.php";
		}

		


		
	}	
	
?>