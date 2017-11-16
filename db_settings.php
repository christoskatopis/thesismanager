<?php

     
	$hostname = 'localhost';	
	$dbname = 'thesismanager';		
	$username = 'root';			
	$password = '';				
	mysql_connect($hostname, $username, $password) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());	
    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER SET 'ISO-8859-1'");
	$mysql= mysql_connect($hostname, $username, $password);
	mysql_set_charset("ISO-8859-1",$mysql);
	$db = new mysqli($hostname, $username, $password, $dbname);	
?>
