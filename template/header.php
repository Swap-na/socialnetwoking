<!DOCTYPE HTML>

<html>

<head>
   <title>
   Social Network
    </title>
	<link rel="stylesheet" href="styles/style.css" media="all"/>
	
</head>
<body background="back.jpg">

 
 <div class="container">
 
 
     <div id="head_wrap">
 
           <div id="header">
		   
		   			  <div id="loginsaying"><marquee>Login now to connect! </marquee></div>
		   
		  <div id="logo"> <img src="images/logo.png" style="float:left"/></div>
		   
		   
		 


	
		      <form method="post" action="" id="form1">

			      <strong>Email:</strong><input type="email" name="email" placeholder="Email!" required="required"/>
			       <strong>Password:</strong><input type="password" name="pwd" placeholder="********" required="required"/>
				   <button name="login">Login</button>
			  </form>
		   <?php
	include("login.php");
	?>
          </div>
 </div>
     </div>