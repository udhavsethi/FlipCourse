<?php

define('INCLUDE_CHECK',true);
// This file can be included only if INCLUDE_CHECK is defined

require 'connect.php';

session_name('Login');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

// Redirect if already logged in
if(isset($_SESSION['id']))
{
	// header("Location: insert.php");
	// exit;
}


if (isset($_POST['submit']))
{
	// Checking whether the Login form has been submitted
	if($_POST['submit'] =='Login') 
	{
		$err = array();
		// Will hold our errors
		
		
		if(!$_POST['username'] || !$_POST['password'])
			$err[] = 'All the fields must be filled in!';
		
		if(!count($err))
		{
			$_POST['username'] = mysql_real_escape_string($_POST['username']);
			$_POST['password'] = mysql_real_escape_string($_POST['password']);
			// Escaping all input data

			$query = "SELECT id,usr FROM userTable WHERE usr='{$_POST['username']}' AND pass='".md5($_POST['password'])."'";
			$result = $usrConn->query($query);
			// echo $result;

			if ($result->num_rows) {
			    // If everything is OK login
			    $row = $result->fetch_assoc();
				$_SESSION['usr'] = $row['usr'];
				$_SESSION['id'] = $row['id'];
				// Store some data in the session
				// echo $_SESSION['id'];
				header("Location: insert.php");
				exit;
				// REdirect to the insert page
			}
			else
			  $err[]='Wrong username and/or password!';
			
			$usrConn->close();
		}

		if($err)
			$_SESSION['msg']['login-err'] = implode('<br />',$err);
		// Save the error messages in the session

		header("Location: login.php");
		exit;
	}
}
?>