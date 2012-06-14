<?php 
	session_start();
	if(!isset($_SESSION["user"]))
	{
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>The Fitness Journal</title>
		<style>
			 body{
				color:white;
                              padding:0px;
                              margin:0px;
                              background-color:#F5F5F5;
                         }
                         #ex_display{
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
                         td,th,p,h4{
                              color:white;
                         }
                         h4{
                              margin:0px;
			 }
			 a{color:white;}
			 a:visited {color:white;} 
			 a:hover {color:yellow;}  
			 a:active {color:yellow;}			      			
		</style>
		<script>
			function editEx(exId){
				var xmlhttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
 	 			}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
  				var exDate = ex_date.substring(6) + ex_date.substring(0,2) + ex_date.substring(3,5);
  				exChg
				xmlhttp.open("GET","editExercise.php?ex="+exId+"&exChg="+,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
  					{
						if (xmlhttp.responseText.substr(0,7) == "success")
						{
							window.location="maintEx.php";
						}
					}
  				}			
			}
		</script>
	</head>
	<body>
		<div>
                        <!-- The original image for this header is from University of the Frazier Valley - http://www.ufv.ca/es/Wellness/Fitness_Tips_of_the_Week.htm -->
			<img src="FitnessHeader.jpg" border="0" alt="The Fitness Journal"/>
		</div>
		<div>
			<a href="User Journal.php">My Journal</a> | <a href="Daily%20Exercises.php?action=logout">Logout</a>
		</div>
		<div id="ex_display">
<?php
	$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
	if(!$con)
	{
		die('Could not connect: ' . mysql_error());
	}	
	
	mysql_select_db("a3940063_journal", $con);
	$sql="SELECT * FROM Exercises WHERE U_Id=" . $_SESSION['uid'];
	$result = mysql_query($sql);
	
        echo "<form>";
	
	while($row = mysql_fetch_array($result))
	{
		echo $row['E_Name'] . '<input name="' . $row['E_Id'] . '" id="ex' . $row['E_Id'] . '"/><input type="button" value="Edit" onclick="editEx(' . $row['E_Id'] . ')"/><input type="button" value="Delete" onclick="deleteEx(' . $row['E_Id'] . ', ex' . $row['E_Id'] . '.value)"><br/>';
	}
	
	echo "</form>";
?>
		</div>
		
	</body>
</html>	
