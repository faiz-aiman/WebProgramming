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
		body{
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
			0%, 100% {
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
				use PHPMailer\PHPMailer\PHPMailer; 
				use PHPMailer\PHPMailer\Exception; 
			if(isset($_GET['changeemail'])){
				require 'vendor/autoload.php';
				require_once('../alumni/sessionconfig.php');
				$mail = new PHPMailer;
				$token = $_GET['token'];
				$fname = $_SESSION['username'];
				//$toemail = $_SESSION['email'];
				$reply="You have changed your email!<br>please verify your new email.<br><br><a href=\"localhost/fsktmalumni/activation.php?token=$token&username=$fname\" class=\"btn btn-primary\">Verify now!</a><br><small>or copy and paste to your browser: localhost/fsktmalumni/activation.php?token=$token&username=$fname</small>";
				$toemail = 'faridadli14@gmail.com';
				$subject = "Verify your email";
				$message = $reply;
				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'noreply.fsktmalumni@gmail.com';          // SMTP username
				$mail->Password = 'Fsktm123'; // SMTP password
				$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                          // TCP port to connect to
				$mail->setFrom('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addReplyTo('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addAddress($toemail);   // Add a recipient
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent=$message;

				$mail->Subject =$subject;
				$bodyContent = 'Dear '.$fname.',<br>';
				$bodyContent .='<p>Greetings from the FSKTM Team,<br><br>'.$reply.'</p>';
				$bodyContent .='<br><i>Do not reply to this email. If you need further assistance, kindly reach out to us via <a href="localhost/fsktmalumni/#contact">feedback form</a>.</i><br><br>Best regards, <br>FSKTM Support';
				$mail->Body = $bodyContent;
				if($mail->send()){
						require_once("../db.php");
						$adddate = $con->prepare("UPDATE `alumni` SET `date_email` = ? WHERE `username` = ?");
						$date = date('Y-m-d');
						$adddate->bind_param('ss', $date,$fname);
						$adddate->execute();
						$adddate->close();
						header("refresh:20;url=../logout.php");
						echo '<center><div id=\'card\' class="animated fadeIn">
                              <div id=\'upper-side\'>
                                        <svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
                                            <path fill="white"
                                                d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
                                        </svg>
                                  <h3 id=\'status\'>
                                  You changed your email!
                                </h3>
                              </div>
                              <div id=\'lower-side\'>
                                <p id=\'message\'>
                                  You will automatically logout and receive an email for email verification. Please verify your email to login.<br><br>
                                  <small>Redirecting you logout<span id="loading-dots"></span><br>or <a href="../logout.php">click here</a></small>
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
				}else{
					echo '<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
										<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
											<path fill="white"
												d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
										</svg>
								  <h3 id=\'status\'>
								  Mailer Error: ',$mail->ErrorInfo,'
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Error! <br><br>
								  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
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
				}
				
			}
			if(isset($_GET['admin'])){
				require 'vendor/autoload.php';
				require_once('../admin/sessionconfig.php');
				$mail = new PHPMailer;
				$token = $_GET['token'];
				$fname = $_GET['usernameadmin'];
				//$toemail = $_GET['emailadmin'];
				$reply="You have changed your email!<br>please verify your new email.<br><br><a href=\"localhost/fsktmalumni/activation.php?token=$token&username=$fname\" class=\"btn btn-primary\">Verify now!</a><br><small>or copy and paste to your browser: localhost/fsktmalumni/activation.php?token=$token&username=$fname</small>";
				$toemail = 'faridadli14@gmail.com';
				$subject = "Verify your email";
				$message = $reply;
				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'noreply.fsktmalumni@gmail.com';          // SMTP username
				$mail->Password = 'Fsktm123'; // SMTP password
				$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                          // TCP port to connect to
				$mail->setFrom('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addReplyTo('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addAddress($toemail);   // Add a recipient
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent=$message;

				$mail->Subject =$subject;
				$bodyContent = 'Dear '.$fname.',<br>';
				$bodyContent .='<p>Greetings from the FSKTM Team,<br><br>'.$reply.'</p>';
				$bodyContent .='<br><i>Do not reply to this email. If you need further assistance, kindly reach out to us via <a href="localhost/fsktmalumni/#contact">feedback form</a>.</i><br><br>Best regards, <br>FSKTM Support';
				$mail->Body = $bodyContent;
				if($mail->send()){
						require_once("../db.php");
						$adddate = $con->prepare("UPDATE `alumni` SET `date_email` = ? WHERE `username` = ?");
						$date = date('Y-m-d');
						$adddate->bind_param('ss', $date,$fname);
						$adddate->execute();
						$adddate->close();
						header('Location:../admin/edituser.php#successModal');
            			exit;
				}else{
					echo '<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
										<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
											<path fill="white"
												d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
										</svg>
								  <h3 id=\'status\'>
								  Mailer Error: ',$mail->ErrorInfo,'
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Error! <br><br>
								  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
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
				}
				
			}
			if(isset($_GET['username'])||isset($_POST['username'])){

				require 'vendor/autoload.php';

				$mail = new PHPMailer;
				if(isset($_GET['username'])){
				$token = $_GET['token'];
				$fname = $_GET['username'];
				//$toemail = $_GET['email'];
				$reply="Thank you for your interest in FSKTM Alumni!<br>We are excited to see you. But, before you start login, please verify your email.<br><br><a href=\"localhost/fsktmalumni/activation.php?token=$token&username=$fname\" class=\"btn btn-primary\">Verify now!</a><br><small>or copy and paste to your browser: localhost/fsktmalumni/activation.php?token=$token&username=$fname</small>";
				}else{
				$token = $_POST['token'];;
				$fname = $_POST['username'];
				//$toemail = $_POST['email'];
				$reply="It's great to have you onboard. But, we noticed that you have not verified your email yet, please verify your email.<br><br><a href=\"localhost/fsktmalumni/activation.php?token=$token&username=$fname\" class=\"btn btn-primary\">Verify now!</a><br><small>or copy and paste to your browser: localhost/fsktmalumni/activation.php?token=$token&username=$fname</small>";
				}
				$toemail = 'aifanshahran@gmail.com';
				$subject = "Welcome to FSKTM Alumni";
				$message = $reply;
				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'noreply.fsktmalumni@gmail.com';          // SMTP username
				$mail->Password = 'Fsktm123'; // SMTP password
				$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                          // TCP port to connect to
				$mail->setFrom('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addReplyTo('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addAddress($toemail);   // Add a recipient
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent=$message;

				$mail->Subject =$subject;
				$bodyContent = 'Dear '.$fname.',<br>';
				$bodyContent .='<p>Greetings from the FSKTM Team,<br><br>'.$reply.'</p>';
				$bodyContent .='<br><i>Do not reply to this email. If you need further assistance, kindly reach out to us via <a href="localhost/fsktmalumni/#contact">feedback form</a>.</i><br><br>Best regards, <br>FSKTM Support';
				$mail->Body = $bodyContent;

				if(!$mail->send()) {
					if(isset($_GET['username'])){
						echo '<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
										<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
											<path fill="white"
												d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
										</svg>
								  <h3 id=\'status\'>
								  Mailer Error: ',$mail->ErrorInfo,'
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Error! <br><br>
								  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
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
					}else{
						header("Location:../admin/manageuser.php#errorModal");
					}
					
				}else{
					if(isset($_GET['username'])){
						echo '<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
								<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
								  <h3 id=\'status\'>
								  Success
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Congratulations&nbsp;';echo $_GET['username'];echo', we have received your information. You will receive an email for email verification. Please verify your email before login. <br><br>
								  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="../index.html">click here</a></small>
								</p>
							  </div>
							</div></center>';
							header("refresh:20;url=../index.html");
							exit();
					}else{
						require_once("../db.php");
						$adddate = $con->prepare("UPDATE `alumni` SET `date_email` = ? WHERE `username` = ?");
						$date = date('Y-m-d');
						$adddate->bind_param('ss', $date,$fname);
						$adddate->execute();
						$adddate->close();
						header("Location:../admin/manageuser.php#successModal");
						exit();
					}
				}
			}
			
			if(isset($_POST['name'])){
			//Add this file to open session for every file
			require("../admin/sessionconfig.php");

			require 'vendor/autoload.php';

			$mail = new PHPMailer;
			// getting post values
			$fname=$_POST['name'];		
			$reply=$_POST['reply'];
			$id=$_POST['id'];
			//$toemail = $_POST['email'];
			$toemail = 'aifanshahran@gmail.com';
			$subject = "Reply from FSKTM Support";
			$message = $reply;
			$mail->isSMTP();                            // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                     // Enable SMTP authentication
			$mail->Username = 'noreply.fsktmalumni@gmail.com';          // SMTP username
			$mail->Password = 'Fsktm123'; // SMTP password
			$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                          // TCP port to connect to
			$mail->setFrom('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
			$mail->addReplyTo('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
			$mail->addAddress($toemail);   // Add a recipient
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			$mail->isHTML(true);  // Set email format to HTML

			$bodyContent=$message;

			$mail->Subject =$subject;
			$bodyContent = 'Dear '.$fname.',<br>';
			$bodyContent .='<p>Greetings from the FSKTM Support Team,<br><br>'.$reply.'</p>';
			$bodyContent .='<br><i>Do not reply to this email. If you need further assistance, kindly reach out to us via <a href="localhost/fsktmalumni/#contact">feedback form</a>.</i><br><br>Best regards, <br>FSKTM Support';
			$mail->Body = $bodyContent;

			if(!$mail->send()) {
				echo '<center><div id=\'card\' class="animated fadeIn">
						  <div id=\'upper-side\'>
									<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
										<path fill="white"
											d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
									</svg>
							  <h3 id=\'status\'>
							  Mailer Error: ',$mail->ErrorInfo,'
							</h3>
						  </div>
						  <div id=\'lower-side\'>
							<p id=\'message\'>
							  Error! <br><br>
							  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
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
				header("refresh:6;url=../admin/feedbackdetails.php?reportID=$id" );
				exit;
			} else {
				require_once('../db.php');
				$stmt = $con->prepare("UPDATE `feedback` SET `readstatus` = '1' WHERE `feedback`.`id` = $id");
				$stmt->execute();
				header('Location: ../admin/feedback.php#successModal');
				exit;
			}
			}
		
			if(isset($_GET['forgotpassword'])){
				require 'vendor/autoload.php';
				$mail = new PHPMailer;
				$token = $_GET['tokenforgotpassword'];
				$fname = $_GET['usernameforgotpassword'];
				//$toemail = $_GET['emailforgotpassword'];
				$reply="You request to change your password!<br><a href=\"localhost/fsktmalumni/alumni/updateForgotPassword.php?token=$token&username=$fname\" class=\"btn btn-primary\">Verify now!</a><br><small>or copy and paste to your browser: localhost/fsktmalumni/alumni/updateForgotPassword.php?token=$token&username=$fname</small>";
				$toemail = 'faridadli14@gmail.com';
				$subject = "Change your password";
				$message = $reply;
				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'noreply.fsktmalumni@gmail.com';          // SMTP username
				$mail->Password = 'Fsktm123'; // SMTP password
				$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                          // TCP port to connect to
				$mail->setFrom('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addReplyTo('noreply.fsktmalumni@gmail.com', 'FSKTM Support');
				$mail->addAddress($toemail);   // Add a recipient
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent=$message;

				$mail->Subject =$subject;
				$bodyContent = 'Dear '.$fname.',<br>';
				$bodyContent .='<p>Greetings from the FSKTM Team,<br><br>'.$reply.'</p>';
				$bodyContent .='<br><i>Do not reply to this email. If you need further assistance, kindly reach out to us via <a href="localhost/fsktmalumni/#contact">feedback form</a>.</i><br><br>Best regards, <br>FSKTM Support';
				$mail->Body = $bodyContent;
				if($mail->send()){
						require_once("../db.php");
						$adddate = $con->prepare("UPDATE `alumni` SET `date_email` = ?, `token` = ? WHERE `username` = ?");
						$date = date('Y-m-d');
						$adddate->bind_param('sss', $date,$token,$fname);
						$adddate->execute();
						$adddate->close();
						header('Location:../index.html#successModal');
            			exit;
				}else{
					echo '<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
										<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
											<path fill="white"
												d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
										</svg>
								  <h3 id=\'status\'>
								  Mailer Error: ',$mail->ErrorInfo,'
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Error! <br><br>
								  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
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
				}
				
			}
		
		?>
		
		<!-- SCRIPTS -->
			<script src="../assets/js/bootstrap.min.js"></script>
			<script src="../assets/js/jquery.js"></script>
			</script>
	</body>
</html>