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
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/icon" />
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    </head>
    <header>
        <!-- Navigation start -->
        <div class="topnav">
            <div class="infotopnav">
                <h5>Welcome, <?php echo $_SESSION['title'], '&nbsp;', $_SESSION['fullname']?>!</h5>
            </div>
            <div class="btn-navbar">
                <a href="../logout.php" class="btn btn-3">
                    <span class="txt">Logout</span>
                    <span class="round"><i class="fa fa-chevron-right"></i></span>
                </a>
            </div>
			<?php include("../notification.php")?>
        </div>

        <nav id="bottomnav">
            <div class="bottomnav">
                <img src="../images/logo.png" alt="logo" />
                <div class="topBotomBordersIn">
                    <a href="index.php">HOME</a>
					<a href="alumni.php">ALUMNI</a>
                    <a class="current" href="#">JOBS</a>
                    <a href="event.php">EVENT</a>
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
									<li>
                                        <a href="job.php"><i class="fa fa-pencil-square-o"></i>Job Ads</a>
                                    </li>
                                    <li class="active">
                                        <a href="#" class="active"><i class="fa fa-briefcase"></i>Create Job</a>
                                    </li>
                                    <li>
                                        <a href="managejob.php"><i class="fa fa-pencil-square-o"></i>Edit Job</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Side Navigation Content -->
                        </div>
                    </div>
                </div>
                <div class="col-md padding-1">
                    <!-- Start 2nd column content -->
                    <div class="container">
                        <div class="page-area-form">
                            <!-- Start Feature Content -->
                            <h2>Create job</h2>
                            <form id="jobregister" action="jobcreation.php" method="POST" enctype="multipart/form-data" >
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-sm-6 my-auto">
                                                <div class="form-group">
                                                    <label><strong>Job Photo: </strong></label>
                                                    <input type="file" name="img" class="file" accept="image/jpeg, image/png" />
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file" />
                                                        <div class="input-group-append">
                                                            <button type="button" class="browse btn btn-primary">Browse...</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 my-auto" style="padding-bottom: 10px;">
                                                <label><strong>Preview: </strong></label>
                                                <img src="../images/job/default-job-photo.png" id="preview" class="img-thumbnail" alt="event-thumbnail" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Job Title: </strong></label>
													<input class="form-control" type="text" id="jobtitle" name="jobtitle" placeholder="Title" maxlength="60" required/><div id="counter" style="float: right"></div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Company Name: </strong></label>
                                                    <input class="form-control" type="text" name="companyname" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Country: </strong></label>
                                                    <select id="country" name="area" class="custom-select" required>
                                                    </select>
                                                </div>
                                            </div>
											<div class="col-md">
												<label for="state"><strong>*State: </strong></label>
												<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="state" name="state" autocomplete="off" required/></select>
											</div>
											 </div>
											<div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>Job Description: </strong></label>
													<textarea id="desc" style="height: 300px;" name="descriptionInfo"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Job Industry: </strong></label>
													<select name="jobstyle" class="custom-select" required>
														<option selected disabled>--Any--</option>
														<option value="Accounting">Accounting</option>
														<option value="Advertising" >Advertising</option>
														<option value="Aviation/Airline">Aviation/Airline</option>
														<option value="Banking">Banking</option>
														<option value="BioTech/Pharmaceutical">BioTech/Pharmaceutical</option>
														<option value="Business">Business</option>
														<option value="Education">Education</option>
														<option value="Engineering/Technical Consulting">Engineering/Technical Consulting</option>
														<option value="Entertainment/Media">Entertainment/Media</option>
														<option value="Food & Beverages">Food &amp; Beverages</option>
														<option value="Government/Defence">Government/Defence</option>
														<option value="Healthcare/Medical">Healthcare/Medical</option>
														<option value="IT/Hardware">IT/Hardware</option>
														<option value="IT/Software">IT/Software</option>
														<option value="Manufacturing/Production">Manufacturing/Production</option>
														<option value="Research & Development">Research &amp; Development</option>
														<option value="Science & Technology">Science &amp; Technology</option>
														<option value="Security Enforcement">Security Enforcement</option>
														<option value="Telecommunication">Telecommunication</option>
														<option value="Transportation & Logistic">Transportation &amp; Logistic</option>
														<option value="Travel & Tourism">Travel &amp; Tourism</option>
														<option value="Others">Others</option>
													</select>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Salary: </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">RM</span>
                                                        </div>
                                                        <input class="form-control" type="text" name="salary" id="currency" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Start Date: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="startdate" name="startdate" readonly="readonly" placeholder="DD/MM/YYYY" autocomplete="off" required/>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Time Start: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timestart" required/>
                                                </div>
                                            </div>
											</div>
                                            <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label style="padding-left: 10px"><strong>*End Date: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="enddate" name="enddate" placeholder="DD/MM/YYYY" readonly="readonly" required/>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label style="padding-left: 10px"><strong>*Time End: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timeend" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Contact number: </strong></label>
                                                    <input type="text" id="countryphone" name="countryphone" hidden/><br>
                                        			<input type="tel" class="form-control mb-2" id="phone" name="phonenumber" required />
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label for="inputEmail"><strong>*Email Address: </strong></label>
                                                     <input type="email" class="form-control" id="inputEmail" name="email" placeholder="yourname@domain.com" autocomplete="off" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<small style="color: red;float: left;padding-left: 10px;padding-right: 10px;">REMINDER: &#40;&#42;&#41; is required input.<br> You can't submit until you fill in the required input and it is correct.</small>
								<div style="float: right;">
									<a id="clear" class="btn btn-info" onclick="clearButton()">Reset</a>&nbsp;<button id="upload" type="submit" class="btn btn-success">Publish</button>
								</div>
                            </form>
                            
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
                                                <h4 class="pt-4">The job has been published.</h4>
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
                                                <h4 class="pt-4" style="color: red"><?php if(isset($_GET['errorid'])){if($_GET['errorid']==1){echo 'Fail to insert your data.';}else if($_GET['errorid']==2){echo 'Sorry, an error uploading the photo. <br><small>Please contact administrator</small>';}}else{echo 'There\'s nothing to submit. Please fill in the form!';}?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End for both modal -->
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <!--For navigation animation-->
        <script src="../assets/js/lunar.js"></script>
        <!-- For modal design -->
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For back to top function -->
        <!-- For image preview -->
        <script src="../assets/js/imgpreview.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
        <script src="../assets/js/intlTelInput.min.js"></script>
		<script src="../assets/js/countries.js"></script>
		<script src="../assets/js/jquery.maskMoney.js" type="text/javascript"></script>
		<!-- script for tinyMCE -->
        <script src="https://cdn.tiny.cloud/1/1tf6nfno3yi47i0rna6sogpqmrg2v0f8w12xpt60aegwbhq6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script src="../assets/js/jobform.js"></script>
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