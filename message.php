<?php
 session_start();
 include("includes/connection.php");
 include("share.php");
if(! $_SESSION['user_email']){
echo "<script>alert('please LOGIN FIRST!')</script>";
header("Location: index.php");
    die();
}
$mail = $_SESSION['user_email'];
	
	
	
	
	
?>
 <!DOCTYPE html>

<html>
	<head>
		<title>Messages</title>
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
		<a href="message.php" class="navitem messages activated" >Messages</a>
		<a href="friends.php" class="navitem friends" >Makefriends</a>
		<a href="showfriends.php" class="navitem showfriends">Yourfriends</a>
		<a href="logout.php"  class="navitem logout">Logout</a>
	</div>
	<img  id="logo" src="logo2.jpeg"> 
	<div id="sc">
	Creations
	</div>
	</div> 
	
	<div class=yourprofile>
		<nav class="navbar navbar-default" id="navfriends">
		  <div class="container-fluid">
			<div class="navbar-header">
			Chat Now!		
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
					
					$friendimage = $userdatalist[7];
					$friendmail= $userdatalist[4];
		?>	
			<div class="friend" >
				<img class="friendimage" src="<?php echo $friendimage;?>" />
				<span><?php echo $friendfirstname ?></span>
				<form action="" method="post">
					<input class="chatmail"  type="hidden" name="chat_mail" value="<?php echo $friendmail;?>" />
				</form>
			</div>
			
		<?php	
		}
		?>
		
	</div>
	
	<div class="chatcontent" id="chatscroll" >
		<nav class="navbar navbar-default" id="navfriends">
		  <div class="container-fluid">
			<div class="navbar-header" id="navbarchat">
			
			</div>
			<span id="chattermail"> </span>
		  </div>
		</nav>
	
	<div class="fullchat" >
		<div class="eachchat" id="eachchat">
		
		</div>
	</div>
	</div>
	<div class="chatbox">
		<textarea id="chatarea" type="text" name="chat" rows="4" cols="65"  placeholder="Text now!" ></textarea>
		<button class="btn btn-info" id="chatbutton" name="chatsendbutton" >Send!</button>
		</div>
		
	<script>
		$(document).ready(function(){
				
					$('.friend').click(postfunction);
					$('#chatbutton').click(chatfunction);
					
					
				});
		var successfunction = function(data)
						{
						console.log(data);
						$('.eachchat').children().remove();
						var datas = JSON.parse(data);
						
						for (var i=0;i<datas.length;i++)
						{	
							console.log(datas[i][3]);
							console.log($('#chattermail').text());
					
							if (datas[i][3]!=$('#chattermail').text()){
							$('.eachchat').append("<div class=\"mychat\">"+datas[i][2]+"</div>");
							
							}
							
							else
							{
								$('.eachchat').append("<div class=\"yourchat\">"+datas[i][2]+"</div>");
								
							}
							
						}
						$('#chatscroll').animate({scrollTop: $("#chatscroll")[0].scrollHeight}, 800);
						};
		var postfunction = function()
		{	$('.friend').removeClass("colorchange");
			$(this).addClass("colorchange");
			$('#navbarchat').text($(this).children('span')[0].innerText);
			$('#chattermail').text($(this).children('form').children('input').val());
			$.post("chatretrieve.php",
			{
				person_mail : $(this).children('form').children('input').val()
			},
			successfunction);
		};
				
		
		var chatsuccessfunction = function(data){
			$('.eachchat').children().remove();
			console.log(data);
			var datas = JSON.parse(data);
						
						
						for (var i=0;i<datas.length;i++)
						{	
							console.log(datas[i][3]);
							console.log($('#chattermail').text());
					
							if (datas[i][3]!=$('#chattermail').text()){
							$('.eachchat').append("<div class=\"mychat\">"+datas[i][2]+"</div>");
							}
							
							else
							{
								$('.eachchat').append("<div class=\"yourchat\">"+datas[i][2]+"</div>");
							}
							
						}
			
						
		};
		
		var chatfunction = function()
		{	
			$.post("chatretrieve.php",
			{	chatter_mail : $('#chattermail').text(),
				chat_clientcontent: $('#chatarea').val()
			},
			chatsuccessfunction);		
			$('#chatarea').val("");
			
		};
		
		</script>
		</body>
</html>