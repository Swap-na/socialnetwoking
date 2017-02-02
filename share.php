<!DOCTYPE HTML>
<html>
<?php
if(! $_SESSION['user_email']){
echo "<script>alert('please LOGIN FIRST!')";
}
include("includes/connection.php");
if (isset($_POST['statusbutton'])){
	global $con;
	$mail = $_SESSION['user_email'];
	$status = mysqli_real_escape_string($con,$_POST['setstatus']);
	$insertstatus = "update users set status='$status' where user_email='$mail'";
	$runinsertstatus = mysqli_query($con,"$insertstatus");
	
	}
if(isset($_FILES['imagebutton'])){
		
	  global $con;
	  $errors= array();
      $file_name = $_FILES['imagebutton']['name'];
      $file_size =$_FILES['imagebutton']['size'];
      $file_tmp =$_FILES['imagebutton']['tmp_name'];
      $file_type=$_FILES['imagebutton']['type'];
	  $file_image = "user/user_images/$file_name";
	  if($file_size > 2097152){
         $errors[]='File size must be exactely 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$file_image);
	  }
	  else{
         print_r($errors);
      }	 	  
	$mail = $_SESSION['user_email'];
	$userimage = "update users set user_image='$file_image' where user_email='$mail'";
	$runimage = mysqli_query($con,$userimage);
	
	}
if(isset($_FILES['postphotobutton'])){
	  global $con;
	  $errors= array();
	  global $con;
	 $file_name =$_FILES['postphotobutton']['name'];
      $file_size =$_FILES['postphotobutton']['size'];
      $file_tmp =$_FILES['postphotobutton']['tmp_name'];
      $file_type=$_FILES['postphotobutton']['type'];
	  $file_image = "user/postedimages/$file_name";
	  if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$file_image);
	  }
	  else{
         print_r($errors);
      }	 	  
	$mail = $_SESSION['user_email'];
	$userdetails = "select * from users where user_email = '$mail'";
	$userdetailsrow = mysqli_query($con,$userdetails);
	$posterdetails = mysqli_fetch_array($userdetailsrow);
	$posterfname = $posterdetails[1];
	
	$name = $posterfname;
	$posterimage = $posterdetails[7];
	$postdate = date("Y-m-d H:i:s");
	$postimage = "insert into posts(post_username,post_usermail,post_userimage,post_datetime,postedimage) values('$name','$mail','$posterimage','$postdate','$file_image')";
	$runpostimage = mysqli_query($con,$postimage);
		
	header("Location: home.php");
	die();
	}
 if(isset($_FILES['postvideobutton'])){
        $name = $_FILES['postvideobutton']['name'];
        $type = explode('.', $name);
        $type = end($type);
        $size = $_FILES['postvideobutton']['size'];
        $tmp = $_FILES['postvideobutton']['tmp_name'];    
		$file_video = "user/postedvideos/$name";
		move_uploaded_file($tmp, $file_video);
             
		$mail = $_SESSION['user_email'];
		$userdetails = "select * from users where user_email = '$mail'";
		$userdetailsrow = mysqli_query($con,$userdetails);
		$posterdetails = mysqli_fetch_array($userdetailsrow);
		$posterfname = $posterdetails[1];
		
		$name = $posterfname;
		$posterimage = $posterdetails[7];
		$postdate = date("Y-m-d H:i:s");
		$postvideo = "insert into posts(post_username,post_usermail,post_userimage,post_datetime,postedvideo) values('$name','$mail','$posterimage','$postdate','$file_video')";
		$runpostvideo = mysqli_query($con,$postvideo);
		
		header("Location: home.php");
			die();
		}
			
			
			 
        
		
			
	
if (isset($_POST['person_name']) and isset($_POST['post_content']) and isset($_POST['post_image']) and isset($_POST['post_mail'])){
	global $con;
	$mail = $_POST['post_mail'];
	$name = $_POST['person_name'];
	$postcontent = $_POST['post_content'];
	$postimage = $_POST['post_image'];
	$postdate = date("Y-m-d H:i:s");
	$insertpost = "insert into posts(post_username,post_usermail,post_userimage,post_datetime,post_content) values('$name','$mail','$postimage','$postdate','$postcontent')";
	$runinsertpost = mysqli_query($con,"$insertpost");
	
	
	}
	
	
	
	
	
	
	
 
  
?>
</html>