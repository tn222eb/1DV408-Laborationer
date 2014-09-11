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
		if(isset($_GET[$this->logoutLocation])) {
			return true;
		}
		
		return false;
	}

	public function getDate() {

		$date = "";

		$dayofWeek = date("l");
		$day = date("d");
		$month = date("F");
		$year = date("Y");
		$time = date("H:i:s");

		$date .=   $dayofWeek . ",  the " . $day . " " . $month . " " . $year . ". The clock is [" . $time . "].";

		return $date;


	}

	public function showLoginForm () {

		$date = $this->getDate();

		$htmlbody = 
		"<form method='post'>

		<h2>Not logged in</h2>
		<fieldset>
		<legend>Login - Enter your username and password</legend>

		Username:
		<input type='text' name='$this->userNameLocation' maxlength='35'>

		Password:
		<input type='password' name='$this->passwordLocation' maxlength='35'>

		Keep me logged in:
		<input type='checkbox' name='checkbox' value='keeploggedin'>

		<input type='submit' name='submit' value='Log in'>

		</fieldset>

		</br>

		$date

		</form>";

		return $htmlbody;
	}
}