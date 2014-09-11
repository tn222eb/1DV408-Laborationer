<?php

namespace view;

class MemberSection {

	private $logoutLocation = "logout";

	public function __construct() {

	}

	public function getDate() {
		setlocale(LC_ALL, "swedish");

		$date = "";

		$dayofWeek = ucfirst(strftime("%A"));
		$day = strftime("%d");
		$month = ucfirst(strftime("%B"));
		$year = strftime("%Y");
		$time = strftime("%X");

		$date .=   $dayofWeek . ",  Den " . $day . " " . $month . " år " . $year . ". Klockan är [" . $time . "].";

		return $date;
	}	

	public function showMemberSection () {
		$date = $this->getDate();

		$htmlbody = 
		"<form method='post'>
		<h2>Admin är inloggad</h2>
		<input type='submit' value='Logga ut' name='$this->logoutLocation'>

		</br>
		</br>

		$date

		</form>

		";

		return $htmlbody;
	}
}