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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
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
                    <a href="job.php" class="current">JOBS</a>
                    <a href="event.php">EVENT</a>
                </div>
            </div>
        </nav>
        <!-- Navigation ends -->
    </header>

    <body>
		<?php 
			$JobID = $_GET['GetID'];
			$stmt = $con->prepare("SELECT * FROM job WHERE id=$JobID");
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();		
			$JobID = $row['id'];
			$JobTitle = $row['job_title'];
			$CompanyName = $row['company_name'];
			$ContactNo = $row['contact_no'];
			$Area = $row['area'];
			$str_arr = explode (", ", $Area); 
			$state = $str_arr[0];
			$country = $str_arr[1];
			$Description = $row['description'];
			$JobType = $row['job_type'];
			$Salary = $row['salary'];
			$Email = $row['email'];
			$JobPic = $row['job_pic'];
			$Start = $row['start_date'];
			$startdatetime = new DateTime($Start);
			$startdate = $startdatetime->format('d/m/Y');
			$starttime = $startdatetime->format('h:i A');

			$End = $row['end_date'];
			$enddatetime = new DateTime($End);
			$enddate = $enddatetime->format('d/m/Y');
			$endtime = $enddatetime->format('h:i A');

		?>
        <div id="page">
            <!-- start of page content div -->
            <div class="row">
                <!-- Start row content -->
                <div class="container">
                    <!-- Back to previous page button -->
                    <a class="btn btn-primary" href="managejob.php" style="margin-top: 10px;">&#60;&nbsp;back</a>
                    <div class="profile-area">
                        <!-- Start Feature Content -->
                        <h2>Edit Job</h2>
                        <div class="col">
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="e-profile">
                                                <div class="row">
                                                    <!-- Start Header Feature Content --><div class="col-12 col-sm-auto mb-3">
                                                        <div class="mx-auto" style="width: 140px;">
															<img src="../images/job/<?php echo $JobPic?>" id="preview" class="img-thumbnail" alt="event-thumbnail" />
														</div>
                                                    </div>
                                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $JobTitle?></h4>
                                                            <p class="mb-0"><?php echo $CompanyName?></p>
                                                            <div class="mt-2">
                                                                <input type="file" name="img" class="file" accept="image/jpeg, image/png" value="<?php echo $JobPic?>" />
                                                                <a type="file" class="browse btn btn-primary" id="file"><i class="fa fa-fw fa-camera"></i>
                                                                    <span>Change Photo</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Header Feature Content ends -->
                                                <!-- Start event information content -->
                                                <!-- Start form for the user profile -->
                                                <div class="tab-content pt-3">
                                                    <div class="tab-pane active">
														
                                            					<form id="register" action="updatejob.php" method="post" enctype="multipart/form-data">
											<input type="text" value="<?php echo $JobID?>" name="id" hidden/>
                                			<div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Job Title: </strong></label>
													<input class="form-control" type="text" id="jobtitle" name="jobtitle" placeholder="Title" maxlength="60" value="<?php echo $JobTitle?>" required/><div id="counter" style="float: right"></div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Company Name: </strong></label>
                                                    <input class="form-control" type="text" name="companyname" value="<?php echo $CompanyName?>" required />
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
													<textarea id="desc" style="height: 300px;" name="descriptionInfo"><?php echo $Description?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Job Industry: </strong></label>
													<select name="jobstyle" class="custom-select" required>
														<option selected disabled>--Any--</option>
														<option value="Accounting" <?php if($JobType=='Accounting')echo'selected' ?></option>Accounting</option>
														<option value="Advertising" <?php if($JobType=='Advertising')echo'selected' ?>>Advertising</option>
														<option value="Aviation/Airline" <?php if($JobType=='Aviation/Airline')echo'selected' ?>>Aviation/Airline</option>
														<option value="Banking" <?php if($JobType=='Banking')echo'selected' ?>>Banking</option>
														<option value="BioTech/Pharmaceutical" <?php if($JobType=='BioTech/Pharmaceutical')echo'selected' ?>>BioTech/Pharmaceutical</option>
														<option value="Business" <?php if($JobType=='Business')echo'selected' ?>>Business</option>
														<option value="Education" <?php if($JobType=='Education')echo'selected' ?>>Education</option>
														<option value="Engineering/Technical Consulting" <?php if($JobType=='Engineering/Technical Consulting')echo'selected' ?>>Engineering/Technical Consulting</option>
														<option value="Entertainment/Media" <?php if($JobType=='Entertainment/Media')echo'selected' ?>>Entertainment/Media</option>
														<option value="Food & Beverages" <?php if($JobType=='Food & Beverages')echo'selected' ?>>Food &amp; Beverages</option>
														<option value="Government/Defence" <?php if($JobType=='Government/Defence')echo'selected' ?>>Government/Defence</option>
														<option value="Healthcare/Medical" <?php if($JobType=='Healthcare/Medical')echo'selected' ?>>Healthcare/Medical</option>
														<option value="IT/Hardware" <?php if($JobType=='IT/Hardware')echo'selected' ?>>IT/Hardware</option>
														<option value="IT/Software" <?php if($JobType=='IT/Software')echo'selected' ?>>IT/Software</option>
														<option value="Manufacturing/Production" <?php if($JobType=='Manufacturing/Production')echo'selected' ?>>Manufacturing/Production</option>
														<option value="Research & Development" <?php if($JobType=='Research & Development')echo'selected' ?>>Research &amp; Development</option>
														<option value="Science & Technology" <?php if($JobType=='Science & Technology')echo'selected' ?>>Science &amp; Technology</option>
														<option value="Security Enforcement" <?php if($JobType=='Security Enforcement')echo'selected' ?>>Security Enforcement</option>
														<option value="Telecommunication" <?php if($JobType=='Telecommunication')echo'selected' ?>>Telecommunication</option>
														<option value="Transportation & Logistic" <?php if($JobType=='Transportation & Logistic')echo'selected' ?>>Transportation &amp; Logistic</option>
														<option value="Travel & Tourism" <?php if($JobType=='Travel & Tourism')echo'selected' ?>>Travel &amp; Tourism</option>
														<option value="Others" <?php if($JobType=='Others')echo'selected' ?>>Others</option>
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
                                                        <input class="form-control" type="text" name="salary" id="currency" value="<?php echo $Salary?>" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Start Date: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="startdate" name="startdate" readonly="readonly" placeholder="DD/MM/YYYY" autocomplete="off" value="<?php echo $startdate?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label><strong>*Time Start: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timestart" value="<?php echo $starttime?>" required/>
                                                </div>
                                            </div>
											</div>
                                            <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label style="padding-left: 10px"><strong>*End Date: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" class="datepicker" id="enddate" name="enddate" placeholder="DD/MM/YYYY" readonly="readonly" value="<?php echo $enddate?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label style="padding-left: 10px"><strong>*Time End: </strong></label>
													<input type="text" style="background-color: #fff !important; cursor: pointer;" readonly="readonly" class="timepicker" name="timeend" value="<?php echo $endtime?>"required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                    <label><strong>*Contact number: </strong></label><br>
													<input type="text" id="countryphone" name="countryphone" hidden/>
                                        			<input type="tel" class="form-control mb-2" id="phone" name="phonenumber" value="<?php echo $ContactNo?>" required />
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label for="inputEmail"><strong>*Email Address: </strong></label>
                                                     <input type="email" class="form-control" id="inputEmail" name="emailInfo" placeholder="yourname@domain.com" autocomplete="off" value="<?php echo $Email?>" required />
                                                </div>
                                            </div>
                                        </div>
													
                            <!-- Modal for alert to modify job profile -->
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
                                                <h5>Are you sure to change?</h5>
                                                <p style="text-align: center;">This action cannot be undone.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-cstm-danger">Continue</button>
                                            <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </form>
												<div class="row">
                                                            <div class="col d-flex justify-content-end">
                                                                <button class="btn btn-primary" data-toggle="modal" data-target="#alertmessage">Save Changes</button>
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
                            <!-- Modal start -->
							
                            <!-- Modal for succesful to edit -->
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
                                                <h4 class="pt-4">Your job advertisement has been modified.</h4>
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
                            <!-- Both modal Ends -->
                            <!-- End Feature Content -->
                        </div>
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
		<script src="https://cdn.tiny.cloud/1/1tf6nfno3yi47i0rna6sogpqmrg2v0f8w12xpt60aegwbhq6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script src="../assets/js/jobeditform.js"></script>
		<script>
			populateCountriesEdit("country", "state", "<?php echo $country ?>", "<?php echo $state ?>"); 
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

