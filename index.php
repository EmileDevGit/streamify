<?php

    include_once("CONTROLLER/factoryController.class.php");
	

	if(!ISSET($_GET['action'])){
         $action="";
	}else{
		$action = $_GET['action'];
	}

	$controller = Factory::creerController($action);
	$view = $controller->executerAction();

	include_once("VIEW/" .$view);









	

	//? <script>alert("test")</script> <?php

?>