<?php

namespace view;

require_once("src/model/LoginModel.php");


class LoginView {

	private $model;

	public function __construct(\model\ LoginModel $model) {
		$this->model = $model;
	}

	public function hasUserName() {
		if(isset($_POST["username"]) == true) {
			return true;
		}

		return false;

	}

	public function hasPassword() {
		if(isset($_POST["password"]) == true) {
			return true;
		}

		return false;
	}

	
	public function getUserName() {
		if($this->hasUserName() == true) {
			return $_POST["username"];	
		}
	}

	public function getPassword() {
		if($this->hasPassword() == true) {
		return $_POST["password"];
		}
	}

	public function hasSubmit() {
		if(isset($_POST["submit"]) == true) {
			return true;
		}

		return false;
	}

	public function showLoginForm () {
		$htmlbody = 
		"
		<form method='post'>

		Username:
		<input type='text' name='password' maxlength='35'>

		\n

		Password:
		<input type='password' name='password' maxlength='35'>

		\n

		<input type='submit' name='submit' value='Log in'>
		</form>
		";

		return $htmlbody;
	}
}