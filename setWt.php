<?php
session_start();
if(!isset($_SESSION["user"]))
{
	header("Location: index.php");
}
$wt= $_GET["wt"];
$wt= $wt*1;

$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	

mysql_select_db("a3940063_journal", $con);

try{
	$sql="UPDATE Entry SET Ent_Wt=" . $wt . " WHERE Ent_Id=" . $_SESSION["Ent_Id"];
	$result=mysql_query($sql);
	if($result)
	{
		echo "success";
	}
	else
	{
		echo $sql . "<br/>";
		echo "failure";
	}
}
catch(Exception $e){
	echo "failure";
}
?>
