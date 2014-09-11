<?php

namespace controller;

require_once("src/view/LoginView.php");
require_once("src/view/MemberSection.php");
require_once("src/model/LoginModel.php");

class LoginController {

	private $memberSection;
	private $view;
	private $model;

	public function __construct() {
		$this->memberSection = new \view\MemberSection();
		$this->model = new \model\LoginModel();
		$this->view = new \view\LoginView($this->model);
	}

	public function doDisplay() {
		// Handle input	
		if($this->view->hasLogOut() == true) {
			$this->doLogout();
		}

		if ($this->view->hasSubmit() == true) {
			$this->doLogin();
		}

		// Generate output
		if ($this->model->isLoggedIn() == true) {
			return $this->memberSection->showMemberSection();
		}

		else {
			return $this->view->showLoginForm();
		}
	}

	public function doLogin() {
		$username = $this->view->getUserName();
		$password = $this->view->getPassword();

		$this->model->logIn($username, $password);
	}

	public function doLogout() {
		$this->model->logOut();
	}	
}

