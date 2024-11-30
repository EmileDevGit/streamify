<?php

	abstract class Controller {

		protected $messagesErreur = array();
		protected $user = "";

		public function __construct() {
			$this->determinerActor();
		}
		
		public function getMessagesErreur():array {
			 return $this->messagesErreur; 
		}

		public function getUser():string{
			return $this->user;
		}
		
		abstract public function executerAction();

		private function determinerActor():void {
		
			session_start();
			if (isset($_SESSION['connectedUser'])) {
				$this->user = $_SESSION['connectedUser'];
			}
		}
		
	}
