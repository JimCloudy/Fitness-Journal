<?php
	session_start();
	if(isset($_SESSION["user"]))
	{
		header("Location: User Journal.php");	
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>The Fitness Journal</title>
                <style>
                     body{
                          padding:0px;
                          margin:0px;
                          background-color:#F5F5F5;
                     }
                     div{
                          width:800px;
                          margin-left:auto;
                          margin-right:auto;
                          text-align:center;
                          background-color:#29558f;
                     }
                     .content{
                          border-bottom-right-radius:25px;
                          border-bottom-left-radius:25px; 
                     }
                     label{
                          color:white;
                          font-weight:bold;
                          font-size:15px;
                     }
                     header{
                          width:800px;
                          height:253px;
                          margin-left:auto;
                          margin-right:auto;
                     }
                     form{
                          width:325px;
                          margin-left:auto;
                          margin-right:auto;
                     } 
                     fieldset{
                          border:none;
                          text-align:right;
                     }
                     output{
                         color:yellow;
                     }
                </style>
		<script>
		function checkUser(){
                           if(document.getElementById("upass").value=="" && document.getElementById("uname").value=="")
                           {
                                document.getElementById("baduser").innerHTML="Invalid User Name and Password";
                           }
                           else if(document.getElementById("upass").value=="")
                           {
                                document.getElementById("baduser").innerHTML="Invalid Password";
                           }
                           else if(document.getElementById("uname").value=="")
                           {
                                document.getElementById("baduser").innerHTML="Invalid User Name";
                           }
                           else
			   {  
				var xmlhttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
 	 			}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("POST","login.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var runame = encodeURIComponent(document.getElementById("uname").value);
				var rpass = encodeURIComponent(document.getElementById("upass").value);
				var request = "uname=" + runame + "&upass=" + rpass;
				xmlhttp.send(request);
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						if(xmlhttp.responseText.substr(0,7) == "success")
						{
							window.location="User Journal.php";
						}
						else
						{
							document.getElementById("baduser").innerHTML="Check User and/or Password";
						}
					}
				}
                           } 
                     }
                     function checkNewUser(){
                           if(document.getElementById("npass").value=="" && document.getElementById("nname").value=="") 
                           {
                                document.getElementById("badnewuser").innerHTML="Invalid User Name and Password";
                                return;
                           }
                           else if(document.getElementById("npass").value=="")
                           {
                                document.getElementById("badnewuser").innerHTML="Invalid Password";
                                return;
                           }
                           else if(document.getElementById("nname").value=="")
                           {
                                document.getElementById("badnewuser").innerHTML="Invalid User Name";
                                return;
                           }
                           else if(document.getElementById("npass").value != document.getElementById("cpass").value)
                           {
                                document.getElementById("badnewuser").innerHTML="Passwords Do Not Match";
                           }
                           else
                           {
                                var xmlhttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
 	 			}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("POST","signup.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var runame = encodeURIComponent(document.getElementById("nname").value);
				var rpass = encodeURIComponent(document.getElementById("npass").value);
				var request = "nname=" + runame + "&npass=" + rpass;
				xmlhttp.send(request);
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						if(xmlhttp.responseText.substr(0,7) == "success")
						{
							window.location="User Journal.php";
						}
						else
						{
							alert(xmlhttp.responseText);
							document.getElementById("badnewuser").innerHTML="Invalid New User";
						}
					}
				}
                           }                           
                     }  
                </script>
	</head>
	<body>
		<div>
                        <!-- The original image for this header is from University of the Frazier Valley - http://www.ufv.ca/es/Wellness/Fitness_Tips_of_the_Week.htm -->
			<img src="http://i96.photobucket.com/albums/l188/postmasterlynch/Fitness%20Journal/FitnessHeader-1.jpg" border="0" alt="The Fitness Journal"></a>
		</div>
		<div class="content">
			<form method="post">
				<fieldset>
					<label for="uname">User Name</label>
					<input name="uname" id="uname"/><br/>
					<label for="upass">Password</label>
					<input type="password" name="upass" id="upass"/><br/>
					<input type="button" value="Sign In" onclick="checkUser()"/><br/>
                                        <output id="baduser"></output>
				</fieldset>
				<fieldset>
					<label for="nname">New User Name</label>
					<input name="nname" id="nname"/><br/>
					<label for="npass">New User Password</label>
					<input type="password" name="npass" id="npass"/><br/>
					<label for="cpass">Confirm Password</label>
					<input type="password" name="cpass" id="cpass"/><br/>
					<input type="button" value="Sign Up" onclick="checkNewUser()"/><br/>
                                        <output id="badnewuser"></output>
				</fieldset>
			</form>
		</div>
	</body>
</html>
	

