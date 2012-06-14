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
	$_SESSION["Ent_Id"]="";
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

		</script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
		<title>The Fitness Journal</title>
		<style>
			 body{
				color:white;
                              padding:0px;
                              margin:0px;
                              background-color:#F5F5F5;
                         }
                         #ex_display,#dateEntry,#ex_entry{
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
			function addEntry(ex_date) {
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
  				exDate = exDate * 1;
				xmlhttp.open("GET","addEntry.php?d="+exDate,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
  					{
						if (xmlhttp.responseText.substr(0,7) == "success")
						{
							window.location="Daily%20Exercises.php";
						}
						else
						{
							document.getElementById("entryErr").innerHTML="There was a problem adding Entry";
						}
					}
  				}			
			}
			function hideshow(idmo){
				elem = document.getElementById(idmo);
				if(elem.style.display=="none")
				{
					elem.style.display="block";	
				}
				else
				{
					elem.style.display="none";
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
			<a href="maintEx.php">Exercise Maint.</a> | <a href="Daily%20Exercises.php?action=logout">Logout</a>
		</div>
		<div style="text-align:left; font-size:20px;">
			<p style="display:inline;">It's good to see you're getting fit <?php echo $_SESSION["user"];?>!</p><br/><br/>
		</div>
		<?php 
			$con = mysql_connect("mysql5.000webhost.com", "a3940063_jc", "6doubles");
			if(!$con)
			{
				die('Could not connect: ' . mysql_error());
			}	

			mysql_select_db("a3940063_journal", $con);
			$sql="SELECT * FROM Entry WHERE U_Id=" . $_SESSION["uid"] . " ORDER BY Ent_Date ASC";
			try
			{
				$result=mysql_query($sql);
				if($result)
				{
					$entmo="";
					echo '<div id="entries">';
					while($row = mysql_fetch_array($result))
					{
						if(date("Y",strtotime($row['Ent_Date'])) == date("Y",time()))
						{
							if(date("F",strtotime($row['Ent_Date']))!=$entmo)
							{
								if($entmo)
								{
									echo '</div>';
								}
								$cntr=0;
								$entmo=date("F",strtotime($row['Ent_Date']));
								echo '<a onclick="hideshow('."'". $entmo . "'".')">' . $entmo . '</a><br/>';
								echo '<div id="' . $entmo . '" style="display:none">';
							}
							echo '<a href="Daily%20Exercises.php?entid=' . $row["Ent_Id"] . '">' . date("F d, Y",strtotime($row['Ent_Date'])) . '</a> ';
							$cntr+=1;
							if($cntr % 6 == 0)
							{
								echo "<br/>";
							}
						}
					}
					if($entmo)
					{
						echo '</div>';
					}
					echo '<br/></div>';
					
				}
			}
			catch(Exception $e)
			{
				echo "Unable to load Journal Entries.";
			}
		?>			
		<div id="dateEntry">
			<form action="#" id="ent_form">
				<script>DateInput('ex_date', true, 'MM/DD/YYYY')</script>
				<input type="button" value="Submit" name="dlyWeight" onclick="addEntry(ex_date.value)"/>
			</form>
			<span id="entryErr"></span>	
		</div>
	</body>
</html>
