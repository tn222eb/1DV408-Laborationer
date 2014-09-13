<?php

namespace controller;

require_once("src/view/LoginView.php");
require_once("src/model/LoginModel.php");

class LoginController {
	private $view;
	private $model;

	public function __construct() {
		$this->model = new \model\LoginModel();
		$this->view = new \view\LoginView($this->model);
	}

	public function Display() {
		// Handle input	
		if($this->view->hasLogOut() == true) {
			$this->doLogout();
		}

		if ($this->view->hasSubmit() == true) {
			$this->doLogin();
		}

		// Generate output
		if ($this->model->isLoggedIn() == true) {
			return $this->view->showMemberSection();
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

