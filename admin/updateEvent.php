<?php
//Add this file to open session for every file
require('sessionconfig.php');
//Add this file to use database for every file
include('../db.php');

if(isset($_POST['eventtitle'])){
	$id = $_POST['id'];
	$admin = $_SESSION['id'];
	$title = $_POST['eventtitle'];
	$category = $_POST['category'];
	$venue = $_POST['eventvenue'];
	$desc = $_POST['eventdescription'];
	$datestart = explode('/', $_POST['startdateevent']); 
	$datestart = $datestart[2].'-'.$datestart[1].'-'.$datestart[0];
	$datestart = date("Y-m-d", strtotime($datestart)).' '.date("H:i", strtotime($_POST['timestart']));
	$dateend = explode('/', $_POST['enddateevent']); 
	$dateend = $dateend[2].'-'.$dateend[1].'-'.$dateend[0];
	$dateend = date("Y-m-d", strtotime($dateend)).' '.date("H:i", strtotime($_POST['timeend']));
	if(!isset($_FILES['img'])||$_FILES['img']['name']==NULL){
			$stmt = $con->prepare('UPDATE event SET admin_id=?, title=?, date_start=?, date_end=?, category=?, venue=?, description=? WHERE id=?');
			$stmt->bind_param('sssssssi',$admin,$title,$datestart,$dateend,$category,$venue,$desc,$id);
			$stmt->execute();
			if($stmt){
				header('Location:eventprofile.php?edit='.$id.'#successModal');
				exit();
			}else{
				header('Location:eventprofile.php?edit='.$id.'&errorid=1#failModal');
				exit();
			} 
	}else{
		$targetDir = "../images/event/";
		$fileName = $_FILES['img']['name'];
		$unique_file_name = time().$_SERVER['REMOTE_ADDR'].$_FILES['img']['name']; 
		$targetFilePath = $targetDir;
		// Upload file to server
		if(move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath.$id.$unique_file_name)){
			//Insert data into database
			$filesave=$id.$unique_file_name;
			$stmt = $con->prepare('UPDATE event SET admin_id=?, title=?, date_start=?, date_end=?, category=?, venue=?, description=? , photo=? WHERE id=?');
			$stmt->bind_param('ssssssssi',$admin,$title,$datestart,$dateend,$category,$venue,$desc,$filesave,$id);
			$stmt->execute();
			if($stmt){
				header('Location:eventprofile.php?edit='.$id.'#successModal');
				exit();
			}else{
				header('Location:eventprofile.php?edit='.$id.'&errorid=1#failModal');
				exit();
			} 
		}else{
			header('Location:eventprofile.php?edit='.$id.'&errorid=2#failModal');
			exit();
		}
	}
}else{
	header('Location:eventprofile.php?edit='.$id.'&errorid=3#failModal');
	exit();
}
?>