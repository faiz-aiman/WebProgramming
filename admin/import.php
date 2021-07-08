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
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- External styling ends -->
        <!-- To style modal function -->
        <link rel="stylesheet" href="../assets/css/lunar.css" />
        <!-- Main style css file for all content !DO NOT REMOVE! -->
        <link rel="stylesheet" href="../assets/css/style.css" />
        <!-- To style table data -->
        <link rel="stylesheet" href="../assets/css/tablestyle.css" />
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
					<a class="current" href="#">MANAGE USER</a>
                    <a href="event.php">EVENT</a>
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
                                    <li>
                                        <a href="manageuser.php"><i class="fa fa-user"></i>Not Verified</a>
                                    </li>
                                    <li>
                                        <a href="edituser.php"><i class="fa fa-pencil-square-o"></i>Edit User</a>
                                    </li>
									<li class="active">
                                        <a href="#" class="active"><i class="fa fa-upload"></i>Import User</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Side Navigation Content -->
                        </div>
                    </div>
                </div>
                <div class="col-md-10 padding-1">
                    <!-- Start 2nd column content -->
                    <div class="container">
                        <div class="page-area">
                            <!-- Start Feature Content -->
                            <h2>Import user</h2>
								<?php
							$error="";
							if(isset($_POST["submit"])){
									$uploadfile=$_FILES['uploadfile']['tmp_name'];

									require '../assets/classes/PHPExcel.php';
									require_once '../assets/classes/PHPExcel/IOFactory.php';

									$objExcel=PHPExcel_IOFactory::load($uploadfile);
									foreach($objExcel->getWorksheetIterator() as $worksheet)
									{
										$highestrow=$worksheet->getHighestRow();
										for($row=0;$row<=$highestrow;$row++)
										{
											$idno = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
											$name = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
											$rYear = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
											if(is_numeric($rYear)){
											$rYear = ($rYear - 25569) * 86400;
											$rYear = gmdate("Y-m-d",$rYear);
											$rYear = strval($rYear);}
											$course = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
											if($course=="Bachelor of Computer Science"){
												$course='1';
											}else if($course=="Doctorate of Computer Science"){
												$course='2';
											}else if($course=="Master of Computer Science"){
												$course='3';
											}
											$major = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
											if($major=="Artificial Intelligence"){
												$major='1';
											}else if($major=="Computer System and Network"){
												$major='2';
											}else if($major=="Information Systems"){
												$major='3';
											}else if($major=="Software Engineering"){
												$major='4';
											}else if($major=="Multimedia"){
												$major='5';
											}else if($major=="Data Science"){
												$major='6';
											}else if($major=="Software Engineering (Software Technology) (Coursework and Dissertation)"){
												$major='7';
											}else if($major=="Computer Science (Applied Computing) (Coursework and Dissertation)"){
												$major='8';
											}else if($major=="Information Technology Management (Coursework)"){
												$major='9';
											}else if($major=="Data Science (Coursework)"){
												$major='10';
											}else if($major=="Library and Information Science (Coursework)"){
												$major='11';
											}else if($major=="Computer Science (Research)"){
												$major='12';
											}else if($major=="Information Science (Research)"){
												$major='13';
											}else if($major=="Doctor of Philosophy (Ph.D)"){
												$major='14';}
											$gYear = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
											if(is_numeric($gYear)){
											$gYear = ($gYear - 25569) * 86400;
											$gYear = gmdate("Y-m-d",$gYear);
											$gYear = strval($gYear);}
											if($idno!='' && $idno!='ID_NO')
											{
												$stmt = "INSERT INTO `alumni_list`(`id_no`, `name`, `registration_year`, `course`, `major`, `graduation_year`) VALUES ('$idno','$name', '$rYear', '$course', '$major', '$gYear')";
												if ($con->query($stmt) === TRUE) {
												  header("Location: import.php#successModal");
												} else {
												  header("Location: import.php#errorModal");
												}
											}else{
												header("Location: import.php#errorModal");
											}
										}
									}
								}
									?>
								
								<p>This is only to impore new graduates<br>Please download this <a href="../assets/file/template.xlsx">template</a> and ensure you use the <strong>correct format</strong> before you upload your file.<br><span style="color: red;">REMEMBER: Please upload Excel or CSV file only.</span></p>
									<form enctype="multipart/form-data" method="post" role="form">
										<div class="form-group">
											<label for="InputFile">Excel/CSV File Upload*:</label>
											 <input type="file" name="uploadfile" class="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                                    <div class="input-group my-3">
                                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"/>
                                                        <div class="input-group-append">
                                                            <button type="button" class="browse btn btn-primary" >Browse...</button>
                                                        </div>
                                                    </div>
										</div><br>
										<button type="button" id="upload" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#alertmessage" data-dismiss="modal" disabled="disabled">Upload&nbsp;&nbsp;<i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            <!-- Modal -->
                            <!-- Modal start -->
                            <!-- Modal for warning admin from any action event -->
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
                                                <h5>Are you sure?</h5>
                                                <p style="text-align: center;">This action cannot be undone.<br><span style="color: red;">REMEMBER: Please upload Excel or CSV file only and follow the <a href="../assets/file/template.xlsx">template</a>.</span></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-cstm-danger" type="submit" class="btn btn-primary" name="submit" value="submit">Continue</button>
                                            <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for warning admin from any action event ends-->
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
                                                <h4 class="pt-4">The list has been updated.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
										
                            <!-- Modal for warning admin from any action event -->
                            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="alertmessage" aria-hidden="true">
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
                                                <h5>Error!</h5>
												<p style="color: red;">Some user have been added to the database or you didn't follow the <a href="../assets/file/template.xlsx">template</a>. Please check.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End for three modal -->
							</form>
                        </div>
                        <!-- End Feature Content -->
                    </div>
                </div>
            </div>
        <!-- end of page div -->

        <!-- Back to top function -->
        <a id="back2Top" title="Back to top" href="#">Back to top</a>
        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!--For navigation animation-->
        <script src="../assets/js/lunar.js"></script>
        <!-- For modal design -->
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For back to top function -->
			<script>
			$(document).on("click", ".browse", function () {
				var file = $(this).parents().find(".file");
				file.trigger("click");
			});
			$('input[type="file"]').change(function (e) {
				var fileName = e.target.files[0].name;
				$("#file").val(fileName);
			});
			</script>
			<script>
			$("form > *").change(function() {
				  var fields = $("form input");
				  var filledFields = fields.filter(function() {
					return $(this).val().length > 0;
				  });
				  if (filledFields.length == fields.length) {
					$("#upload").removeAttr("disabled");
				  } else {
					$("#upload").attr("disabled", "disabled");
				  }
				});
			</script>
			<script>
			var hash = window.location.hash;
			if(hash == '#successModal' || hash=='#errorModal') {
				if(hash == '#successModal'){
				setTimeout(function(){
				   $(hash).modal('show');
			   }, 500);
				}else{
					setTimeout(function(){
				   $(hash).modal('show');
			   }, 500);
				}
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