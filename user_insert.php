<?php

//$con=mysqli_connect("localhost","root","","social_network")or die("Connectionwas not established");

include("includes/connection.php");
	if(isset($_POST['u_sub']))
	{
		mysqli_real_escape_string($con,$_POST['u_name']);
		
		$name=mysqli_real_escape_string($con,$_POST['u_name']);
		$pass=mysqli_real_escape_string($con,$_POST['u_pass']);
		$email=mysqli_real_escape_string($con,$_POST['u_mail']);
		$country=mysqli_real_escape_string($con,$_POST['u_country']);
		$gender=mysqli_real_escape_string($con,$_POST['u_gender']);
		$b_day=mysqli_real_escape_string($con,$_POST['u_birth']);
		
		$date=date("m-d-Y");
		$status="unverified";
		$post="No";
		
		
		$get_email="select * from users where user_email='$email'";
		$run_email=mysqli_query($con,$get_email);
		$check=mysqli_num_rows($run_email);
		
		
		if($check==1)
		{
			
			echo "<script>alert('Email already existed,Please choose another!')</script></h2>";
			exit();
		}
		
		
		
		if(strlen($pass)<8)
		{
			
			echo "<script>alert('Password must be minimum 8 characters!')</script></h2>";
			exit();
		}
		else
		{
			$insert="insert into users(user_name,user_pass,user_email,user_country,user_gender,user_b_day,user_image,register_date,last_login,status,posts) values('$name','$pass','$email','$country','$gender','$b_day','default.jpg',NOW(),NOW(),'$status','$post')";
			
			$run_insert=mysqli_query($con,$insert);
			
			
			if($run_insert)
		{
			$_SESSION['user_email']=$email;
			echo "<script>alert('Registration successful!')</script></h2>";
			echo "<script>window.open('home.php','_self')</script>";
			
			
			
		}
			
			
			
		}
		
		
		
		
	}




?>