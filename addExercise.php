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

	$sql='SELECT * FROM Exercises WHERE U_Id=' . $_SESSION['uid'] . ' AND E_Name="' . $_GET['exName'] .'"';

	$result=mysql_query($sql);

	if($row=mysql_fetch_array($result))
	{
		echo "exists";
	}
	else
	{
		$sql='INSERT INTO Exercises (E_Name, U_Id) VALUES ("' . $_GET['exName'] . '",' . $_SESSION['uid'] . ')'; 
		mysql_query($sql);

		$sql='SELECT * FROM Exercises WHERE U_Id=' . $_SESSION['uid'] . ' AND E_Name="' . $_GET['exName'] .'"';

		$result=mysql_query($sql);

		if($row=mysql_fetch_array($result))
		{
			echo "success";
		}
		else
		{
			echo "failure";
		}
	}	
?>	
