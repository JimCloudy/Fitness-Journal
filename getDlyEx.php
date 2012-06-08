<?php
session_start();
if(!isset($_SESSION["user"]))
{
	header("Location: index.php");
}

$ent=$_SESSION["Ent_Id"];

$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	

mysql_select_db("a3940063_journal", $con);

$sql="SELECT * FROM Dly_Exercises WHERE U_Id=" . $_SESSION['uid'] . " AND Ent_Id=" . $ent;

$result = mysql_query($sql);

$innerhtml = "";

if($result)
{
	while($row = mysql_fetch_array($result))
	{
		$sql = "SELECT E_Name FROM Exercises WHERE E_Id =" . $row['E_Id'];
		
		$ex = mysql_fetch_array(mysql_query($sql));
		$innerhtml = $innerhtml . "<tr><td>" . $ex['E_Name'] . "</td><td>" . $row['Dly_Sets'] . "</td><td>" . $row['Dly_Reps'] . "</td><td>" . $row['Dly_MaxWt'] . "</td></tr>";
	}
}

echo $innerhtml;
?>

