<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");
	include_once("MODEL/CLASS/User.class.php");
	include_once("MODEL/DAO/UserDAO.php");






	class Login extends Controller  {

		public function __construct() {

			parent::__construct();

		}
		
		public function executerAction():string {

			$user = null;
			// Vérification si les POST sont bien initialisés
			if(!isset($_POST["userName"]) || !isset($_POST["userPasswd"])){
				return "login.php";
			}

			// Vérification utilisateur existant
			try{
				$user = UserDAO::chercherUserName($_POST["userName"]);
			} catch (Exception $e){
				?> <script>alert("Utilisateur inexistant, veuillez réessayer")</script> <?php
				return "login.php";
			}
			
			// Validation du mot de passe si utilisateur existe
			if($user->getPassword() == $_POST["userPasswd"]){

				// initialisation du tableau de SESSION
				$_SESSION["connectedUser"]="user";
				$_SESSION["userID"] = $user->getUserID();
				$_SESSION["password"] = $user->getPassword();
				$_SESSION["adminStatus"] = $user->getAdminStatus();
				$_SESSION["profilePic"] = $user->getImageFileName();
				
				// initialisation des cookies
				$_COOKIE["username"] = $user->getUserName();
				$_COOKIE["profilePic"] = $user->getImageFileName();


				return "discovery.php";
			} else {
				?> <script>alert("Mot de passe invalide!")</script> <?php
			}
			return "login.php";
		}

		


		
	}	
	
?>