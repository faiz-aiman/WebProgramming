<?php 
//Add this file to open session for every file
require("sessionconfig.php");
//Add this file to use database for every file
include("../db.php");
    $id = $_POST['id'];
	$stmt = $con->prepare('DELETE FROM event WHERE id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();
	if($stmt){
		echo $id;
		header('Location:editevent.php#successModal');
		exit();
	}else{
		header('Location:editevent.php#failModal');
		exit();
	}
?>