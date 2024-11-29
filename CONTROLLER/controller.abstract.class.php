<?php

	abstract class Controller {

		protected $messagesErreur = array();
		protected $actor = "guest";

		public function __construct() {
			$this->determinerActor();
		}
		
		public function getMessagesErreur():array { return $this->messagesErreur; }
		public function getActor():string
		{
			return $this->actor;
		}
		
		abstract public function executerAction();

	private function determinerActor():void {
		
        session_start();
		if (isset($_SESSION['connectedUser'])) {
			$this->actor = "user";
		}
	}
		
	}
