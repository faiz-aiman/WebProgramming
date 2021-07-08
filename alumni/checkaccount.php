<?php
	require('sessionconfig.php');
	include ("../db.php");

		if(isset($_POST['username'])){
			if($_POST['username']!=$_SESSION['username']){
			   $username = mysqli_real_escape_string($con,$_POST['username']);

			   $query = "select count(*) as cntUser from alumni where username='".$username."'";

			   $result = mysqli_query($con,$query);
			   $response = "Available";
			   if(mysqli_num_rows($result)){
				  $row = mysqli_fetch_array($result);
				  $count = $row['cntUser'];

				  if($count > 0){
					  $response = "Not Available";
				  }

			   }
		}else{
				$response = "Same";
			}
			
				echo $response;
			   	die;
		}

	if(isset($_POST['email'])){
		if($_POST['email']!=$_SESSION['email']){
	   $email = mysqli_real_escape_string($con,$_POST['email']);

	   $query = "select count(*) as cntEmail from alumni where email='".$email."'";

	   $result = mysqli_query($con,$query);
	   $responseemail = "Available";
	   if(mysqli_num_rows($result)){
		  $row = mysqli_fetch_array($result);

		  $count = $row['cntEmail'];

		  if($count > 0){
			  $responseemail = "Not Available";
		  }

	   }
	}else{
			$responseemail="Same";
		}

	   echo $responseemail;
		die;
	   exit();
	}

	
?>