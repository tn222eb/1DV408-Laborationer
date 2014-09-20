<?php

namespace model;

require_once("src/model/LoginDAL.php");

class LoginModel {

	private $loginDAL;
	private $cookieName;
	private $cookiePassword;
	private $cookieDate;
	private $fileName = "CookieInfo.txt";
	private $sessionName = "valid";

	public function __construct() {
		session_start();

		$this->loginDAL = new \model\LoginDAL();
		$this->getCookieInformation();
	}

	public function isLoggedIn() {
		if (isset($_SESSION[$this->sessionName]) == true)
		 {
			return true;
		}	

		return false;
	}

	public function logIn($username, $password, $userCookieUserName, $userCookiePassword, $clientIdentifer, $currentTime) {
		$newUserCookiePassword = $this->createCookieInformation($userCookiePassword, $clientIdentifer);

		if (($username == $this->loginDAL->getloginUserName() && $password == $this->loginDAL->getloginPassword()) == true
			|| $userCookieUserName == $this->cookieName && $newUserCookiePassword == $this->cookiePassword
			&& $this->cookieDate > $currentTime == true) {
			$_SESSION[$this->sessionName] = true;
			return true;
		}
		
		return false;
	}

	public function logOut() {
			unset($_SESSION[$this->sessionName]);
	}

	public function getNumLines() {
		$lines = @file($this->fileName);
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
			$file = $this->fileName;
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
		$file = $this->fileName;
		$fileHandler = fopen($file, "w");
		fwrite($fileHandler, $username . "," . $password . "," . $currentTime);
		fclose($fileHandler);
	}
}