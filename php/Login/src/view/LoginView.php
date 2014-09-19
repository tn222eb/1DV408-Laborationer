<?php

namespace view;

require_once("src/model/LoginModel.php");
require_once("src/view/CookieJar.php");

class LoginView {
	private $model;
	private $cookieJar;
	private $userNameLocation = "username";
	private $passwordLocation = "password";
	private $logoutLocation = "logout";
	private $message = "";

	public function __construct(\model\ LoginModel $model) {
		$this->model = $model;
		$this->cookieJar = new \view\CookieJar($this->model);
	}

	public function save($cookieName, $cookieValue) {
		$this->cookieJar->save($cookieName, $cookieValue);
	}

	public function remove($cookieName) {
		$this->cookieJar->remove($cookieName);
	}

	public function hasLoginCookies() {
		return $this->cookieJar->hasLoginCookies();

	}

	public function cookieExpireTime() {
		return $this->cookieJar->cookieExpireTime();
	}

	public function getCookieUserName() {
		return $this->cookieJar->getCookieUserName();
	}

	public function getCookiePassword() {
		return $this->cookieJar->getCookiePassword();
	}	

	public function getUserAgent() {
		return $_SERVER["HTTP_USER_AGENT"];
	}

	public function getClientIdentifer() {
		return $_SERVER["REMOTE_ADDR"];
	}

	public function hasChecked() {
		if (isset($_POST["checkbox"]) == true) {
			return true;
		}

		return false;
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
			return htmlentities($_POST[$this->userNameLocation]);
		}
	}

	public function getPassword() {
		if($this->hasPassword() == true) {
		return htmlentities($_POST[$this->passwordLocation]);
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

	public function showLoginForm($didLogin) {
		$date = $this->getDate();
		$username = "";
		$checked = "";

	
		if ($this->hasLogOut() == true) {
			$this->message .= "</br> Utloggning lyckades </br> </br>";
		}
		else {
				if ($this->cookieJar->hasLoginCookies() == true && $didLogin == false) {
					$this->message .= "</br>Felaktig information i kakan </br> </br>";
					$this->remove("LoginView::UserName");
					$this->remove("LoginView::Password");
				}				

		}

		if ($this->hasSubmit() == true) {
			if ($this->hasUserName() == false) {
				$this->message .= "</br> Användarnamnet saknas </br> </br>";
			}
			else {
				if ($this->hasPassword() == false) {
					$this->message .= "</br> Lösenord saknas </br> </br>";

					if ($this->hasUserName() == true) {
						$username = $this->getUserName();
					}

					if($this->hasChecked() == true) {
						$checked .= "checked";
					}					
				}
			}

			if ($this->hasUserName() && $this->hasPassword() == true) {
				if ($this->model->isLoggedIn() == false) {
					$this->message .= "</br> Felaktigt användarnamn och/eller lösenord </br> </br>";
					$username .= $this->getUserName();

					if($this->hasChecked() == true) {
						$checked .= "checked";
					}
				}
			}
		}

		$htmlbody = 
		"<form method='post'>
		<h2>Ej inloggad</h2>
		<fieldset>
		<legend>Logga in - Skriv in användarnamn och lösenord</legend>

		$this->message

		Användarnamn:
		<input type='text' name='$this->userNameLocation' value='$username' maxlength='35'>

		Lösenord:
		<input type='password' name='$this->passwordLocation' maxlength='35'>

		Håll mig inloggad:
		<input type='checkbox' name='checkbox' $checked>

		<input type='submit' name='submit' value='Logga in'>

		</fieldset>

		</br>

		$date

		</form>";

		return $htmlbody;
	}

	public function showMemberSection($didLogin) {
		$date = $this->getDate();	

		if($this->hasSubmit() == true) {

			if ($this->hasChecked() == true) {
				$this->message .= "</br> Inloggning lyckades och vi kommer att komma ihåg dig nästa gång </br> </br>";
			}
			else {
				$this->message .= "</br> Inloggning lyckades </br> </br>";
			}
		}
		else {
			if($this->cookieJar->hasLoginCookies() == true && $didLogin == true) {
				$this->message .= "</br> Inloggning lyckades via cookies </br> </br>";
			}
		}

		$htmlbody = 
		"<form method='post'>
		<h2>Admin är inloggad</h2>

		$this->message

		<input type='submit' value='Logga ut' name='$this->logoutLocation'>

		</br>
		</br>

		$date

		</form>

		";

		return $htmlbody;
	}	
}