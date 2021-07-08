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
                    <a href="index.php">HOME</a>
                    <a href="manageuser.php">MANAGE USER</a>
                    <a class="current" href="#">EVENT</a>
					<a href="feedback.php">FEEDBACK</a>
                </div>
            </div>
        </nav>
        <!-- Navigation ends -->
    </header>

    <body>
        <div id="page">
            <!-- start of page content div -->
            <div class="row">
                <!-- Start row content -->
                <div class="col col-lg-2 padding-0">
                    <!-- Start 1st column content -->
                    <div class="container">
                        <div class="nav-page-area">
                            <!-- Side Navigation Content Start-->
                            <div class="sidebar">
                                <ul>
                                    <li class="active">
                                        <a href="#" class="active"><i class="fa fa-user"></i>Create Event</a>
                                    </li>
                                    <li>
                                        <a href="editevent.php"><i class="fa fa-pencil-square-o"></i>Edit Event</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Side Navigation Content -->
                        </div>
                    </div>
                    <!-- 1st Column content ends -->
                </div>
                <div class="col-md-10 padding-1">
                    <!-- Start 2nd column content -->
                    <div class="container">
                        <div class="page-area-form">
                            <!-- Start Feature Content -->
                            <h2>Create Event</h2>
                            <!-- Form to create event start -->
                            <form action="createEvent.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label><strong>&#42;Event title: </strong></label>
                                                    <input class="form-control" type="text" id="eventtitle" name="eventtitle" placeholder="Title" maxlength="60" required/><div id="counter" style="float: right"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label><strong>&#42;Start Date: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="startdateevent" name="startdateevent" readonly="readonly" placeholder="DD/MM/YYYY" autocomplete="off" required/>
												</div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label><strong>&#42;Time Start: </strong></label>
                                                    <input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timestart" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label style="padding-left: 10px;"><strong>&#42;End Date: </strong></label>
                                                    <input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="enddateevent" name="enddateevent" placeholder="DD/MM/YYYY" readonly="readonly" required/>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label style="padding-left: 10px;"><strong>&#42;Time End: </strong></label>
                                                    <input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timeend" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label style="float: left; margin-top: 3px;"><strong>&#42;Category:</strong></label>
                                                    <select class="custom-select col-sm-10 float-right" id="category" name="category" required>
                                                        <option value="All" disabled selected>- Any -</option>
                                                        <option value="Arts">Arts</option>
                                                        <option value="Athletic">Athletics</option>
                                                        <option value="Career Networking">Career Networking</option>
                                                        <option value="Faculty">Faculty</option>
                                                        <option value="Lecture/Reading/Talk">Lecture/Reading/Talk</option>
                                                        <option value="Reunion">Reunion</option>
                                                        <option value="Social">Social</option>
                                                        <option value="Student Engagement">Student Engagement</option>
                                                        <option value="Tour">Tour</option>
                                                        <option value="Virtual">Virtual</option>
                                                        <option value="Volunteer">Volunteer Opportunity</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <br />
                                                    <label><strong>&#42;Venue:</strong></label>
                                                    <textarea class="form-control" type="text" name="eventvenue" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label><strong>Event Photo: </strong></label>
                                                    <input type="file" name="img" class="file" accept="image/jpeg, image/png"/>
                                                    <div class="input-group my-3">
                                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file" />
                                                        <div class="input-group-append">
                                                            <button type="button" class="browse btn btn-primary">Browse...</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <img src="../images/default-event-photo.png" id="preview" class="img-thumbnail" alt="event-thumbnail" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label><strong>&#42;Event description: </strong></label>
                                                    <textarea class="form-control" style="height: 200px;" name="eventdescription" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <h5>Are you sure to publish this event?</h5>
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
                            <!-- Form to create event ends -->
							<small style="color: red; float: left;">&#40;&#42;&#41; is required input. Please fill in the details</small>
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#alertmessage">Publish</button>
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
                                                <h4 class="pt-4">This event has been published.</h4>
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
                                                <h4 class="pt-4" style="color: red"><?php if(isset($_GET['errorid'])){if($_GET['errorid']==1){echo 'Fail to insert your data.';}else if($_GET['errorid']==2){echo 'Sorry, there was an error uploading your file.';}}else{echo 'There\'s nothing to submit. Please fill in the form!';}?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Ends -->
                           
                        </div>
                        <!-- End Feature Content -->
                    </div>
                </div>
                <!-- End of 2nd column content -->
            </div>
            <!-- End of row content -->
        </div>
        <!-- end of page div -->

        <!-- Back to top function -->
        <a id="back2Top" title="Back to top" href="#">Back to top</a>
        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!--For navigation animation-->
        <script src="../assets/js/lunar.js"></script>
        <!-- For modal design -->
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For back to top function -->
        <!-- For table sticky header -->
        <script src="../assets/js/jquery.stickyheader.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
        <!-- End table sticky header -->
        <script src="https://unpkg.com/tiny-editor/dist/bundle.js"></script>
        <!--<script src="../assets/js/timepicker.js"></script>-->
        <script src="../assets/js/datepicker.js"></script>
		<script src="../assets/js/imgpreview.js"></script>
		<script>
			$("#eventtitle").bind("keyup focusin", function(){
				var maxkey = $(this).attr("maxlength");
				var length = $(this).val().length;
				var value = $(this).val();
				$(this).parent().find("#counter").text(length+"/"+maxkey+" characters only");
				if (length > maxkey) $(this).val(value.substring(0, maxkey));
			}).bind("focusout", function(){$(this).parent().find("#counter").text("")});
		</script>
		<script>
            $(".datepicker").datepicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true,
				minDate: 1
            });
			$('.timepicker').timepicker({});
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