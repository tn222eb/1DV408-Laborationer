<?php

require_once("src/controller/LoginController.php");
require_once("../common/HTMLView.php");

$logincontroller = new \controller\LoginController();
$formhtml = $logincontroller->showLogin();

$view = new HTMLView();
$view->echoHTML($formhtml);