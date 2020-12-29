<?php
require_once("AppsRestHandler.php");
		
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		// to handle REST Url /subdomains
		$appsRestHandler = new AppsRestHandler();
		$appsRestHandler->getAllApps();
		break;
		
	case "single":
		// to handle REST Url /subdomains/<id>/
		$appsRestHandler = new AppsRestHandler();
		$appsRestHandler->getApp($_GET["name"]);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
