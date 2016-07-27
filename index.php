<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	session_start();
	
	$map = require_once "map.php";
	$config = require_once "config.php";
	
	spl_autoload_register(function($class) 
	{
		global $map;
		require_once $map[$class];
	});
	
	use app\PageRouter; 
	use app\DBConnection;
	use app\models\dbobject\User;
	
	$dbConnection = new DBConnection();
	
	if ($_SESSION["user"])
		$currentUser = new User($_SESSION["user"]);
	
	$pageRouter = new PageRouter($_SERVER["REQUEST_URI"]);
?>