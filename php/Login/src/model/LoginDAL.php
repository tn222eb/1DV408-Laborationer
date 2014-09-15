<?php

namespace model;

class LoginDAL {

	private $loginPassword;
	private $loginUserName;

	public function __construct() {
		$this->getLoginData();
	}

	public function getLoginPassword() {
		return $this->loginPassword;
	}

	public function getLoginUserName() {
		return $this->loginUserName;
	}

	public function getLoginData() {
		$filename = "LoginData.txt";
		$fileHandler = fopen($filename, "r");
		$loginData = fread($fileHandler, filesize($filename));
		fclose($fileHandler);

		$this->loginUserName = substr($loginData, 0, 5);
		$this->loginPassword = substr($loginData, 5, 8);
	}
}