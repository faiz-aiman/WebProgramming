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
// Include database file
require_once "db.php";

 
// Define variables and initialize with empty values
$username = $_POST['usernameLogin'];
$password = $_POST['passwordLogin'];
$type = $_POST['type'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
 
// Processing form data when form is submitted

    // Validate credentials
    if(!empty($username) && !empty($password)){
		
	if($type!="admin"){
		$sql = "SELECT id, username, email, password, verified, status FROM alumni WHERE username = ?";
	}else{
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM admin WHERE username = ?";}
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){ 
					// Bind result variables
					if($type!="admin"){
                    	mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password, $verified, $status);
					}else{
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);}
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
							if($type!="admin"){
								if($verified==1){
									//For account pending
									echo ('<center><div id=\'card\' class="animated fadeIn">
										  <div id=\'upper-side\'>
											<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
														<path fill="white"
															d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
													</svg>
											  <h3 id=\'status\'>
											  Pending verification!
											</h3>
										  </div>
										  <div id=\'lower-side\'>
											<p id=\'message\'>
											  You are not verify your email yet... Please check your inbox/junk and click the link to verify. Once verified, you will be able to login.<br><br>
											  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html#loginModal">click here</a></small>
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
										</script>');
									header("refresh:20;url=index.html" );
									exit();
								}
							}
							session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
							$_SESSION["username"] = $username;
							$_SESSION["usertype"] = $type;
                            
                            // Redirect user to dashboard page
							if($type!="admin"){
								//create sql statement to get full name
								$_SESSION["status"] = $status;
								$stmt = $con->prepare("SELECT title, fullname FROM `alumni_profile` WHERE alumni_id=$id");
								$stmt->execute();
								$result = $stmt->get_result();
								$row = $result->fetch_assoc();
								$_SESSION["title"]=$row['title'];
								$_SESSION["fullname"]=$row["fullname"];
								$_SESSION["email"]=$email;
								//create new sql statement to record login info
								$stmt = $con->prepare("INSERT INTO alumni_login (alumni_id)
										VALUES (?)");
								$stmt->bind_param('s', $_SESSION["id"]); 
								$stmt->execute();
								header("location: alumni");
							}else{
								header("location: admin");}
                        } else{
                            // Password is not valid, display a generic error message
                             echo ('<center><div id=\'card\' class="animated fadeIn">
							  <div id=\'upper-side\'>
								<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
											<path fill="white"
												d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
										</svg>
								  <h3 id=\'status\'>
								  Invalid credentials!
								</h3>
							  </div>
							  <div id=\'lower-side\'>
								<p id=\'message\'>
								  Your password is invalid. If you forgot your password, please <a class-"li-modal" href="index.html#fpModal">reset</a>&nbsp;your password.<br><br>
								  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html#loginModal">click here</a></small>
								</p>
							  </div>
							</div></center>');
							header("refresh:6;url=index.html#loginModal" );
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    echo ('<center><div id=\'card\' class="animated fadeIn">
						  <div id=\'upper-side\'>
							<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
										<path fill="white"
											d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
									</svg>
							  <h3 id=\'status\'>
							  Invalid credentials!
							</h3>
						  </div>
						  <div id=\'lower-side\'>
							<p id=\'message\'>
							  Your username and/or status account is invalid.<br><br>
							  <small>Redirecting you back<span id="loading-dots"></span><br>or <a href="index.html#loginModal">click here</a></small>
							</p>
						  </div>
						</div></center>');
						header("refresh:4;url=index.html#loginModal" );
                }
            } else{
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
						header("refresh:10;url=index.html" );
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    
    // Close connection
    mysqli_close($con);
}
?>
		<!-- SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.js"></script>
		<script>
		$('.li-modal').on('click', function(e){
		  e.preventDefault();
		  $('#fpModal').modal('show').find('.modal-content').load($(this).attr('href'));
		});
		</script>
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