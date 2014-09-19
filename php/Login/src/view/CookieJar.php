<?php

namespace view;

require_once("src/model/LoginModel.php");

class CookieJar {

	private $model;

	public function __construct(\model\ LoginModel $model) {
		$this->model = $model;
	}

	public function save($cookieName, $cookieValue) {
		setcookie($cookieName, $cookieValue, $this->cookieTime());
	}

	public function remove($cookieName) {
		setcookie($cookieName, "" , time() -1);
	}

	public function cookieTime() {
		return time() + 30;
	}

	public function getClientIdentifer() {
		return $_SERVER["REMOTE_ADDR"];
	}	

	public function hasLoginCookies() {
		if(isset($_COOKIE["LoginView::UserName"]) && isset($_COOKIE["LoginView::Password"]) == true) {
				return true;
			}
		
		return false;
	}

	public function getCookieUserName() {
		if($this->hasLoginCookies() == true) {
		return $_COOKIE["LoginView::UserName"];
	}
	return "";
	}

	public function getCookiePassword() {
		if($this->hasLoginCookies() == true) {
		return $_COOKIE["LoginView::Password"];
		}
		return "";
	}
}