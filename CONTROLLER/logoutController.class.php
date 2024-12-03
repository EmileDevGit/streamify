<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");

	class Logout extends Controller  {

		public function __construct() {
			parent::__construct();
		}
		public function executerAction():string {
            if($this->user=="user"){
                ?> <script>alert("Vous êtes maintenant déconnecté")</script> <?php
                session_unset();
            }
			return "login.php";
		}
	}	
	
?>