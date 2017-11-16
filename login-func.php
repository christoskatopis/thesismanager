<?php

function validate_username($name) {

	if ($name == "")
		return "Please insert a username";


	if (strrpos($name,' ') > 0) {
		return "Spaces are not permited in username";
	}

	if (strspn($name,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") == 0) {
		return "Username mt have at least one character";
	}


	if (strspn($name,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_")
		!= strlen($name)) {
		return "Invalid characters in username";
	}

	
	if (strlen($name) < 5) {
		return "Username must be at least 5 characters long";
	}
	if (strlen($name) > 15) {
		return "Username must be shorter than 15 characters";
	}


	if (preg_match("#^((root)|(bin)|(daemon)|(adm)|(lp)|(sync)|(shutdown)|(halt)|(mail)|(news)"
		. "|(uucp)|(operator)|(games)|(mysql)|(httpd)|(nobody)|(dummy)"
		. "|(www)|(cvs)|(shell)|(ftp)|(irc)|(debian)|(ns)|(download))$#i",$name)) {
		return "This username is reserved.";
	}
	if (preg_match("#^(anoncvs_)#i",$name)) {
		return "The username is reserved";
	}

	return "OK";
}

function validate_password($pw) {

	if (strlen($pw) < 6)
		return "The password must contain at least 6 characters";

	return "OK";
}

function validate_email($address) {
	return (preg_match('#^[-!$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$#', $address));
}



function validate_credit($credit) {
	if (strlen($credit)<14)
		{return "The credit card number is not a valid credit card number";}
	
    if (strspn($credit,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_")
		!= strlen($credit))
    	{return"The credit card number is not a valid credit card number"; }

	return "OK";
	
	}








?>