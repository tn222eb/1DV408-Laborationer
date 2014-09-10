<?php

namespace view;

class MemberSection {

	public function __construct() {

	}

	public function showMemberSection () {
		$htmlbody = "<h2>Admin är inloggad</h2>

		<a href='?logout'>Logga ut</a>";

		return $htmlbody;
	}
}