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

$sql="INSERT INTO Dly_Exercises(E_Id,Ent_Id,Dly_Reps,Dly_Wt,U_Id) VALUES(" . $_GET['ex'] . ',' . $_SESSION["Ent_Id"] . ',' . $_GET['reps'] . ',' . $_GET['wt'] . ',' . $_SESSION["uid"] . ")";

try{
	mysql_query($sql);
	echo "success";
}
catch(Exception $e){
	echo "failure";
}
?>
