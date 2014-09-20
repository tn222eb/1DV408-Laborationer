<?php

namespace model;

class LoginDAL {

	private $loginPassword;
	private $loginUserName;
	private $fileName = "LoginData.txt";

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
		$fileHandler = fopen($this->fileName, "r");
		$loginData = fread($fileHandler, filesize($this->fileName));
		fclose($fileHandler);

		$this->loginUserName = substr($loginData, 0, 5);
		$this->loginPassword = substr($loginData, 5, 8);
	}
}