<?php
header("Content-type: text/javascript");

$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	

mysql_select_db("a3940063_journal", $con);

$sql="SELECT Ent_Wt, EXTRACT(MONTH FROM Ent_Date) AS Ent_Month FROM Entry ORDER BY Ent_Date";

$result = mysql_query($sql);

$values = array();

$ndex = 0;

while($row=mysql_fetch_array($result))
{
	$values[$ndex] = array("X" => $row['Ent_Month'], "Y" => $row['Ent_Wt']);
	$ndex++;
}

echo '{"values":' . json_encode($values) . '}';

?>




