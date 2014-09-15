<?php

namespace model;

require_once("src/model/LoginDAL.php");

class LoginModel {

	private $loginDAL;

	public function __construct() {
		$this->loginDAL = new \model\LoginDAL();

		session_start();
	}

	public function isLoggedIn() {
		if (isset($_SESSION["valid"]) == true)
		 {
			return true;
		}	

		return false;
	}

	public function logIn($username, $password) {
		if (($username == $this->loginDAL->getloginUserName() && $password == $this->loginDAL->getloginPassword()) == true) {
			$_SESSION["valid"] = true;
		}
	}

	public function logOut() {
		unset($_SESSION["valid"]);	
	}	
}