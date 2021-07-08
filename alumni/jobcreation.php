<?php
//Add this file to open session for every file
require('sessionconfig.php');
//Add this file to use database for every file
include('../db.php');

if(isset($_POST['jobtitle'])){
	$id=$_SESSION['id'];
	$phonenumber = '+'.$_POST['countryphone'].$_POST['phonenumber'];
	$phonenumber = str_replace(array(' ','-'), '', $phonenumber);
	$datestart = explode('/', $_POST['startdate']); 
	$datestart = $datestart[2].'-'.$datestart[1].'-'.$datestart[0];
	$datestart = date("Y-m-d", strtotime($datestart)).' '.date("H:i", strtotime($_POST['timestart']));
	$dateend = explode('/', $_POST['enddate']); 
	$dateend = $dateend[2].'-'.$dateend[1].'-'.$dateend[0];
	$dateend = date("Y-m-d", strtotime($dateend)).' '.date("H:i", strtotime($_POST['timeend']));
	$area = $_POST['state'].', '.$_POST['area'];
	if($_FILES['img']['name']!=NULL){
		$filename = $_FILES['img']['name'];
		$tempname = $_FILES['img']['tmp_name']; 
		$unique_file_name = time(). $_SERVER['REMOTE_ADDR']. $_FILES['img']['name']; 
		$targetDir = "../images/job/";
		$targetFilePath = $targetDir;
		if(move_uploaded_file($tempname, $targetFilePath.$id.$unique_file_name)){
			$filesave=$id.$unique_file_name;
			$stmt = $con->prepare('INSERT INTO job (alumni_id,job_title,company_name,area,description,job_type,salary,start_date,end_date,contact_no,email,job_pic) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
			$stmt->bind_param('isssssssssss',$id,$_POST['jobtitle'],$_POST['companyname'],$area,$_POST['descriptionInfo'],$_POST['jobstyle'],$_POST['salary'],$datestart,$dateend,$phonenumber,$_POST['email'],$filesave);
			$stmt->execute();
			if($stmt){
				header('Location:createjob.php#successModal');
				exit();
			  }else{
				header('Location:createjob.php?errorid=1#failModal');
				exit();
			}  
		}else{
			header('Location:createjob.php?errorid=2#failModal');
			exit();
		}
	}else{
		$stmt = $con->prepare('INSERT INTO job (alumni_id,job_title,company_name,area,description,job_type,salary,start_date,end_date,contact_no,email) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
		$stmt->bind_param('issssssssss',$id,$_POST['jobtitle'],$_POST['companyname'],$area,$_POST['descriptionInfo'],$_POST['jobstyle'],$_POST['salary'],$datestart,$dateend,$phonenumber,$_POST['email']);
		$stmt->execute();
		if($stmt){
			header('Location:createjob.php#successModal');
			exit();
	  	}else{
			header('Location:createjob.php?errorid=1#failModal');
			exit();
		}  
	}
}else{
	header($_SERVER["HTTP_REFERER"]);
	exit();
}
?>