<?php 
	session_start();
	if(!isset($_SESSION["user"]))
	{
		header("Location: index.php");
	}
	if(isset($_GET["action"]))
	{
		if($_GET["action"] = "logout")
		{
			session_destroy();
			setcookie("SID", "", time()-3600);
			header("Location: index.php");
		}
	}
	if($_GET['entid'])
	{
		$_SESSION['Ent_Id'] = $_GET['entid'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>The Fitness Journal</title>
		<style>
                         body{
                              padding:0px;
                              margin:0px;
                              background-color:#F5F5F5;
                         }
                         #ex_display,#ex_entry{
                              border-bottom-right-radius:25px;
                              border-bottom-left-radius:25px;
                         }
                         div{
                              width:800px;
                              margin-left:auto;
                              margin-right:auto;
                              text-align:center;
                              background-color:#29558f;
                         }
                         label{
                              display:inline-block;
			      width:100px;
                              color:white;
                              font-weight:bold;
                              font-size:15px;
			 }
			table{
				display:inline-block;
				border:solid white;
			}
                         td,th,p,h4{
                              color:white;
			 }
			p{
				display:inline-block;
			}
                         h4{
                              margin:0px;
			 }
			 a:link{color:white;}
			 a:visited {color:white;} 
			 a:hover {color:white;}  
			 a:active {color:white;}			      			
		</style>
		<script>
			function addExercise(exercise, reps, setsWt){
				if(!setsWt)
				{
					setsWt=0;
				}
				var xmlhttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET","addDlyExercise.php?ex="+exercise+"&reps="+reps+"&wt="+setsWt,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						if(xmlhttp.responseText.substr(0,7) == "success")
						{			
                                                	window.location="Daily Exercises.php";
						}
					}
				}
			}
			function setWt(weight){
				var xmlhttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET","setWt.php?wt=" + weight,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						if(xmlhttp.responseText.substr(0,7) == "success")
						{			
                                                	window.location="Daily Exercises.php";
						}
					}
				}
			}
		</script>
	</head>
	<body>
		<div>
                        <!-- The original image for this header is from University of the Frazier Valley - http://www.ufv.ca/es/Wellness/Fitness_Tips_of_the_Week.htm -->
			<img src="FitnessHeader.jpg" border="0" alt="The Fitness Journal"></a>
		</div>
		<div>
			<a href="User Journal.php">My Journal</a> <a href="Daily Exercises.php?action=logout">Logout</a>
		</div>
		<div>
<?php
	$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
	if(!$con)
	{
		die('Could not connect: ' . mysql_error());
	}	
 
	mysql_select_db("a3940063_journal", $con);
	$sql="SELECT * FROM Entry WHERE Ent_Id=" . $_SESSION['Ent_Id'];
	$result = mysql_query($sql);
 
	$row = mysql_fetch_array($result);
	if($row)
	{
		if($row['Ent_Wt']>0)
		{
			echo "<p>Your weight for this entry is " . $row['Ent_Wt'];
		}
		else
		{
			echo "<br/>";
		}
	}
 
?>
			<form>
				<label for="weight">Weight</label>
				<input name="weight" id="weight">
				<input type="button" value="Enter Weight" onclick="setWt(weight.value)">
			</form>
			<br/>
		</div>
		<div id="ex_entry">
			<form>
				<label for="exercise">Exercise:</label>
				<select name="exercise" id="exercise">
					<option value="">Choose Exercise</option>
<?php
	$result = mysql_query("SELECT * FROM Exercises");
 
	while($row = mysql_fetch_array($result))
	{
		echo "<option value=" . '"' . $row['E_Id'] . '"' . ">" . $row['E_Name'] . "</option>";
	}
 
?>
					

				</select><br/>
				<label for="reps">Total # of Reps</label>
				<input name="reps" id="reps"/><br/>
				<label for="setsWt">Weight</label>
				<input name="setsWt" id="setsWt"/><br/>
				<input type="button" value="Add Exercise" name="addEx" onclick="addExercise(exercise.value, reps.value, setsWt.value)"/>
			</form>
		</div>
		<div id="ex_display" style="visibility:hidden;">
<?php
	$sql="SELECT * FROM Dly_Exercises WHERE U_Id=" . $_SESSION['uid'] . " AND Ent_Id=" . $_SESSION['Ent_Id'] . ' ORDER BY E_Id ASC';
	$result = mysql_query($sql);
        $lstEx = "";
	while($row = mysql_fetch_array($result))
	{
		if($row['E_Id'] != $lstEx)
		{
			if($lstEx)
			{
				echo "</table><br/>";
			}
			$lstEx = $row['E_Id'];
			echo "<table><tr><th>Exercise</th><th>Reps</th><th>Weight</th></tr>";
		}
		$makevis=1;
		$sql = "SELECT E_Name FROM Exercises WHERE E_Id =" . $row['E_Id'];
		
		$ex = mysql_fetch_array(mysql_query($sql));
		echo "<tr><td>" . $ex['E_Name'] . "</td><td>" . $row['Dly_Reps'] . "</td><td>" . $row['Dly_Wt'] . "</td></tr>";
	}
	if($makevis)
	{
		echo "</table>";
?>
		<script>
			document.getElementById("ex_entry").style.borderRadius="0px";
			document.getElementById("ex_display").style.visibility="visible";
		</script>
<?php
	}
?>
				</tr>
			</table>
			<br/>
		</div>
	</body>
</html>

	



	

