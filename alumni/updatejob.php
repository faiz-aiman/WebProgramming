<?php
    //Add this file to open session for every file
    require("sessionconfig.php");
    //Add this file to use database for every file
    include("../db.php");
    if(isset($_POST['id']))
    {
        $JobID = $_POST['id'];
        $JobTitle = $_POST['jobtitle'];
        $CompanyName = $_POST['companyname'];
		$country = $_POST['area'];
		$state = $_POST['state'];
        $Area = $state.', '.$country;
        $Description = $_POST['descriptionInfo'];
        $JobType = $_POST['jobstyle'];
        $Salary = $_POST['salary'];
        $ContactNo =  $_POST["full_phone"];
        $Email = $_POST['emailInfo'];
		$datestart = explode('/', $_POST['startdate']); 
		$datestart = $datestart[2].'-'.$datestart[1].'-'.$datestart[0];
		$datestart = date("Y-m-d", strtotime($datestart)).' '.date("H:i", strtotime($_POST['timestart']));
		$dateend = explode('/', $_POST['enddate']); 
		$dateend = $dateend[2].'-'.$dateend[1].'-'.$dateend[0];
		$dateend = date("Y-m-d", strtotime($dateend)).' '.date("H:i", strtotime($_POST['timeend']));
		/*echo $JobID,'<br>',$JobTitle,'<br>',$CompanyName,'<br>',$Area,'<br>',$Description,'<br>',$JobType,'<br>',$Salary; 
		echo '<br>',$ContactNo,'<br>',$datestart,'<br>',$dateend;*/
		if(!isset($_FILES['img'])||$_FILES['img']['name']==NULL){
			$query = "UPDATE `job` SET job_title='$JobTitle',company_name='$CompanyName',area='$Area',description='$Description',job_type='$JobType',salary='$Salary',start_date='$datestart',end_date='$dateend',contact_no='$ContactNo',email='$Email'WHERE id='".$JobID."'";
			$result = mysqli_query($con,$query);
			if($result){
				header('Location:editjob.php?GetID='.$JobID.'#successModal');
				exit();
			}
			else{
				header('Location:editjob.php?GetID='.$JobID.'&errorid=1#failModal');
				exit();
			}
		}else{
			$targetDir = "../images/job/";
			$fileName = $_FILES['img']['name'];
			$unique_file_name = time().$_SERVER['REMOTE_ADDR'].$_FILES['img']['name']; 
			$targetFilePath = $targetDir;
			// Upload file to server
			if(move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath.$id.$unique_file_name)){
				//Insert data into database
				$filesave=$id.$unique_file_name;
				echo $filesave;
				$query = "UPDATE `job` SET job_title='$JobTitle', company_name='$CompanyName', area='$Area', description='$Description', job_type='$JobType', salary='$Salary', start_date='$datestart', end_date='$dateend', contact_no='$ContactNo', email='$Email', job_pic='$filesave' WHERE id='".$JobID."'";
				$result = mysqli_query($con,$query);
					if($result){
						header('Location:editjob.php?GetID='.$JobID.'#successModal');
						exit();
					}
					else{
						header('Location:editjob.php?GetID='.$JobID.'&errorid=1#failModal');
						exit();
					}
			}else{
				header('Location:editjob.php?GetID='.$JobID.'&errorid=2#failModal');
				exit();
			}
		}
    }
    else
    {
        header("Location:managejob.php");
    }
?>