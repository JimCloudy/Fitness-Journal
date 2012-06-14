<?php 
	session_start();
	if(!isset($_SESSION["user"]))
	{
		header("Location: index.php");
	}

	$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
	if(!$con)
	{
		die('Could not connect: ' . mysql_error());
	}	
	
	mysql_select_db("a3940063_journal", $con);

	$sql='UPDATE Exercises SET E_Name="' . 
	
