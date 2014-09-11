<?php

namespace model;

class LoginModel {

	private $loginPassword;
	private $loginUserName;
	public $isLoggedIn = false;

	public function __construct() {
		$this->getLoginData();
	}

	public function isLoggedIn() {
		if ($this->isLoggedIn == true) {
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
			echo "You are logged in";
			$this->isLoggedIn = true;
		}
	}

	public function logOut() {
		$this->isLoggedIn = false;
	}	
}