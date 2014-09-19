<?php

namespace model;

require_once("src/model/LoginDAL.php");

class LoginModel {

	private $loginDAL;
	private $cookieName;
	private $cookiePassword;
	private $cookieDate;

	public function __construct() {
		session_start();

		$this->loginDAL = new \model\LoginDAL();
	}

	public function isLoggedIn() {
		if (isset($_SESSION["valid"]) == true)
		 {
			return true;
		}	

		return false;
	}

	public function logIn($username, $password, $userCookieUserName, $userCookiePassword, $clientIdentifer) {
		$newUserCookiePassword = $this->createCookieInformation($userCookiePassword, $clientIdentifer);
		$this->getCookieInformation();
		$currentTime = time();

		if (($username == $this->loginDAL->getloginUserName() && $password == $this->loginDAL->getloginPassword()) == true
			|| $userCookieUserName == $this->cookieName && $newUserCookiePassword == $this->cookiePassword
			&& $currentTime < $this->cookieDate) {
			$_SESSION["valid"] = true;
			return true;
		}
		
		return false;
	}

	public function logOut() {
			unset($_SESSION["valid"]);
	}

	public function getNumLines() {
		$lines = @file("CookieInfo.txt");
		if ($lines === FALSE) {
			return 0;
		}
		return count($lines);
	}

	public function getCookieInformation() {
		$lines = $this->getNumLines();

		if ($lines == 0) {
			return;
		}

		else {
			$file = "CookieInfo.txt";
			$fileHandler = fopen($file, "r");
			$information = fread($fileHandler, filesize($file));
			fclose($fileHandler);
 
			$pieceofInformation = explode("," , $information);
			$this->cookieName = $pieceofInformation[0];
			$this->cookiePassword = $pieceofInformation[1];
			$this->cookieDate = $pieceofInformation[2];
		}
	}

	public function createCookieInformation($string, $salt) {
		return md5($string . $salt);
	}

	public function setCookieInformation($username, $password, $currentTime) {
		$file = "CookieInfo.txt";
		$fileHandler = fopen($file, "w");
		fwrite($fileHandler, $username . "," . $password . "," . $currentTime);
		fclose($fileHandler);
	}
}