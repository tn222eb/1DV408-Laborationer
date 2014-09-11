<?php

namespace view;

class MemberSection {

	private $logoutLocation = "logout";

	public function __construct() {

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


	public function showMemberSection () {
		$date = $this->getDate();

		$htmlbody = 
		"<h2>Admin is logged in</h2>

		<a href='?$this->logoutLocation'>Log out</a>

		</br>
		</br>

		$date";

		return $htmlbody;
	}
}