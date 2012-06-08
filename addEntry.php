<?php
session_start();
if(!isset($_SESSION["user"]))
{
	header("Location: index.php");
}
$exDate= $_GET["d"];
$exDate= $exDate*1;

$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	

mysql_select_db("a3940063_journal", $con);

try{
	$sql="SELECT * FROM Entry WHERE Ent_Date =" . $exDate . " AND U_Id=" . $_SESSION["uid"];
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row)
	{
		$_SESSION["Ent_Id"]=$row["Ent_Id"];
		echo "success 1 " . $_SESSION["Ent_Id"];
	}
	else
	{
		$sql="INSERT INTO Entry(Ent_Date,U_Id) VALUES(" . $exDate . "," . $_SESSION["uid"] . ")";
		mysql_query($sql);
		$sql="SELECT * FROM Entry WHERE Ent_Date=" . $exDate . " AND U_Id=" . $_SESSION["uid"];
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result);
		if($row)
		{
			$_SESSION["Ent_Id"]=$row["Ent_Id"];
			echo "success 2";
		}
		else
		{
			echo $sql . "<br/>";
			echo "failure";
		}
	}
}
catch(Exception $e){
	echo "failure";
}
?>
