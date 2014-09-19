<?php

namespace controller;

require_once("src/view/LoginView.php");
require_once("src/model/LoginModel.php");

class LoginController {
	private $view;
	private $model;
	private $message = "";

	public function __construct() {
		$this->model = new \model\LoginModel();
		$this->view = new \view\LoginView($this->model);
	}

	public function doLogout() {
				$this->model->logOut();		
		}


	public function doLogoutWithCookies() {
		if ($this->view->hasLoginCookies() == true) {
			if ($this->view->hasLogOut() == true) {
				$this->model->logOut();
				$this->view->remove("LoginView::UserName");
				$this->view->remove("LoginView::Password");
				return true;
			}
		}		
	}
	

	public function doLogin() {

			$inputUsername = $this->view->getUserName();
			$inputPassword = $this->view->getPassword();
			$ip = $this->view->getClientIdentifer();
			$userCookieName = $this->view->getCookieUserName();
			$userCookiePassword = $this->view->getCookiePassword();
			$currentTime = time();

			if ($this->model->logIn($inputUsername, $inputPassword, $userCookieName, $userCookiePassword, $ip, $currentTime) == true) {

				if($this->view->hasChecked() == true) {
					$browser = $this->view->getUserAgent();
					$cookiePassword = $this->model->createCookieInformation($browser, $currentTime);

					$this->view->save("LoginView::UserName", $inputUsername);
					$this->view->save("LoginView::Password", $cookiePassword);
					$cryptPassword = $this->model->createCookieInformation($cookiePassword, $ip);
					$this->model->setCookieInformation($inputUsername, $cryptPassword, $this->view->cookieExpireTime());
				}

				return true;
			}

			return false;
		}		

	public function doDisplay() {
		$didLogin = false;

		if($this->view->hasLogOut() == true) {
			$this->doLogOut();
		}

		if ($this->view->hasSubmit() == true || $this->view->hasLoginCookies() == true) {
			if ($this->model->isLoggedIn() == false) {
				$didLogin = $this->doLogin();
			}
		}

		if ($this->doLogoutWithCookies() == true) {
			return $this->view->showLoginForm($didLogin);
		}

		if ($this->model->isLoggedIn() == true ) {
			return $this->view->showMemberSection($didLogin);
		}

		else {
			return $this->view->showLoginForm($didLogin);
		}
	}	


}
