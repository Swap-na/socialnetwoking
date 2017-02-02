<?php
 session_start();
 include("includes/connection.php");
 include("share.php");
if(! $_SESSION['user_email']){
echo "<script>alert('please LOGIN FIRST!')</script>";
header("Location: index.php");
    die();
}
if(isset($_POST["addfriend"])) {
	echo "Name is Hello";
	
	global $con;
	$mail = $_SESSION['user_email'];
	$makefriendmail = $_POST["recv_mail"];
	$request = "insert into friends(sendreq_mail,receivereq_mail,friend_status) values('$mail','$makefriendmail','1')";
	$sendrequest = mysqli_query($con, "$request");
	header("Location: friends.php");
    die();
   }
 if (isset($_POST["accept"])){
	 global $con;
	 $mail=$_SESSION['user_email'];
	 $reqsendermail = $_POST['sender_mail'];
	 $accept = "update friends set friend_status='2' where sendreq_mail='$reqsendermail' and receivereq_mail='$mail'";
	 $acceptrequest = mysqli_query($con,$accept);
	 header("Location: friends.php");
	 
	 die();
 } 
if (isset($_POST["decline"])) {
	global $con;
	$mail = $_SESSION['user_email'];
	$reqsendermail = $_POST['sender_mail'];
	$decline ="delete from friends where sendreq_mail='$reqsendermail' and receivereq_mail='$mail'";
	$declinerequest = mysqli_query($con,$decline);
	header("Location: friends.php");
	die();
}
  
 ?>
 <!DOCTYPE html>

<html>
	<head>
		<title>Friends</title>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<link rel="stylesheet" href="styles/stylehomepage.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script type="text/javascript" src="js/jquery.js"></script>	
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
	</head>

	<body background="cap.jpg">
	<div class="nav">
	<div>
	    <a href="home.php" class="navitem home" >Home</a>
		<a href="message.php" class="navitem messages" >Messages</a>
		<a href="friends.php" class="navitem friends activated" >Makefriends</a>
		<a href="showfriends.php" class="navitem showfriends">Yourfriends</a>
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
			<?php echo $firstname;
			?>
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
	
	<div class="content">
			<div class="panel panel-default">
			   <div class="panel-heading">Make Friends</div>
				<?php
				/*Accept or decline requests*/
				global $con; 
				$mail=$_SESSION['user_email'];
				$usergetreq ="select sendreq_mail from friends where receivereq_mail='$mail' and friend_status='1'";	
				$userqueryreq = mysqli_query($con,$usergetreq);?>
				<?php				
				while($userreqrow=mysqli_fetch_array($userqueryreq)){
					$getreqsender = "select * from users where user_email='$userreqrow[0]'";
					$getreqsenderdata =mysqli_query($con,$getreqsender);
					$reqsenderdata = mysqli_fetch_array($getreqsenderdata);
					$reqsenderfirstname = $reqsenderdata[1];
					
					$reqsenderimage = $reqsenderdata[7];
					$reqsendermail = $reqsenderdata[4];
					?>
					
					<form action="" method="POST">
					<div class="makefriend">
					<img class="makefriendimage" src="<?php echo $reqsenderimage;?>">
			<?php   echo $reqsenderfirstname." sent you a friend request";
			?><input name="sender_mail" type="hidden" value="<?php echo $reqsendermail;?>" />
			<input class="btn btn-info addfriendbutton" name="accept"  value="Accept" type="submit" /> 	
			<input class="btn btn-info addfriendbutton" name="decline"  value="Decline" type="submit" />
			</div>
			<?php
				}
								
			/*end accept request*/
				/*Send friend requests*/
							
				$allusers = "select * from users";
				$getallusers = mysqli_query($con,$allusers);
					$mail = $_SESSION['user_email'];
					$getmakefriend= "select * from users where  user_email!='$mail'";
					 $makefriend =mysqli_query($con,$getmakefriend);?>
					 People You May Know:
					 <?php
					 while($row = mysqli_fetch_array($makefriend)){
						$firstname = $row[1];
						
						$user_image=$row[7];
						$makefriendmail = $row[4];
					
					$checkstatus ="select * from friends where sendreq_mail='$makefriendmail' and receivereq_mail='$mail'";
					$checkstatusquery=mysqli_query($con,$checkstatus);
					$checkstatusrow=mysqli_num_rows($checkstatusquery);
					if ($checkstatusrow==0){
					?>
					
					<form action="" method="POST">
					<div class="makefriend">
					<img class="makefriendimage" src="<?php echo $user_image;?>">
			<?php   echo $firstname;?>
			<input name="recv_mail" type="hidden" value="<?php echo $makefriendmail;?>" />
			<?php	
			
			
			global $con;
			$mail = $_SESSION['user_email'];
			$getfriendreq = "select * from friends where sendreq_mail='$mail' and receivereq_mail='$makefriendmail'";
			$getreq = mysqli_query($con, $getfriendreq);
						 if($getreq->num_rows == 0){
						?><input class="btn btn-info addfriendbutton" name="addfriend"  value="Add as Friend" type="submit" /> 
						</div>
						</form>
				 
					<?php }else{?>
					 <span class="label label-default addfriendbutton" >Friend Request Sent</span>
					 
				<?php
					  }
					}
					 }
				
				?>

				
				</div>
			</div>
			
	

	
	
					
	
					
	
		
	</body>



</html>