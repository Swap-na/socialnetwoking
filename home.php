
<?php
 session_start();
 include("includes/connection.php");
 include("share.php");
if(! $_SESSION['user_email']){
echo "<script>alert('please LOGIN FIRST!')</script>";

die();
}
 ?>
 <!DOCTYPE html>

<html>
	<head>
		<title>SocialNetwork</title>
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
	    <a href="home.php" class="navitem home activated" >Home</a>
		<a href="message.php" class="navitem messages" >Messages</a>
		<a href="friends.php" class="navitem friends" >Makefriends</a>
		<a href="showfriends.php" class="navitem showfriends">Yourfriends</a>
		<a href="logout.php" class="navitem logout">Logout</a>
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
				$user_name = $row[1];
				
				$status = $row [10];
			    $user_image=$row[8];
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
			<div class="panel panel-primary" id="username">
			<?php echo $user_name;
?>
			<input  type="hidden" name="post_mail" value="<?php echo $mail;?>" />
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
			<form method="post">
			<input id="statusbar" type="text" name="setstatus"  placeholder="Set a new status!" size="60"/>
			<input class="btn btn-info" id="statusbutton" name="statusbutton" value="Set Status!" type="submit" /> 
			</br>	
			<textarea id="postbar" type="text" name="post" rows="4" cols="62"  placeholder="Share a Post!" ></textarea>
			<input class="btn btn-info" id="postbutton" name="postsendbutton" value="Post!" type="submit" />
			</form>
			<div>
			<button type="button" id="postphotobtn" class="btn btn-default" >
			<span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Upload photo
			<div id="postdialog" title="Upload a photo">
		<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" id="postphoto" name="postphotobutton"/>
		<input type="submit"/>
		</form>
		</div>
		<script>
		$("#postdialog" ).hide();
		
		
		var postphotofunction = function(){
			$("#postdialog" ).dialog();
			$("#postdialog" ).show();	
			
			
		};
		
		$('#postphotobtn').click(postphotofunction);
		
				
		</script>
			<button type="button" id="uploadvideo" class="btn btn-default" >
			<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Upload video
			<div id="postvideodialog" title="Upload a video">
		<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" id="postvideo" name="postvideobutton"/>
		<input type="submit"/>
		</form>
		</div>
		</div>
		<script>
		$("#postvideodialog" ).hide();
		$('#uploadvideo').click(function(){
			$("#postvideodialog" ).dialog();
			$("#postvideodialog" ).show();		
		});
				
				
		</script>	
			<div >
				<?php
					global $con;
					$mail = $_SESSION['user_email'];
					$postdata = "select * from posts where post_usermail='$mail'";
					$postdataquery =mysqli_query($con,$postdata);
					while($postdatalist = mysqli_fetch_array($postdataquery)){
						$postername = $postdatalist[0];
						$posterimage = $postdatalist[2];
						$postdatetime = $postdatalist[3];
						$postcontent = $postdatalist[4];
						$uploadedphoto = $postdatalist[5];	
						$uploadedvideo = $postdatalist[6];
								
					?>	<div class="eachpost">
						<div class="postednow">
						<img class="postfriendimage" src="<?php echo $posterimage;?>">
						<?php  echo $postername." ".$postdatetime; ?>
						</div>
						<div class="postcontent" >
						<?php echo $postcontent; 
						if ($uploadedphoto){
						?>
						<img class="postedimage" src="<?php echo $uploadedphoto;?>">
						<?php
						} if ($uploadedvideo){
						
						?>
						
						<!--<embed src="<?php echo $uploadedvideo ?>">-->
						<video  controls  width="340" height="264" src="<?php echo $uploadedvideo ?>" >
						Your browser does not support the video tag.
						</video>
						
						<?php } ?>
						</div>
						</div>
					<?php	
					
					}
					
					
					$friends = "select * from friends where friend_status='2' and (sendreq_mail='$mail' or receivereq_mail='$mail')";
					$friendsquery = mysqli_query($con,$friends);
					while($friendslist=mysqli_fetch_array($friendsquery)){
								$userdata = "select * from posts where (post_usermail='$friendslist[1]' or post_usermail='$friendslist[2]') and post_usermail!='$mail'";
								$userdataquery =mysqli_query($con,$userdata);
								while($postdatalist = mysqli_fetch_array($userdataquery)){
								$postername = $postdatalist[1];
								$posterimage = $postdatalist[3];
								$postdatetime = $postdatalist[4];
								$postcontent = $postdatalist[5];
								$uploadedphoto = $postdatalist[6];
								
					?>	<div class="eachpost">
						<div class="postednow">
						<img class="postfriendimage" src="<?php echo $posterimage;?>">
						<?php  echo $postername." ".$postdatetime; ?>
						</div>
						<div class="postcontent" >
						<?php echo $postcontent; 
						if ($uploadedphoto){
						?>
						<img class="postedimage" src="<?php echo $uploadedphoto;?>">
						<?php
						}
						?>
						</div>
						</div>
					<?php	
					}
					}
					
					?>
					
					
					
					
					
				
			</div>
			
			
  
	</div>
			<script>
			$(document).ready(function(){
				$('#postbutton').click(postnowfunction);
				
				
			});
			
			var successpostfunction = function(data){
				
				
				
				
				
			};
			
			
			var postnowfunction = function(){
				$.post("share.php",
			{
				person_name : $.trim($('.name').children('#username').text()),
				post_content: $('#postbar').val(),
				post_image : $('.yourprofile').children("div").children("img").attr('src'),
				post_mail : $('.name').children("div").children("input").val()
				
			},
			successpostfunction);
				
			};
			
	
	
	</script>
	
	
	
		
	</body>



</html>