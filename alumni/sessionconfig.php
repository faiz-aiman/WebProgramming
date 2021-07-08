<?php // Initialize the session
session_start(); 

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
if ($_SESSION["usertype"]!='alumni') {
	header('Location: ../admin/');
	exit;
}

if ($_SESSION["status"]==0) {
	if(stripos($_SERVER['REQUEST_URI'], 'completeprofile.php')){
		
	}else if(stripos($_SERVER['HTTP_REFERER'], 'completeprofile.php')){
		
	}else{
		header('Location: completeprofile.php');
		exit;
	}
}
?>