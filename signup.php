<?php
	session_start();
	if(isset($_POST["nname"]))
	{
		$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
		if(!$con)
		{
			die('Could not connect: ' . mysql_error());
		}	

		mysql_select_db("a3940063_journal", $con);

		$sql='SELECT * FROM Users WHERE U_Name="' . $_POST["nname"] . '"';

		$result = mysql_query($sql);

		if($result)
		{
			$user = mysql_fetch_array($result);

			if(!$user)
			{
				$sql='INSERT INTO Users(U_Name,U_Password,U_BegDate) VALUES("' . $_POST["nname"] . '","' . $_POST["npass"] . '","' . date("y-m-d h:i:s") . '")';
				$result = mysql_query($sql);
				
				if($result)
				{
					$_POST["uname"] = $_POST["nname"];
					$_POST["upass"] = $_POST["npass"];
					//$_GET["signup"] = "signup";
					include "login.php";
				}
			}
		}		
	}
	if($_GET)
	{
		$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
		if(!$con)
		{
			die('Could not connect: ' . mysql_error());
		}	

		mysql_select_db("a3940063_journal", $con);

		$sql='SELECT * FROM Users WHERE U_Name="' . $_GET["nname"] . '"';

		$result = mysql_query($sql);
		
		if($result)
		{
			$user = mysql_fetch_array($result);
			
			if(!$user)
			{
				$sql='INSERT INTO Users(U_Name,U_Password,U_BegDate) VALUES("' . $_GET["nname"] . '","' . $_GET["npass"] . '","' . date("Y-m-d h:i:s") . '")';

				$result = mysql_query($sql);
				
				if($result)
				{
					$_POST["uname"] = $_GET["nname"];
					$_POST["upass"] = $_GET["npass"];
					include "login.php";
				}
			}
		}
	}
?>
