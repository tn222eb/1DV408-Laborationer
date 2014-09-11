<?php

namespace view;

require_once("src/model/LoginModel.php");


class LoginView {

	private $model;
	private $userNameLocation = "username";
	private $passwordLocation = "password";
	private $logoutLocation = "logout";

	public function __construct(\model\ LoginModel $model) {
		$this->model = $model;
	}

	public function hasUserName() {
		if(isset($_POST[$this->userNameLocation]) == true) {
			return true;
		}

		return false;

	}

	public function hasPassword() {
		if(isset($_POST[$this->passwordLocation]) == true) {
			return true;
		}

		return false;
	}

	
	public function getUserName() {
		if($this->hasUserName() == true) {
			return $_POST[$this->userNameLocation];	
		}
	}

	public function getPassword() {
		if($this->hasPassword() == true) {
		return $_POST[$this->passwordLocation];
		}
	}

	public function hasSubmit() {
		if(isset($_POST["submit"]) == true) {
			return true;
		}

		return false;
	}

	public function hasLogOut () {
		if(isset($_POST[$this->logoutLocation]) == true) {
			return true;
		}
		return false;
	}

	public function getDate() {
		setlocale(LC_ALL, "swedish");

		$date = "";

		$dayofWeek = ucfirst(strftime("%A"));
		$day = strftime("%d");
		$month = ucfirst(strftime("%B"));
		$year = strftime("%Y");
		$time = strftime("%X");

		$date .=   $dayofWeek . ",  Den " . $day . " " . $month . " år " . $year . ". Klockan är [" . $time . "].";

		return $date;
	}

	public function showLoginForm () {

		$date = $this->getDate();

		$htmlbody = 
		"<form method='post'>

		<h2>Ej inloggad</h2>
		<fieldset>
		<legend>Logga in - Skriv in användarnamn och lösenord</legend>

		Användarnamn:
		<input type='text' name='$this->userNameLocation' maxlength='35'>

		Lösenord:
		<input type='password' name='$this->passwordLocation' maxlength='35'>

		Håll mig inloggad:
		<input type='checkbox' name='checkbox' value='keeploggedin'>

		<input type='submit' name='submit' value='Logga in'>

		</fieldset>

		</br>

		$date

		</form>";

		return $htmlbody;
	}
}