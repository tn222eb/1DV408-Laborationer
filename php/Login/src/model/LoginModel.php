<?php

namespace model;

class LoginModel {

	private $loginPassword;
	private $loginUserName;

	public function __construct() {
		$this->getLoginData();

		session_start();
	}

	public function isLoggedIn() {
		if (isset($_SESSION["valid"]) == true)
		 {
			return true;
		}	

		return false;
	}

	public function getLoginData() {
		$filename = "LoginData.txt";
		$fileHandler = fopen($filename, "r");
		$loginData = fread($fileHandler, filesize($filename));
		fclose($fileHandler);

		$this->loginUserName = substr($loginData, 0, 5);
		$this->loginPassword = substr($loginData, 5, 8);
	}

	public function logIn($username, $password) {
		if ($username == $this->loginUserName && $password == $this->loginPassword) {
			$_SESSION["valid"] = true;
		}
	}

	public function logOut() {
		unset($_SESSION["valid"]);
	}	
}