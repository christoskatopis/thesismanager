<?php
	
	if (isset($_GET["action"]))
		$action = $_GET["action"];
	else
		$action = "";
	
	include('db_settings.php');


session_start();
error_reporting(0);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
<title>Thesis Manager</title>

	
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">


	





   
</head>

	

	
