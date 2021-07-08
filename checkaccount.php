<?php
	include "db.php";
	if(isset($_POST['idnumber'])){
	   $idnumber = mysqli_real_escape_string($con,$_POST['idnumber']);

	   $query = "select count(*) as cntEmail from alumni where ic_no='".$idnumber."'";

	   $result = mysqli_query($con,$query);
	   $responseidnumber = "Available";
	   if(mysqli_num_rows($result)){
		  $row = mysqli_fetch_array($result);

		  $count = $row['cntEmail'];

		  if($count > 0){
			  $responseidnumber = "Not Available";
		  }

	   }

	   echo $responseidnumber;
	   die;
	}

	if(isset($_POST['passportnumber'])){
	   $passport = mysqli_real_escape_string($con,$_POST['passportnumber']);

	   $query = "select count(*) as cntEmail from alumni where passport_no='".$passport."'";

	   $result = mysqli_query($con,$query);
	   $responsepassport = "Available";
	   if(mysqli_num_rows($result)){
		  $row = mysqli_fetch_array($result);

		  $count = $row['cntEmail'];

		  if($count > 0){
			  $responsepassport = "Not Available";
		  }

	   }

	   echo $responsepassport;
	   die;
	}

	if(isset($_POST['username'])){
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

	   echo $response;
	   die;
	}

	if(isset($_POST['email'])){
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

	   echo $responseemail;
	   die;
	}

	
?>