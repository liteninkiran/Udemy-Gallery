<?php

	$session = new Session;
	$message = $session->message();

	class Session
	{
/*
		Properties (Private):

		• $signedIn			Signed In

		Properties (Public):

		• $userId			User ID
		• $message			Message
		• $visitorCount		Visitor Count

		Methods:

		• getVisitorCount	()
		• checkMessage		()
		• message			($msg = "")
		• login				($user)
		• logout			()
		• isSignedIn		()
		• checkLogin		()
*/

		private $signedIn = false;
		public $userId;
		public $message;
		public $visitorCount;

		function __construct()
		{
			session_start();
			$this->checkLogin();
			$this->checkMessage();
			$this->getVisitorCount();
		}

		private function getVisitorCount()
		{
			if(isset($_SESSION['count']))
			{
				return $this->visitorCount = $_SESSION['count']++;
			}
			else
			{
				return $_SESSION['count'] = 1;
			}
		}

		private function checkMessage()
		{
			if(isset($_SESSION['message']))
			{
				$this->message = $_SESSION['message'];
				unset($_SESSION['message']);
			}
			else
			{
				$this->message = "";
			}
		}

		public function message($msg = "")
		{
			if(empty($msg))
			{
				return $this->message;
			}
			else
			{
				$_SESSION['message'] = $msg;
			}
		}

		public function login($user)
		{
			if($user)
			{
				$this->userId = $_SESSION['user_id'] = $user->id;
				$this->signedIn = true;
			}
		}

		public function logout()
		{
			unset($_SESSION['user_id']);
			unset($this->userId);
			$this->signedIn = false;
		}

		public function isSignedIn()
		{
			return $this->signedIn;
		}

		public function checkLogin()
		{
			if(isset($_SESSION['user_id']))
			{
				$this->userId = $_SESSION['user_id'];
				$this->signedIn = true;
			}
			else
			{
				unset($this->userId);
				$this->signedIn = false;
			}
		}

	}


?>

