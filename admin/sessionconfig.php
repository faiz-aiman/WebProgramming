<?php // Initialize the session
session_start(); 
header("Cache-Control: no-store, no-cache, must-revalidate");
header ("Pragma: no-cache");
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
if ($_SESSION["usertype"]!='admin') {
	header('Location: ../alumni/');
	exit;
}
?>