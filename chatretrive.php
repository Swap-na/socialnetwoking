<?php
	session_start();
	include("includes/connection.php");
	$mail = $_SESSION['user_email'];
	
	if (isset ($_POST['person_mail'])){
	$personmail= $_POST['person_mail'];
	$retrievechat = "select * from chat where (chat_sender = '$mail' and chat_receiver='$personmail') or (chat_sender = '$personmail' and chat_receiver='$mail')";
	$retrievechatquery = mysqli_query($con,$retrievechat);
	$array = array();
	while ($chatrow = mysqli_fetch_array($retrievechatquery)){
		$chatsender = $chatrow[1];
		$chatcontent =$chatrow[3];
		$chattername = "select * from users where user_email='$chatsender'";
		$chatternamequery = mysqli_query($con,$chattername);
		while($chatterdetails = mysqli_fetch_array($chatternamequery)){
			$chatterfname = $chatterdetails[1];
			$chatterlname = $chatterdetails[2];	
			$chattermail = $chatterdetails[4];
		}
		$arr2 = array();
		array_push($arr2,$chatterfname,$chatterlname,$chatcontent,$chattermail);
		array_push($array,$arr2);
	}
	
	echo JSON_ENCODE($array);
	}
	
	
	
	
	if (isset($_POST['chat_clientcontent']) and isset($_POST['chatter_mail']) ){
	global $con;
	$mail = $_SESSION['user_email'];
	$con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
	$personmail = $_POST['chatter_mail'];	
	$chatcontent = $_POST['chat_clientcontent'];
	$insertchatpersons = "insert into chat(chat_sender, chat_receiver,chat_content) values('$mail','$personmail','$chatcontent')";
	$insertchatquery = mysqli_query($con,$insertchatpersons);
	$retrievechat = "select * from chat where (chat_sender = '$mail' and chat_receiver='$personmail') or (chat_sender = '$personmail' and chat_receiver='$mail')";
	$retrievechatquery = mysqli_query($con,$retrievechat);
	$array = array();
	while ($chatrow = mysqli_fetch_array($retrievechatquery)){
		$chatsender = $chatrow[1];
		$chatcontent =$chatrow[3];
		$chattername = "select * from users where user_email='$chatsender'";
		$chatternamequery = mysqli_query($con,$chattername);
		while($chatterdetails = mysqli_fetch_array($chatternamequery)){
			$chatterfname = $chatterdetails[1];
			$chatterlname = $chatterdetails[2];	
			$chattermail = $chatterdetails[4];
		}
	
	$arr2 = array();
		array_push($arr2,$chatterfname,$chatterlname,$chatcontent,$chattermail);
		array_push($array,$arr2);
	
	}
	echo JSON_ENCODE($array);
	}
	
	
?>	