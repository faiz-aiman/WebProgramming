<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>FSKTM Alumni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/icon" /><!-- Favicon of the system !DO NOT REMOVE!-->
    <!-- External styling -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
    <style>
        body {
            background-color: #e9e9ed;
        }

        #card {
            position: relative;
            width: 320px;
            display: block;
            text-align: center;
            font-family: Roboto, sans-serif;
        }

        #upper-side {
            padding: 2em;
            background-color: #273469;
            display: block;
            color: #fff;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        }

        .checkmark {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #fff;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            position: relative;
            margin: 0 auto 13px auto;
        }

        /*font-weight: lighter;
		  fill: #fff;
		  margin: -3.5em auto auto 20px;*/
        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #fff;
            fill: #273469;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;

        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #4bb71b;
            }
        }

        #status {
            font-weight: lighter;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1em;
            margin-top: -.2em;
            margin-bottom: 0;
        }

        #lower-side {
            padding: 2em 2em 1em 2em;
            background: #fff;
            display: block;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        #message {
            margin-top: -.5em;
            color: #757575;
            letter-spacing: 1px;
            text-align: left;
        }
    </style>
</head>

<body>
    <center><img src="../images/logo.png" style="width: 18%;margin: 40px auto 20px auto;" alt="logo" /></center>

    <?php
    //Add this file to open session for every file
    require("sessionconfig.php");
    //Add this file to use database for every file
    include("../db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION['id'];
        $title = $_POST['title'];
		if(!isset($_POST['firsttime'])){
			$username = $_POST['username'];
		}else{
        $username = $_SESSION['username'];}
		if(isset($_POST['icnum'])){
			$date = $_POST['icnum'];
		}else{
			$date = $_POST['date'];
		}
		$date = date("Y-m-d", strtotime($date));
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $religion = $_POST['religion'];
        $status = $_POST['status'];
        $phone = $_POST["phonenumber"];
        $address = $_POST['address'];
		$postcode = $_POST['postcode'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$verified = 1;
		$statusAcc = 1;
		$token = bin2hex(random_bytes(25));
		/*echo $username, ' ', $date, ' ', $email, ' ', $gender, ' ', $religion, ' ', $status, ' ', $phone, ' ', $address, ' ', $postcode, ' ', $state, ' ', $country, ' ', $id;*/
		if($email!=$_SESSION['email']){
			$update_alumni = $con->prepare("UPDATE `alumni` SET `email`=?, `username`=?, `verified`=?, `token`=? WHERE id=?");
			$update_alumni->bind_param('ssisi', $email, $username, $verified, $token, $id);
			$complete_alumni = $update_alumni->execute();
		}else{
			$update_alumni = $con->prepare("UPDATE `alumni` SET `username`=?,`status`=? WHERE id=?");
			$update_alumni->bind_param('sii', $username, $statusAcc, $id);
			$complete_alumni = $update_alumni->execute();
		}
		if(isset($_FILES['img'])){
			$targetDir = "../images/profileimg/";
			$fileName = $_FILES['img']['name'];
			$unique_file_name = time(). $_SERVER['REMOTE_ADDR']. $_FILES['img']['name']; 
			$targetFilePath = $targetDir;
			// Upload file to server
				if(move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath.$id.$unique_file_name)){
					// Insert image file name into database
					$insert = $con->query("UPDATE alumni_profile SET profile_pic='$fileName' WHERE alumni_id=$id");
				}else{
					echo "error";
				}
		}
        $update_alumni_profile = $con->prepare("UPDATE `alumni_profile` SET `title`=?, `birthdate`=?, `gender`=?, `religion`=?, `emp_status`=?, `phone_no`=?, `address`=?, `postcode`=?, `state`=?, `country`=? WHERE alumni_id=?");
        $update_alumni_profile->bind_param('ssssssssssi', $title, $date, $gender, $religion, $status, $phone, $address, $postcode, $state, $country, $id);
        $complete_alumni_profile = $update_alumni_profile->execute();

        if ($complete_alumni) {
			if($email!=$_SESSION['email']){
				$_SESSION['username']=$username;
				header("Location:../mailer/sendmail.php?changeemail=yes&token=$token");
			}else{
				if(isset($_POST['firsttime'])){
				header('Location:index.php#welcomeModal');
				$_SESSION["status"]=1;
				exit;	
				}else{
				header('Location:editprofile.php#successModal');
				exit;}
			}
        } else {
            header("refresh:6;url=editprofile.php");
            echo '<center><div id=\'card\' class="animated fadeIn">
                              <div id=\'upper-side\'>
                                        <svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
                                            <path fill="white"
                                                d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
                                        </svg>
                                  <h3 id=\'status\'>
                                  Error updating profile
                                </h3>
                              </div>
                              <div id=\'lower-side\'>
                                <p id=\'message\'>
                                  Error! <br><br>
                                  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="editprofile.php">click here</a></small>
                                </p>
                              </div>
                            </div></center>
                            <script>
                                var dots = window.setInterval( function() {
                                var wait = document.getElementById("loading-dots");
                                if ( wait.innerHTML.length > 3 ) 
                                    wait.innerHTML = "";
                                else 
                                    wait.innerHTML += ".";
                                }, 300);
                            </script>';
            exit;
        }
    }
    ?>

    <!-- SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    </script>
</body>

</html>