<?php
//Add this file to open session for every file
require("sessionconfig.php");
//Add this file to use database for every file
include("../db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>FSKTM Alumni</title>
    <!-- Favicon of the system !DO NOT REMOVE!-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <!-- External styling -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- External styling ends -->
    <!-- To style modal function -->
    <link rel="stylesheet" href="../assets/css/lunar.css" />
    <!-- Main style css file for all content !DO NOT REMOVE! -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <style>
        .tooltip.top-left .tooltip-arrow {
            bottom: -5px;
            left: 5px;
            border-width: 5px 5px 0;
            border-top-color: black;
        }

        table {
            border-collapse: collapse;
            width: 63vw;
            border-spacing: 0;
        }

        td:nth-child(3n-2){
            width: 15%;
            text-align: right;
        }

        td:nth-child(3n-1){
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 10px;
        }
        
        td:nth-child(3n){
            width: 85%;
            text-align: left;
            padding-bottom: 9px;
            word-wrap: break-word;
			color: black;
			text-decoration: none;
        }
		
		td:nth-child(3n)>a{
			color: black;
			text-decoration: none;
        }
    </style>

</head>
<header>
    <!-- Navigation start -->
    <div class="topnav">
        <div class="infotopnav">
            <h5>Welcome, <?php echo $_SESSION['title'], '&nbsp;', $_SESSION['fullname'] ?>!</h5>
        </div>
        <div class="btn-navbar">
            <a href="../logout.php" class="btn btn-3">
                <span class="txt">Logout</span>
                <span class="round"><i class="fa fa-chevron-right"></i></span>
            </a>
        </div>
        <?php include("../notification.php") ?>
    </div>

    <nav id="bottomnav">
        <div class="bottomnav">
            <img src="../images/logo.png" alt="logo" />
            <div class="topBotomBordersIn">
                <a href="index.php">HOME</a>
                <a class="current" href="alumni.php">ALUMNI</a>
                <a href="job.php">JOBS</a>
                <a href="event.php">EVENT</a>
            </div>
        </div>
    </nav>
    <!-- Navigation ends -->
</header>

<body>
    <?php
    $userID = $_SESSION['id'];
    $alumniID = $_GET['alumniID'];
    $get_alumni = $con->prepare("SELECT `alumni`.`id`, `alumni`.`username`, `alumni`.`email`, `alumni_profile`.* FROM `alumni` LEFT JOIN `alumni_profile` ON `alumni_profile`.`alumni_id` = `alumni`.`id` WHERE `alumni`.`id`=$alumniID");
    $get_alumni->execute();
    $result = $get_alumni->get_result();
    $row_profile = $result->fetch_assoc();
    $degreeID = $row_profile['degree_id'];
    $majorID = $row_profile['major_id'];
    $get_course = $con->prepare("SELECT academic_level FROM academic WHERE id=$degreeID");
    $get_course->execute();
    $res_degree = $get_course->get_result();
    $row_degree = $res_degree->fetch_assoc();
    $get_major = $con->prepare("SELECT major FROM academic_major WHERE id=$majorID");
    $get_major->execute();
    $res_major = $get_major->get_result();
    $row_major = $res_major->fetch_assoc();
    $check_friend = $con->prepare("SELECT * FROM friend_list WHERE ((sender_id = $userID AND receiver_id = $alumniID) OR (sender_id = $alumniID AND receiver_id = $userID)) AND approval_status = 2");
    $check_friend->execute();
    $check_res = $check_friend->get_result();
    $valid = mysqli_num_rows($check_res);
    if ($row_profile['profile_pic'] == NULL) {
        $row_profile['profile_pic'] = 'default.png';
    }
    ?>
    <div id="page">
        <!-- start of page content div -->
        <div class="row">
            <!-- Start row content -->
            <div class="container">
                <!-- Back to previous page button -->
                <a class="btn btn-primary" href="alumni.php" style="margin-top: 10px;">&#60;&nbsp;back</a>
                <div class="profile-area">
					 <!-- Start Feature Content -->
                        <h2>Alumni Profile</h2> 
						<?php
							$friend_req = $con->prepare("SELECT * FROM friend_list WHERE ((sender_id = $id AND receiver_id = $alumniID) OR (sender_id = $alumniID AND receiver_id = $id)) AND approval_status=1");
							$friend_req->execute();
							$req_res = $friend_req->get_result();
							$countrow = $req_res -> num_rows;
							$rowdata = $req_res->fetch_array(MYSQLI_ASSOC);
							if($countrow>0){
								echo '<form action="acceptFriend.php" method="post">
									<input type="id" value="', $alumniID, '" name="senderID" hidden >
									<!-- Modal for warning admin from any action event -->
									<div class="modal fade" id="alertmessage', $row['sender_id'], '" tabindex="-1" role="dialog" aria-labelledby="alertmessage', $row['sender_id'], '" aria-hidden="true">
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
														<h5>Accept ', $row_profile['fullname'], ' friend request?</h5>
														<p style="text-align: center;">This action cannot be undone.</p>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" name="accept" class="btn btn-cstm-danger">Continue</button>
													<a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal for warning admin from any action event ends-->
									</form>
									<form action="acceptFriend.php" method="post">
									<input type="id" value="', $alumniID, '" name="senderID" hidden>
									<!-- Modal for warning admin from any action event -->
									<div class="modal fade" id="alertmessagereject', $row['sender_id'], '" tabindex="-1" role="dialog" aria-labelledby="alertmessagereject', $row['sender_id'], '" aria-hidden="true">
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
																<h5>Reject friend request from ', $row_profile['fullname'], '?</h5>
																<p style="text-align: center;">This action cannot be undone.</p>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" name="reject" class="btn btn-cstm-danger">Continue</button>
															<a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
														</div>
													</div>
												</div>
											</div>
											<!-- Modal for warning admin from any action event ends-->
									</form>
									
									<button class="btn btn-danger" data-toggle="modal" data-target="#alertmessagereject', $row['sender_id'],'" rel="tooltip" data-placement="top" title="This user sent you a friend request" style="float: right;display:inline;border: none;margin-left:5px;">Reject</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#alertmessage', $row['sender_id'], '" rel="tooltip" data-placement="top" title="This user sent you a friend request" style="float: right">Accept</button>';
							}
						?>
                        <div class="profile-grid-container">
                            <div class="profile-photo">
                                <img class="profile-photo-img img-fluid" src="../images/profileimg/<?= $row_profile['profile_pic'] ?>" alt="profile-photo" />
                            </div>

                            <div class="profile-basic">
                                <p class="profile-name-header" style="color: #fafaff;"><?= $row_profile['title'].' '.$row_profile['fullname'] ?></p>
                                <p class="profile-name-txt">@<?= $row_profile['username'] ?></p>
								<?php
									if ($row_profile['privacy_contact'] == 2) { //FOR EVERYONE
										echo '<p class="profile-contact-num"><i class="fa fa-lock">&nbsp;</i>', $row_profile['phone_no'], '</p>
											<p class="profile-email-add"><i class="fa fa-lock">&nbsp;</i>', $row_profile['email'], '</p>';
									} else if ($row_profile['privacy_contact'] == 1) { //FOR FRIEND ONLY
										if ($valid<1) { //CHECK FRIEND STATUS
											echo '<a class="profile-contact-num" rel="tooltip" data-placement="right" title="Friends only"><i class="fa fa-lock">&nbsp;</i>No phone number to show</a>';
											echo '<br><a class="profile-contact-num tooltip-wrapper" rel="tooltip" data-placement="right" title="Friends only"><i class="fa fa-lock">&nbsp;</i>No email to show</a>';
										} else {
											echo '<p class="profile-contact-num"><i class="fa fa-lock">&nbsp;</i>', $row_profile['phone_no'], '</p>
											<p class="profile-email-add"><i class="fa fa-lock">&nbsp;</i>', $row_profile['email'], '</p>';
										}
									} else { //FOR ME ONLY 
											echo '<a class="profile-contact-num" rel="tooltip" data-placement="right" title="Not shared"><i class="fa fa-lock">&nbsp;</i>No phone number to show</a>';
											echo '<br><a class="profile-contact-num" rel="tooltip" data-placement="right" title="Not shared"><i class="fa fa-lock">&nbsp;</i>No email to show</a>';
									}
								?>
                            </div>

                        <div class="profile-content">
                            <div id="profile-add" class="profile-detail">
                                <table>
                                    <tr>
                                        <td><label id="dob-label" class="profile-label">Date of Birth </label></td>
                                        <td> : </td>
                                        <?php
                                        if ($row_profile['privacy_dob'] == 2) { //FOR EVERYONE
                                            echo '<td><span id="dob" class="profile-info">', date("d/m/Y", strtotime($row_profile['birthdate'])), ' </span></td>';
                                        } else if ($row_profile['privacy_dob'] == 1) { //FOR FRIEND ONLY
                                            if ($valid < 1) { //CHECK FRIEND STATUS
                                                echo '<td><a id="dob" class="profile-info" rel="tooltip" data-placement="right" title="Friends only"><i class="fa fa-lock">&nbsp;</i>No date of birth to show </a></td>';
                                            } else {
                                                echo '<td><span id="dob" class="profile-info">', $row_profile['birthdate'], ' </span></td>';
                                            }
                                        } else { //FOR ME ONLY 
                                            echo '<td><a id="dob" class="profile-info" rel="tooltip" data-placement="right" title="Not shared"><i class="fa fa-lock">&nbsp;</i>No date of birth to show</a></td>';
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td><label id="gender-label" class="profile-label">Gender </label></td>
                                        <td> : </td>
                                        <td><span id="gender" class="profile-info"><?= $row_profile['gender'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label id="religion-label" class="profile-label">Religion </label></td>
                                        <td> : </td>
                                        <td><span id="religion" class="profile-info"><?= $row_profile['religion'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label id="status-label" class="profile-label">Status </label></td>
                                        <td> : </td>
                                        <?php
                                        if ($row_profile['privacy_status'] == 2) { //FOR EVERYONE
                                            echo '
                                        <td><span id="status" class="profile-info">', $row_profile['emp_status'], ' </span></td>';
                                        } else if ($row_profile['privacy_status'] == 1) { //FOR FRIEND ONLY
                                            if ($valid < 1) { //CHECK FRIEND STATUS
                                                echo '<td><a id="status" class="profile-info" rel="tooltip" data-placement="right" title="Friends only"><i class="fa fa-lock">&nbsp;</i>No status to show</a></td>';
                                            } else {
                                                echo '<td><span id="status" class="profile-info">', $row_profile['emp_status'], ' </span></td>';
                                            }
                                        } else { //FOR ME ONLY 
                                            echo '<td><a id="dob" class="profile-info" rel="tooltip" data-placement="right" title="Not shared"><i class="fa fa-lock">&nbsp;</i>No status to show</a></td>';
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td><label id="address-label" class="profile-label">Address </label>
                                        <td> : </td>
                                        <?php
                                        if ($row_profile['privacy_contact'] == 2) { //FOR EVERYONE
                                            echo '
											<td><span id="address-label" class="profile-info">', $row_profile['address'], ' </span></td>';
                                        } else if ($row_profile['privacy_contact'] == 1) { //FOR FRIEND ONLY
                                            if ($valid < 1) { //CHECK FRIEND STATUS
                                                echo '<td><a id="address-label" class="profile-info" rel="tooltip" data-placement="right" title="Friends only"><i class="fa fa-lock">&nbsp;</i>No address to show</a></td>';
                                            } else {
                                                echo '<td><span id="address-label" class="profile-info">', $row_profile['address'], ' </span></td>';
                                            }
                                        } else { //FOR ME ONLY 
                                            echo '<td><a id="address-label" class="profile-info" rel="tooltip" data-placement="right" title="Not shared"><i class="fa fa-lock">&nbsp;</i>No address to show</a></td>';
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>

                            <div id="profile-acad" class="profile-detail">
                                <table>
                                    <tr>
                                        <td><label id="course-label" class="profile-label">Course </label></td>
                                        <td> : </td>
                                        <td><span id="course" class="profile-info"><?= $row_degree['academic_level'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label id="major-label" class="profile-label">Major </label></td>
                                        <td> : </td>
                                        <td><span id="major" class="profile-info"><?= $row_major['major'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label id="regyear-label" class="profile-label">Registration Date </label></td>
                                        <td> : </td>
                                        <td><span id="regyear" class="profile-info"><?= date("d/m/Y", strtotime($row_profile['intake_year'])) ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><label id="gradyear-label" class="profile-label">Graduation Date </label></td>
                                        <td> : </td>
                                        <td><span id="gradyear" class="profile-info"><?= date("d/m/Y", strtotime($row_profile['graduate_year'])) ?></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				<!-- Modal -->
                        <!-- Modal start -->
                        <!-- Modal for successful from any action event -->
                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModal" aria-hidden="true">
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
                                                        <path fill="#ffffff" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <h4 class="pt-4"><?php if($_GET['removeID']==1){echo 'The request has been removed in your request list.';}else{echo 'The user successfully added in your friendlist.';} ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- Modal for failed to publish event -->
						<div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="failModal" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
											<h4 class="pt-4" style="color: red">Fail to reject. Please contact administrator.</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End for both modal -->
                <!-- End Feature Content -->
            </div>
            <!-- End of row content -->
        </div>
    </div>
    <!-- End of page content div -->

    <!-- Back to top function -->
    <a id="back2Top" title="Back to top" href="#">Back to top</a>
    <!-- SCRIPTS -->
   <script src="../assets/js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
    <!--For navigation animation-->
    <script src="../assets/js/lunar.js"></script>
    <!-- For modal design -->
    <script type="text/javascript" src="../assets/js/validator.js"></script>
    <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
    <!-- For back to top function -->
    <!-- For image preview -->
    <script src="../assets/js/imgpreview.js"></script>
    <script>
        $(function() {
            $("[rel='tooltip']").tooltip();
        });
	</script>
	<script>
        var hash = window.location.hash;
		if(hash == '#successModal') {
			setTimeout(function(){
			   $(hash).modal('show');
		   }, 500);
		}else if(hash == '#failModal') {
			setTimeout(function(){
			   $(hash).modal('show');
		   }, 500);
		}
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