<?php

namespace model;

class LoginModel {

	private $loginPassword;
	private $loginUserName;

	public function __construct() {

	}

	public function getLoginData() {
		$filename = "LoginData.txt";
		$fileHandler = fopen($filename, "r");
		$loginData = fread($fileHandler, filesize($filename));
		fclose($fileHandler);

		$this->loginPassword = substr($loginData, 0, 5);
		$this->loginUserName = substr($loginData, 5, 8);

		var_dump($this->loginPassword);
		var_dump($this->loginUserName);
	}
	
}