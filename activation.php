<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>FSKTM Alumni</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/icon" /><!-- Favicon of the system !DO NOT REMOVE!-->
		<!-- External styling -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
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
	<center><img src="images/logo.png" style="width: 18%;margin: 40px auto 20px auto;" alt="logo" /></center>
	<?php
	include ('db.php');

	// Now we check if the data was submitted, isset() function will check if the data exists.
	if ((!isset($_POST['idnumber']) || !isset($_POST['passport'])) && !isset($_POST['username'], $_POST['email'], $_POST['password']))
	{
		if (!isset($_GET['token'], $_GET['username'])){
		// Could not get the data that should have been sent and redirecting back.
		echo '<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
										<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
											<path fill="white"
												d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
										</svg>
								  <h3 id=\'status\'>
								  Error 441
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Opsss.... Something went wrong! Please <a href="index.html#contact">contact</a> administrator. <br><br>
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
		header("refresh:6;url=index.html");
		exit();
		}
	}

	if (!isset($_GET['token'], $_GET['username']))
	{
		$checkalumni = $con->prepare('SELECT * FROM `alumni_list` WHERE id_no = ?');
		// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
		if (!isset($_POST['idnumber']))
		{
			$checkalumni->bind_param('s', $_POST['passportnumber']);
		}
		else
		{
			$checkalumni->bind_param('s', $_POST['idnumber']);
		}
		$checkalumni->execute();
		$checkalumni->store_result();
		// Store the result so we can check if the alumni exists in the database.
		if ($checkalumni->num_rows > 0)
		{
			// We need to check if the account with that username exists.
			if ($stmt = $con->prepare('SELECT * FROM `alumni` WHERE ic_no = ? OR passport_no = ? OR email = ? OR username = ?'))
			{
				// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
				$stmt->bind_param('ssss', $_POST['idnumber'], $_POST['passportnumber'], $_POST['email'], $_POST['username']);
				$stmt->execute();
				$stmt->store_result();
				// Store the result so we can check if the account exists in the database.
				if ($stmt->num_rows > 0)
				{
					// Username already exists
					echo '<center><div id=\'card\' class="animated fadeIn">
								  <div id=\'upper-side\'>
									<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
												<path fill="white"
													d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
											</svg>
									  <h3 id=\'status\'>
									  Account exist!
									</h3>
								  </div>
								  <div id=\'lower-side\'>
									<p id=\'message\'>
									  An account is already registered with your credentials. Please <a href="index.html#loginModal">log in</a>. <br><br>
									  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
									</p>
								  </div>
								</div></center>';
					header("refresh:10;url=index.html#loginModal");
					exit();
				}
				else
				{
					// Insert new account
					if (empty($_POST['passportnumber']))
					{
						if ($stmt = $con->prepare('INSERT INTO alumni (username, email, password, ic_no, verified, token) VALUES (?, ?, ?, ?, ?, ?)'))
						{
							$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
							$verified = 1;
							$token = bin2hex(random_bytes(25));
							$stmt->bind_param('ssssis', $_POST['username'], $_POST['email'], $password, $_POST['idnumber'], $verified, $token);
							$stmt->execute();
							$username = $_POST['username'];
							$email = $_POST['email'];
							header("Location:mailer/sendmail.php?username=$username&email=$email&token=$token");
						}
						else
						{
							// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
							echo '<center><div id=\'card\' class="animated fadeIn">
								  <div id=\'upper-side\'>
									<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
												<path fill="white"
													d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
											</svg>
									  <h3 id=\'status\'>
									  Error 442
									</h3>
								  </div>
								  <div id=\'lower-side\'>
									<p id=\'message\'>
									  Something went wrong! Please <a href="index.html#contact">contact</a> administrator. <br><br>
									  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
									</p>
								  </div>
								</div></center>';
							header("refresh:10;url=index.html#registerModal");
						}
					}
					else
					{
						if ($stmt = $con->prepare('INSERT INTO alumni (username, email, password, passport_no, verified, token) VALUES (?, ?, ?, ?, ?, ?)'))
						{
							$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
							$approvalstatus = 1;
							$token = bin2hex(random_bytes(50));
							$stmt->bind_param('ssssis', $_POST['username'], $_POST['email'], $password, $_POST['passportnumber'], $verified, $token);
							$stmt->execute();
							$username = $_POST['username'];
							$email = $_POST['email'];
							header("Location:mailer/sendmail.php?username=$username&email=$email&token=$token");
						}
						else
						{
							// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
							echo '<center><div id=\'card\' class="animated fadeIn">
								  <div id=\'upper-side\'>
									<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
												<path fill="white"
													d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
											</svg>
									  <h3 id=\'status\'>
									  Error 442
									</h3>
								  </div>
								  <div id=\'lower-side\'>
									<p id=\'message\'>
									  Something went wrong! Please <a href="index.html#contact">contact</a> administrator. <br><br>
									  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
									</p>
								  </div>
								</div></center>';
							header("refresh:10;url=index.html#registerModal");
						}

						$stmt->close();
					}
				}
			}
			else
			{
				// Something is wrong with the sql statement
				echo '<center><div id=\'card\' class="animated fadeIn">
								  <div id=\'upper-side\'>
									<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
												<path fill="white"
													d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
											</svg>
									  <h3 id=\'status\'>
									  Error 443
									</h3>
								  </div>
								  <div id=\'lower-side\'>
									<p id=\'message\'>
									  Something went wrong! Please <a href="index.html#contact">contact</a> administrator. <br><br>
									  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
									</p>
								  </div>
								</div></center>';
				header("refresh:10;url=index.html#registerModal");
			}
		}
		else
		{
			// Username already exists
			echo '<center><div id=\'card\' class="animated fadeIn">
						  <div id=\'upper-side\'>
							<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
										<path fill="white"
											d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
									</svg>
							  <h3 id=\'status\'>
							  We can\'t find you! 
							</h3>
						  </div>
						  <div id=\'lower-side\'>
							<p id=\'message\'>
							  You ID number is not in our system! If you are a new graduate, please wait until your graduation day.<br><br>
							  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
							</p>
						  </div>
						</div></center>';
			header("refresh:10;url=index.html");
			exit();
		}
	}
	else
	{
		//Email verification
		$token=$_GET['token'];
		$username=$_GET['username'];
		$checkverify = $con->prepare('SELECT id FROM alumni WHERE username = ? AND token = ?');
		$checkverify->bind_param('ss', $username, $token);
		$checkverify->execute();
		$checkverify->store_result();
		// Store the result so we can check if the alumni exists in the database.
		if ($checkverify->num_rows > 0)
		{
			$stmt = $con->prepare("SELECT `verified` FROM `alumni` WHERE token='$token'");
			$stmt->execute();
			if($result = $stmt->get_result()){
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$status = $row['verified'];
				if($status==2){
					echo '<center><div id=\'card\' class="animated fadeIn">
						  <div id=\'upper-side\'>
							<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
										<path fill="white"
											d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
									</svg>
							  <h3 id=\'status\'>
							  You have been verified!
							</h3>
						  </div>
						  <div id=\'lower-side\'>
							<p id=\'message\'>
							  We found you already verified your account. Please proceed to <a href="index.html#loginModal">login</a>.<br><br>
							  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
							</p>
						  </div>
						</div></center>';
						header("refresh:10;url=index.html");
					exit();
				}
			}
			$updateverify = $con->prepare('UPDATE alumni SET verified=2 WHERE username = ? AND token = ?');
			$updateverify->bind_param('ss', $username, $token);
			if ($updateverify->execute())
			{
				$stmt = $con->prepare("SELECT `id` FROM `alumni` WHERE token='$token'");
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$id = $row['id'];
				$getid = $con->prepare("SELECT `ic_no`, `passport_no` FROM `alumni` WHERE id='$id'");
				$getid->execute();
				$resultid = $getid->get_result();
				$rowid = $resultid->fetch_array(MYSQLI_ASSOC);
				$icnumber = $rowid['ic_no'];
				$passportnumber = $rowid['passport_no'];
				if(!isset($passportnumber)){
					$geteducation = $con->prepare("SELECT `name`, `registration_year`, `major`, `course`, `graduation_year` FROM `alumni_list` WHERE id_no='$icnumber'");
				}else{
					$geteducation = $con->prepare("SELECT `name`, `registration_year`, `major`, `course`, `graduation_year` FROM `alumni_list` WHERE passport_no='$passportnumber'");
				}
					$geteducation->execute();
					$resultgeteducation = $geteducation->get_result();
					$rowgeteducation = $resultgeteducation->fetch_array(MYSQLI_ASSOC);
					$name = $rowgeteducation['name'];
					$registrationyear = $rowgeteducation['registration_year'];
					$major = $rowgeteducation['major'];
					$course = $rowgeteducation['course'];
					$graduationyear = $rowgeteducation['graduation_year'];
					$stmtadd = $con->prepare("INSERT INTO `alumni_profile` (alumni_id, fullname, degree_id, major_id, intake_year, graduate_year) VALUES (?,?,?,?,?,?)");
					$stmtadd->bind_param('ssssss', $id, $name, $course, $major, $registrationyear, $graduationyear);
					$stmtadd->execute();
				echo '<center><div id=\'card\' class="animated fadeIn">
				  <div id=\'upper-side\'>
					<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
					  <h3 id=\'status\'>
					  Success
					</h3>
				  </div>
				  <div id=\'lower-side\'>
					<p id=\'message\'>
					  Congratulations&nbsp;';echo $_GET['username'];echo', you have been verified your email! You may login now. See you! <br><br>
					  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
					</p>
				  </div>
				</div></center>';
				header("refresh:10;url=index.html");
				exit();
			}else{
				echo '<center><div id=\'card\' class="animated fadeIn">
						  <div id=\'upper-side\'>
							<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
										<path fill="white"
											d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
									</svg>
							  <h3 id=\'status\'>
							  Error 443;
							</h3>
						  </div>
						  <div id=\'lower-side\'>
							<p id=\'message\'>
							  Something went wrong! Please <a href="index.html#contact">contact</a> administrator.<br><br>
							  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
							</p>
						  </div>
						</div></center>';
			header("refresh:10;url=index.html");
			exit();
			}
		}else
		{
			echo '<center><div id=\'card\' class="animated fadeIn">
						  <div id=\'upper-side\'>
							<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
										<path fill="white"
											d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
									</svg>
							  <h3 id=\'status\'>
							  We can\'t find you! 
							</h3>
						  </div>
						  <div id=\'lower-side\'>
							<p id=\'message\'>
							  Please check your URL. If issue persist, please <a href="index.html#contact">contact</a> administrator. <br><br>
							  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html">click here</a></small>
							</p>
						  </div>
						</div></center>';
			header("refresh:10;url=index.html");
			exit();
		}
	}

$con->close();

?>
		<!-- SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.js"></script>
		<script>
			var dots = window.setInterval( function() {
			var wait = document.getElementById("loading-dots");
			if ( wait.innerHTML.length > 3 ) 
				wait.innerHTML = "";
			else 
				wait.innerHTML += ".";
			}, 300);
		</script>
	</body>
</html>
