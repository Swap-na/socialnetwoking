 <?php
 session_start();
 include("includes/connection.php");
 include("share.php");
if(! $_SESSION['user_email']){
echo "<script>alert('please LOGIN FIRST!')</script>";
header("Location: index.php");
    die();
}
 ?>
 <!DOCTYPE html>

<html>
	<head>
		<title>ShowFriends</title>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<link rel="stylesheet" href="styles/stylehomepage.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script type="text/javascript" src="js/jquery.js"></script>	
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
	</head>

	<body>
	<body background="cap.jpg">
	<div class="nav">
	<div>
	    <a href="home.php" class="navitem home" >Home</a>
		<a href="message.php" class="navitem messages" >Messages</a>
		<a href="friends.php" class="navitem friends" >Makefriends</a>
		<a href="showfriends.php" class="navitem showfriends activated">Yourfriends</a>
		<a href="logout.php"  class="navitem logout">Logout</a>
	</div>
	<img  id="logo" src="logo2.jpeg"> 
	<div id="sc">
	Creations
	</div>
	</div>
	
	<div class= "yourprofile">
		<div>
		<?php
			$mail = $_SESSION['user_email'];
			$details = mysqli_query($con,"SELECT * FROM users WHERE user_email = '$mail'");
			while($row = mysqli_fetch_array($details)){
				$firstname = $row[1];
				
				$status = $row [10];
			    $user_image=$row[7];
				$posts=$row[11];
			
		?>
		<img id="myimage" src="<?php echo $user_image;?>">
		<button type="button" id="changeimage" class="btn btn-default" aria-label="Left Align" >
		<span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Change image
		</div>
		<div id="dialog" title="Upload a photo">
		<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" id="uploadphoto" name="imagebutton"/>
		<input type="submit"/>
		</div>
		<script>
		$("#dialog" ).hide();
		$('#changeimage').click(function(){
			$("#dialog" ).dialog();
			$("#dialog" ).show();		
		});
		</script>
			
		<div class="name"> 
			<div class="panel panel-primary">
			<?php echo $firstname;?>
			</div>
			<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Current Status:</h3>
					</div>
			<div class="panel-body">
			<?php echo $status;?>
			</div>
				
			</form>
			</div>
			
		</div>
		
		<?php	}
		?>
	</div>
	
	<div class=content>
		<nav class="navbar navbar-default" id="navfriends">
		  <div class="container-fluid">
			<div class="navbar-header">
			Friends
			</div>
		  </div>
		</nav>
		<?php
		global $con;
		$mail = $_SESSION['user_email'];
		$friends = "select * from friends where friend_status='2' and (sendreq_mail='$mail' or receivereq_mail='$mail')";
		$friendsquery = mysqli_query($con,$friends);
		while($friendslist=mysqli_fetch_array($friendsquery)){
					$userdata = "select * from users where (user_email='$friendslist[1]' or user_email='$friendslist[2]') and user_email!='$mail'";
					$userdataquery =mysqli_query($con,$userdata);
					$userdatalist = mysqli_fetch_array($userdataquery);
					$friendfirstname = $userdatalist[1];
					$friendlastname = $userdatalist[2];
					$friendimage = $userdatalist[8];
					
		?>	
			<div class="makefriend">
			<img class="makefriendimage" src="<?php echo $friendimage;?>">
			<?php  echo $friendfirstname." ".$friendlastname; ?>
			</div>
		<?php	
		}
		?>
		
		
	
			
  
	</div>
	
	
				
		
	</body>



</html>