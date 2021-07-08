<?php 
//Add this file to open session for every file
require("sessionconfig.php");
//Add this file to use database for every file
include("../db.php");
?>
<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "DELETE FROM job WHERE id = $id";
    $query_run = $con->query($query);
    if($query_run){
        header('Location:managejob.php#successModal');
		exit();
    }else{
        header('Location:managejob.php#failModal');
		exit();
    }
}else{
	header('Location:managejob.php');
	exit();
}
?>