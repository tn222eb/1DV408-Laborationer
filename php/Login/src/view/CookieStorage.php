<?php

namespace view;

class CookieStorage {

 	private static $cookieName = "CookieStorage";

 	public function save($string) {
 		setcookie(self::$cookieName, $string, -1);
 	}

 	public function load() {
 		if (isset($_COOKIE[self::$cookieName])) {
 			$ret = $_COOKIE[self::$cookieName];
 		}
 		else {
 			$ret = "";
 		}
 		
 		setcookie(self::$cookieName, "", time() -1);

 		return $ret;
 	}
}

