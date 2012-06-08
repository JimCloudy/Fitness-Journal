<?php
	session_start();
	if(isset($_POST["uname"]))
	{
		$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
		if(!$con)
		{
			die('Could not connect: ' . mysql_error());
		}	

		mysql_select_db("a3940063_journal", $con);

		$sql='SELECT * FROM Users WHERE U_Name="' . $_POST["uname"] . '" AND U_Password="' . $_POST["upass"] . '"';
		$result = mysql_query($sql);

		if($result)
		{
			$user = mysql_fetch_array($result);

			if($user)
			{
				$_SESSION["uid"] = $user["U_Id"];
				$_SESSION["user"] = $user["U_Name"];
				echo "success";
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

		$sql='SELECT * FROM Users WHERE U_Name="' . $_GET["uname"] . '" AND U_Password="' . $_GET["upass"] . '"';
		
		$result = mysql_query($sql);


		if($result)
		{
			$user = mysql_fetch_array($result);
			
			if($user)
			{
				echo "<br/>the user id is = ".$user["U_Id"]."<br/>";
	
				$_SESSION["uid"] = $user["U_Id"];
				$_SESSION["user"] = $user["U_Name"];
				echo "we got a winner";
			}
		}
		//header("Location: index.php");
	}
?>
