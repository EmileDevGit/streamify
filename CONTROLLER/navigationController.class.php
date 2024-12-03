<?php
    
	include_once("CONTROLLER/controller.abstract.class.php");




	class Navigation extends Controller  {

		public function __construct() {

			parent::__construct();

		}
		
		public function executerAction():string {
            $action = $_GET['action'];
            
            switch (true){
                case $action == "gotoManagePlaylist": 
                    if($_SESSION["adminStatus"] == 1){
                        return "managePlaylist.php";
                    } else {
                        return "userProfile.php";        
                    }
                    break;
                case $action == "gotoManageSong":
                    if($_SESSION["adminStatus"] == 1){
                        return "manageSong.php";
                    } else {
                        return "userProfile.php";        
                    }
                    break;
                case $action == "gotoManageAlbum":
                    if($_SESSION["adminStatus"] == 1){
                        return "manageAlbum.php";
                    } else {
                        return "userProfile.php";        
                    }
                    break;
                case $action == "gotoManageArtiste":
                    if($_SESSION["adminStatus"] == 1){
                        return "manageArtiste.php";
                    } else {
                        return "userProfile.php";        
                    }
                    break;
                case $action == "gotoManageUsers":
                    if($_SESSION["adminStatus"] == 1){
                        return "manageUsers.php";
                    } else {
                        return "userProfile.php";        
                    }
                    break;
                case $action == "gotoManageSearch":
                    if($_SESSION["adminStatus"] == 1){
                        return "manageSearch.php";
                    } else {
                        return "userProfile.php";
                    }
                    break;
                case $action == "gotoProfile":
                    if($_SESSION["adminStatus"] == 1){
                        return "adminProfile.php";
                    } else {
                        return "userProfile.php";
                    }
                    break;
                case $action == "gotoSignup":
                    return "signup.php";
                    break;
                case $action == "gotoDiscovery":
                    return "discovery.php";
                    break;
                case $action == "gotoLibrary":
                    return "library.php";
                    break;
                case $action == "gotoPlaylist":
                    return "playlist.php";
                    break;
                case $action == "gotoArtistProfile":
                    return "artistePage.php";
                    break;
                default : 
                    ?> <script>alert("Une erreur est survenue, veuillez vous reconnecter.")</script> <?php
                    new Logout();
                    break;
		}
	}
}