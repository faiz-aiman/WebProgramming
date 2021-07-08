<?php 
//Add this file to use database for every file
include("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <title>FSKTM Alumni</title>
    <!-- Favicon of the system !DO NOT REMOVE!-->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/icon" />
    <!-- External styling -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- External styling ends -->
    <!-- To style modal function -->
    <link rel="stylesheet" href="../assets/css/lunar.css" />
    <!-- Main style css file for all content !DO NOT REMOVE! -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- To style table data -->
    <link rel="stylesheet" href="../assets/css/tablestyle.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .field-icon{
            float: right;
            margin-right: 15px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }
    </style>
    </head>
    <header>
        <!-- Navigation start -->
        <div class="topnav">
            <div class="infotopnav">
                <h5>Welcome!</h5>
            </div>
            <div class="btn-navbar">
                
            </div>
        </div>
    </header>
    <body>
		<?php
            $username = $_GET['username'];
            $token = $_GET['token'];
            $check_acc = $con->prepare("SELECT `token`, `username` FROM `alumni` WHERE `token` = '$token' AND `username` = '$username'");
            $check_acc->execute();
            $result = $check_acc->get_result();
            $valid = mysqli_num_rows($result);

            if ($valid < 1){
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
                                          Opsss.... your token have been expired! Please <a href="index.html#contact">contact</a> administrator. <br><br>
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
                header("refresh:6;url=../index.html");
                exit();
                }else{
                    //submit new password 
                   if(isset($_POST['submit'])){
                    $newpassword = $_POST['password'];
					$token = bin2hex(random_bytes(25));	
                    $newhash = password_hash($newpassword, PASSWORD_DEFAULT);
                    if ($update_password = $con->prepare("UPDATE `alumni` SET `password`=?, `token`=? WHERE username='$username'")) {
                        $update_password->bind_param('ss', $newhash, $token);
                        $update_password->execute();
                        header('Location:../index.html#successChangeModal');
                        exit;
                    }else{
                        header("refresh:8;url=../index.html" );
						echo '<center><div id=\'card\' class="animated fadeIn">
										  <div id=\'upper-side\'>
													<svg style="width: 100px; height: 100px;" viewBox="0 0 24 24">
														<path fill="white"
															d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
													</svg>
											  <h3 id=\'status\'>
											  Error!
											</h3>
										  </div>
										  <div id=\'lower-side\'>
											<p id=\'message\'>
											  Error in submitting your new password, please try again. <br><br>
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
                }
			
		?>

        
<div id="page">
        <!-- start of page content div -->
        <div class="row">
            <!-- Start row content -->
            <div class="container">
                <!-- Back to previous page button -->
                <div class="profile-area">
                    <!-- Start Feature Content -->
                    <h2 >Password Recovery</h2>
                    <div class="col">
                        <div class="row">
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="page-area">
                                            <!-- Start event information content -->
                                            <!-- Start form for the user profile -->
                                            <div class="tab-content pt-3">
                                                <div id="changePassword" class="tab-pane active">
                                                    <form class="register-form needs-validation" action="#succesModal" method="post" novalidate>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="password">New Password</label>
                                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required />
                                                                        <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        <div class="invalid-tooltip">
                                                                            Please enter a password between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="matchpassword">Confirm Password</label>
                                                                        <input type="password" class="form-control" id="matchpassword" name="matchpassword" placeholder="Password" autocomplete="off" required />
                                                                        <span toggle="#matchpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                                        <div class="invalid-tooltip">
                                                                            Those passwords didn’t match. Try again.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<div class="modal fade" id="passwordalertmessage" tabindex="-1" role="dialog" aria-labelledby="passwordalertmessage" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <div class="modal-body">
                                                                        <div class="px-3 pt-3 text-center">
                                                                            <div class="event-type warning">
                                                                                <div class="event-indicator">
                                                                                    <svg style="width: 60px; height: 60px;" viewBox="0 0 24 24">
                                                                                        <path fill="#000000" d="M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <br />
                                                                            <br />
                                                                            <h5>Are you sure to change?</h5>
                                                                            <p style="text-align: center;">This action cannot be undone.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-cstm-danger" type="submit" name="submit">Continue</button>
                                                                        <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#passwordalertmessage">Save Changes</button>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- form for the user ends -->
                        <!-- Modal for succesful to edit -->
                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                            aria-labelledby="successModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="modal-body">
                                        <div class="px-3 pt-3 text-center">
                                            <div class="event-type success">
                                                <div class="event-indicator">
                                                    <svg style="width: 60px; height: 60px;" viewBox="0 0 24 24">
                                                        <path fill="#ffffff"
                                                            d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <h4 class="pt-4">Your password has been changed successfully.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Both modal Ends -->
                        <!-- End Feature Content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of row content -->
    </div>
    <!-- End of page content div -->

        <!-- loader start -->
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="48px" height="48px">
                <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#FAFAFF" />
                <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#273469" />
            </svg>
        </div>
        <!-- loader ends -->

        <!-- Back to top function -->
        <a id="back2Top" title="Back to top" href="#">Back to top</a>
        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <!--For navigation animation-->
        <script src="../assets/js/imgpreview.js"></script>
        <!-- For load hold start page -->
        <script src="../assets/js/loader.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
        <script>$(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
		var hash = window.location.hash;
        if (hash == '#successModal') {
            setTimeout(function() {
                $(hash).modal('show');
            }, 500);
        };
        </script>
    </body>

    <!-- Site footer -->
    <footer>
        <div class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <p>Copyright &copy; 2021 Web Programming Project</p>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class="social-icons">
                            <li>
                                <a class="facebook" href="https://www.facebook.com/CARIAUM"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a class="twitter" href="https://twitter.com/unimalaya"><i class="fa fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends -->
</html>

