<?php
//Add this file to open session for every file
require("sessionconfig.php");
//Add this file to use database for every file
include("../db.php");

$recieverid = $_SESSION['id'];
$senderid = $_POST['senderID'];

if(isset($_POST['accept'])){
	$accept = $con->prepare("UPDATE friend_list SET approval_status=2, date_accepted=CURRENT_TIMESTAMP WHERE sender_id=$senderid AND receiver_id=$recieverid");
	$notify = $con->prepare("INSERT INTO `notification`(receiver_id, type, content_id, time) VALUES($senderid, 'acceptFriend', $recieverid, CURRENT_TIMESTAMP)");
	if (!$accept->execute()) {
		header("Location:friendRequest.php#failModal");
		exit;
	} else {
		$notify->execute();
		if($_SERVER['HTTP_REFERER']=='http://localhost/fsktmalumni/alumni/alumnidetail.php?alumniID='.$senderid.''){
		header('Location:'.$_SERVER['HTTP_REFERER'].'&removeID=2#successModal');
		}else if($_SERVER['HTTP_REFERER']== $_SERVER['HTTP_REFERER']){
		header('Location:http://localhost/fsktmalumni/alumni/friendRequest.php?removeID=2#successModal');
		}else{
		header('Location:'.$_SERVER['HTTP_REFERER'].'?removeID=2#successModal');
		}
		exit;
	}
}else if(isset($_POST['reject'])){
	$reject = $con->prepare("DELETE FROM `friend_list` WHERE sender_id=$senderid AND receiver_id=$recieverid");
	$notify = $con->prepare("INSERT INTO `notification`(receiver_id, type, content_id, time) VALUES($senderid, 'rejectFriend', $recieverid, CURRENT_TIMESTAMP)");
	if (!$reject->execute()) {
		if($_SERVER['HTTP_REFERER']=='http://localhost/fsktmalumni/alumni/alumnidetail.php?alumniID='.$senderid.''){
		header('Location:'.$_SERVER['HTTP_REFERER'].'#failModal');
		}else{
		header('Location:'.$_SERVER['HTTP_REFERER'].'#failModal');
		}
		exit;
	} else {
		$notify->execute();
		$notify->execute();
		if($_SERVER['HTTP_REFERER']=='alumnidetail.php?alumniID='.$senderid.''){
		header('Location:'.$_SERVER['HTTP_REFERER'].'&removeID=1#successModal');
		}else if($_SERVER['HTTP_REFERER']== $_SERVER['HTTP_REFERER']){
			header('Location:http://localhost/fsktmalumni/alumni/friendRequest.php?removeID=1#successModal');
		}else{
		header('Location:'.$_SERVER['HTTP_REFERER'].'?removeID=1#successModal');
		}
		exit;
	}
}else{
	header('Location:friendRequest.php');
	exit;
}

?>