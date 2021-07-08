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
        <!-- To style table data -->
        <link rel="stylesheet" href="../assets/css/tablestyle.css" />
        <!-- For rich HTML input -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
    </head>
    <header>
        <!-- Navigation start -->
        <div class="topnav">
            <div class="infotopnav">
                <h5>Welcome, <?php echo $_SESSION['username']?>!</h5>
            </div>
            <div class="btn-navbar">
                <a href="../logout.php" class="btn btn-3">
                    <span class="txt">Logout</span>
                    <span class="round"><i class="fa fa-chevron-right"></i></span>
                </a>
            </div>
        </div>

        <nav id="bottomnav">
            <div class="bottomnav">
                <img src="../images/logo.png" alt="logo" />
                <div class="topBotomBordersIn">
                    <a  href="index.php">HOME</a>
					<a href="manageuser.php">MANAGE USER</a>
                    <a class="current" href="#">EVENT</a>
					<a href="feedback.php">FEEDBACK</a>
                </div>
            </div>
        </nav>
        <!-- Navigation ends -->
    </header>

    <body>
	<!--Get Event data to form-->
    <?php
    $update_id = $_GET['edit'];
    $updatequery = "SELECT * FROM event WHERE id='$update_id'";
    $updatequery_run = mysqli_query($con,$updatequery);

   	$data = mysqli_fetch_assoc($updatequery_run);
	$date_start = date_create($data['date_start']);
	$date_end = date_create($data['date_end']);
	$difference=date_diff($date_start,$date_end);
	$start_date = date_format($date_start, "j F Y (l)");
	$end_date = date_format($date_end, "j F Y (l)");
	$start_time = date_format($date_start, "g:i A");
    $end_time = date_format($date_end, "g:i A");
        $day = $difference->format("%a");
        $hour = $difference->format("%h");
        if($day>=1){
            $date = $start_date.' - '.$end_date;
            
            if($day == 1){
                $time = $day.' Day ';
            }else{
                $time = $day.' Days ';
            }

            if($hour == 1){
                $time = $time.$hour.' Hour';
            }else if($hour>0){
                $time = $time.$hour.' Hours';
            }
        }
        else{
            $date = $start_date;
            $time = $start_time.' - '.$end_time;
        }
    ?>
        <div id="page">
            <!-- start of page content div -->
            <div class="row">
                <!-- Start row content -->
                <div class="container">
                    <!-- Back to previous page button -->
                    <a class="btn btn-primary" href="editevent.php" style="margin-top: 10px">&#60;&nbsp;back</a>
                    <div class="profile-area">
                        <!-- Start Feature Content -->
                        <h2>Event Details</h2>
                        <div class="col">
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="e-profile">
                                                <div class="row">
                                                    <!-- Start Header Feature Content -->
                                                    <div class="col-12 col-sm-auto mb-3">
                                                        <div class="mx-auto" style="width: 140px;">
                                                            <img
                                                                src="../images/event/<?php echo $data['photo'];?>"
                                                                class="img-thumbnail d-flex justify-content-center align-items-center rounded"
                                                                style="height: 140px; width: 140px; background-color: rgb(233, 236, 239);"
                                                                alt="logoicon" id="preview" 
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $data['title'];?></h4>
                                                            <p class="mb-0"><?php echo $date ?></p>
															<p class="mb-0"><?php echo $time ?></p>
                                                            <div class="mt-2">
															<form action="updateEvent.php" method="post" enctype="multipart/form-data">
																<div class="form-group">
																	<input type="file" name="img" class="file" accept="image/jpeg, image/png" value="<?php echo $data['photo'];?>" />
																	<div class="input-group my-3">
																		<div class="input-group-append">
																			<button type="button" class="browse btn btn-primary"><i class="fa fa-fw fa-camera"></i>&nbsp;Change Photo</button>
																		</div>
																	</div>
																</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <!-- Header Feature Content ends -->
                                                <!-- Start event information content -->
                                                <!-- Start form for the event -->
                                                
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label><strong>&#42;Event title: </strong></label>
																		<input type="text" name="id" value="<?php echo $update_id ?>" hidden>
                                                                        <input class="form-control" type="text" id="eventtitle" name="eventtitle" value="<?php echo $data['title'] ?>" maxlength="60" required/><div id="counter" style="float: right"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
															 <div class="row">
															<div class="col">
																<div class="form-group">
																	<label><strong>&#42;Start Date: </strong></label>
																	<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="startdateevent" name="startdateevent" readonly="readonly" placeholder="DD/MM/YYYY" autocomplete="off" value="<?php echo date("d/m/Y", strtotime($data['date_start']));?>" required/>
																</div>
															</div>
															<div class="col">
																<div class="form-group">
																	<label><strong>&#42;Time Start: </strong></label>
																	<input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timestart" value="<?php echo $start_time?>" required/>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<label style="padding-left: 10px;"><strong>&#42;End Date: </strong></label>
																	<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="enddateevent" name="enddateevent" placeholder="DD/MM/YYYY" value="<?php echo date("d/m/Y", strtotime($data['date_end']));?>" readonly="readonly" required/>
																</div>
															</div>
															<div class="col">
																<div class="form-group">
																	<label style="padding-left: 10px;"><strong>&#42;Time End: </strong></label>
																	<input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timeend" value="<?php echo $end_time?>" required/>
																</div>
															</div>
														</div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label style="float: left; margin-top: 3px;"><strong>&#42;Category:</strong></label>
                                                                        <select class="custom-select col-sm-10 float-right" id="category" name="category" required>
                                                                            <option value="All" disabled>- Any -</option>
                                                                            <option value="Arts" <?php if ($data['category'] == "Arts") echo 'selected="selected"'; ?>>Arts</option>
																			<option value="Athletic" <?php if ($data['category'] == "Athletic") echo 'selected="selected"'; ?>>Athletics</option>
																			<option value="Career Networking" <?php if ($data['category'] == "Career Networking") echo 'selected="selected"'; ?>>Career Networking</option>
																			<option value="Faculty" <?php if ($data['category'] == "Faculty") echo 'selected="selected"'; ?>>Faculty</option>
																			<option value="Lecture/Reading/Talk" <?php if ($data['category'] == "Lecture/Reading/Talk") echo 'selected="selected"'; ?>>Lecture/Reading/Talk</option>
																			<option value="Reunion" <?php if ($data['category'] == "Reunion") echo 'selected="selected"'; ?>>Reunion</option>
																			<option value="Social" <?php if ($data['category'] == "Social") echo 'selected="selected"'; ?>>Social</option>
																			<option value="Student Engagement" <?php if ($data['category'] == "Student Engagement") echo 'selected="selected"'; ?>>Student Engagement</option>
																			<option value="Tour" <?php if ($data['category'] == "Tour") echo 'selected="selected"'; ?>>Tour</option>
																			<option value="Virtual" <?php if ($data['category'] == "Virtual") echo 'selected="selected"'; ?>>Virtual</option>
																			<option value="Volunteer" <?php if ($data['category'] == "Volunteer") echo 'selected="selected"'; ?>>Volunteer Opportunity</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <br />
                                                                        <label><strong>Venue:</strong></label>
                                                                        <textarea class="form-control" type="text" name="eventvenue" required><?= $data['venue']?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label><strong>Event description: </strong></label>
																		<textarea class="form-control" style="height: 200px;" name="eventdescription" required><?= $data['description'] ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                <!-- form for the ends -->
                                                <!-- Modal start -->
                                                <!-- Modal for alert to publish event -->
                                                <div class="modal fade" id="alertmessage" tabindex="-1" role="dialog" aria-labelledby="alertmessage" aria-hidden="true">
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
                                                                    
                                                                    <h5>Are you sure to modify this event?</h5>
                                                                    <p style="text-align: center;">This action cannot be undone.</p>
                                                                </div>
																<small style="color: red;float: left;padding-left: 10px;padding-right: 10px;">REMINDER: &#40;&#42;&#41; is required input.<br> You can't submit until you fill in the required input. </small>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="submit" class="btn btn-cstm-danger">Continue</button>
                                                                <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- End while loop -->
                                                <!-- Modal for succesful to publish event -->
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
                                                                    <h4 class="pt-4">This event has been modified.</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Both Modal Ends -->
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
																	<h4 class="pt-4" style="color: red"><?php if(isset($_GET['errorid'])){if($_GET['errorid']==1){echo 'Fail to insert your data.';}else if($_GET['errorid']==2){echo 'Sorry, there was an error uploading your file.';}}else{echo 'There\'s nothing to submit. Please fill in the form!';}?></h4>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Both Modal Ends -->
                                                <button class="btn btn-success float-right" data-toggle="modal" data-target="#alertmessage">Publish</button>
                                                <!-- Event information content ends -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Feature Content End-->
                    </div>
                </div>
            </div>
            <!-- End of row content -->
        </div>
        <!-- End of page content div -->

        <!-- Back to top function -->
        <a id="back2Top" title="Back to top" href="#">Back to top</a>
        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
        <!--For navigation animation-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!-- For modal design -->
        <script src="../assets/js/lunar.js"></script>
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <!-- For back to top function -->
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For table sticky header -->
        <script src="../assets/js/jquery.stickyheader.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
        <!-- End table sticky header -->
        <script src="https://unpkg.com/tiny-editor/dist/bundle.js"></script>
		<!-- For image preview -->
		<script src="../assets/js/datepicker.js"></script>
		<script src="../assets/js/imgpreview.js"></script>
		<script>
				$(".datepicker").datepicker({
					dateFormat: "dd/mm/yy",
					changeMonth: true,
					changeYear: true,
					minDate: 1
				});
				$('.timepicker').timepicker({});
				$("#eventtitle").bind("keyup focusin", function(){
					var maxkey = $(this).attr("maxlength");
					var length = $(this).val().length;
					var value = $(this).val();
					$(this).parent().find("#counter").text(length+"/"+maxkey+" characters only");
					if (length > maxkey) $(this).val(value.substring(0, maxkey));
				}).bind("focusout", function(){$(this).parent().find("#counter").text("")});
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
                                <a class="facebook" href="https://www.facebook.com/CARIAUM"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a class="twitter" href="https://twitter.com/unimalaya"><i class="fab fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends -->
</html>