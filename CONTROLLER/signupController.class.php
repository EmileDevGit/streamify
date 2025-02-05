<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");
	include_once("MODEL/CLASS/User.class.php");
	include_once("MODEL/DAO/UserDAO.php");




	class Signup extends Controller  {

		public function __construct() {

			parent::__construct();

		}
		
		public function executerAction():string {
			$userCheck = null;

			if(!isset($_POST["userName"]) || !isset($_POST["userPasswd"]) || !isset($_POST["userEmail"])){
				?> <script>alert("Une erreur est survenue, veuillez réessayer")</script> <?php
				return "signup.php";
			} else {
				$userName = $_POST["userName"];
				$userPasswd = $_POST["userPasswd"];
				$userEmail = $_POST["userEmail"];
			}

			if($userCheck == null){
				try{
					$tabPlaylists =[];
					$newUser = new User(0,$userName, $userPasswd, $userEmail, false, "defaultProfile.png", $tabPlaylists);
					UserDAO::inserer($newUser);
				} catch (Exception $e) {
					?> <script>alert("Le nom d'utilisateur ou le email est déjà utilisé, veuillez réessayer")</script> <?php
					return "signup.php";
				}
			}
			?> <script>alert("Succès! Vous pouvez maintenant vous connecter")</script> <?php
			return "login.php";
		}

		


		
	}	
	
?>