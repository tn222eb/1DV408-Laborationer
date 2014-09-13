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
		if(!empty($_POST[$this->userNameLocation]) == true) {
			return true;
		}

		return false;

	}

	public function hasPassword() {
		if(!empty($_POST[$this->passwordLocation]) == true) {
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

		$dayofWeek = utf8_encode(ucfirst(strftime("%A")));
		$day = strftime("%d");
		$month = ucfirst(strftime("%B"));
		$year = strftime("%Y");
		$time = strftime("%X");

		$date .=   $dayofWeek . ",  den " . $day . " " . $month . " år " . $year . ". Klockan är [" . $time . "].";

		return $date;
	}

	public function showLoginForm() {
		$date = $this->getDate();
		$message = "";
		$username = "";

		if ($this->hasLogOut() == true) {
			$message .= "</br> Utloggning lyckades </br> </br>";
		}

		if ($this->hasSubmit() == true) {
			if ($this->hasUserName() == false) {
				$message .= "</br> Användarnamnet saknas </br> </br>";
				
			}

			if ($this->hasPassword() == false) {
				$message .= "</br> Lösenord saknas </br> </br>";
			}

			if ($this->hasUserName() && $this->hasPassword() == true) {
				if ($this->model->isLoggedIn() == false) {
					$message .= "</br> Felaktigt användarnamn och/eller lösenord </br> </br>";
					$username .= $this->getUserName();
				}
			}

		}

		$htmlbody = 
		"<form method='post'>
		<h2>Ej inloggad</h2>
		<fieldset>
		<legend>Logga in - Skriv in användarnamn och lösenord</legend>

		$message

		Användarnamn:
		<input type='text' name='$this->userNameLocation' value='$username' maxlength='35'>

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

	public function showMemberSection() {
		$date = $this->getDate();
		$message = "";

		if($this->hasSubmit() == true) {
			$message .= "</br> Inloggning lyckades </br> </br>";
		}

		$htmlbody = 
		"<form method='post'>
		<h2>Admin är inloggad</h2>

		$message

		<input type='submit' value='Logga ut' name='$this->logoutLocation'>

		</br>
		</br>

		$date

		</form>

		";

		return $htmlbody;
	}	
}