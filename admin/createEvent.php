<?php
//Add this file to open session for every file
require('sessionconfig.php');
//Add this file to use database for every file
include('../db.php');

if(isset($_POST['eventtitle'])){
	$datestart = explode('/', $_POST['startdateevent']); 
	$datestart = $datestart[2].'-'.$datestart[1].'-'.$datestart[0];
	$datestart = date("Y-m-d", strtotime($datestart)).' '.date("H:i", strtotime($_POST['timestart']));
	$dateend = explode('/', $_POST['enddateevent']); 
	$dateend = $dateend[2].'-'.$dateend[1].'-'.$dateend[0];
	$dateend = date("Y-m-d", strtotime($dateend)).' '.date("H:i", strtotime($_POST['timeend']));
	if(!isset($_FILES['img'])){
			$stmt = $con->prepare('INSERT INTO event (admin_id,title,date_start,date_end,category,venue,description) VALUES (?,?,?,?,?,?,?)');
			$stmt->bind_param('issssss',$_SESSION['id'],$_POST['eventtitle'],$datestart,$dateend,$_POST['category'],$_POST['eventvenue'],$_POST['eventdescription']);
			$stmt->execute();
			if($stmt){
				$query = "SELECT id from event ORDER BY id DESC LIMIT 1";
                $query_run = mysqli_query($con,$query);
				$data = mysqli_fetch_assoc($query_run);
				$dataid=$data['id'];
				$notification = $con->prepare('INSERT INTO notification (receiver_id,type,content_id) SELECT id, type, 1 FROM alumni WHERE STATUS=1');
				$notification->bind_param('isi',$dataid, 'event', 1);
				$notification->execute();
				header('Location:event.php#successModal');
				exit();
			}else{
				header('Location:event.php?errorid=1#failModal');
				exit();
			} 
	}else{
		$id=$_SESSION['id'];
		$targetDir = "../images/event/";
		$fileName = $_FILES['img']['name'];
		$unique_file_name = time(). $_SERVER['REMOTE_ADDR']. $_FILES['img']['name']; 
		$targetFilePath = $targetDir;
		// Upload file to server
		if(move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath.$id.$unique_file_name)){
			// Insert data into database
			$filesave=$id.$unique_file_name;
			$stmt = $con->prepare('INSERT INTO event (admin_id,title,date_start,date_end,category,venue,description,photo) VALUES (?,?,?,?,?,?,?,?)');
			$stmt->bind_param('isssssss',$_SESSION['id'],$_POST['eventtitle'],$datestart,$dateend,$_POST['category'],$_POST['eventvenue'],$_POST['eventdescription'],$filesave);
			$stmt->execute();
			if($stmt){
				$query = "SELECT id from event ORDER BY id DESC LIMIT 1";
                $query_run = mysqli_query($con,$query);
				$data = mysqli_fetch_assoc($query_run);
				$dataid=$data['id'];
				$content = 'event';
				$notification = $con->prepare('INSERT INTO notification (receiver_id,type,content_id) SELECT id, ?, ? FROM alumni WHERE STATUS=1');
				$notification->bind_param('si',$content, $dataid);
				$notification->execute();
				header('Location:event.php#successModal');
				exit();
			}else{
				header('Location:event.php?errorid=1#failModal');
				exit();
			} 
		}else{
			header('Location:event.php?errorid=2#failModal');
			exit();
		}
	}
}else{
	header('Location:event.php?errorid=3#failModal');
	exit();
}
?>