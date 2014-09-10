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

	public function showLogin () {
		return $this->view->showLoginForm();
	}

	public function Login() {
		$username = $this->view->getUserName();
		$password = $this->view->getPassword();
	}

	public function Hej() {
		$this->model->getLoginData();
	}
}

