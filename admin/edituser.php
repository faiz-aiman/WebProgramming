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
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" /><!-- Favicon of the system !DO NOT REMOVE!-->
		<!-- External styling -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
		<!-- External styling ends -->
        <link rel="stylesheet" href="../assets/css/lunar.css" /><!-- To style modal function -->
        <link rel="stylesheet" href="../assets/css/style.css" /><!-- Main style css file for all content !DO NOT REMOVE! -->
        <link rel="stylesheet" href="../assets/css/tablestyle.css" /><!-- To style table data -->
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
                        <div class="container">
                            <div class="nav-page-area">
								<!-- Side Navigation Content start -->
                                <div class="sidebar">
                                    <ul>
                                        <li>
                                            <a href="manageuser.php"><i class="fa fa-user"></i>Not Verified</a>
                                        </li>
                                        <li class="active">
                                            <a href="#" class="active"><i class="fa fa-pencil-square-o"></i>Edit User</a>
                                        </li>
										<li>
                                        <a href="import.php"><i class="fa fa-upload"></i>Import User</a>
                                    </li>
                                    </ul>
                                </div>
								<!-- End Side Navigation Content -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 padding-1">
                        <div class="container">
                            <div class="page-area">
                                <!-- Start Feature Content -->
                                <h2>Edit User</h2>
                                <input type="text" id="myInput" onkeyup="search()" placeholder="Search for username.." title="Type in a name" />
                                <!-- Table user start -->
                                <div class="userrequest">
                                    <table id="table" class="overflow-y"><!-- Use overflow to disable table horizontal scroll -->
                                        <thead>
                                            <tr>
                                                <th width="20%">ID</th>
												<th width="20%">USERNAME</th>
												<th width="35%">EMAIL</th>
												<th width="25%">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<tr style="display: none;" id="noresultstable">
												<td colspan="4" style="text-align: center">
													<span style="font-size: 23px;">Sorry... No results found.</span><br>
													<span style="text-align: center">Double check your search for any typos or spelling errors - or try a different search term.</span>
												</td>
											</tr>
                                            <?php 
                                                $query = $con->prepare("SELECT id, ic_no, passport_no, username, email FROM alumni");
                                                $query->execute();
												$result=$query->get_result();
                                                while($data = $result->fetch_array(MYSQLI_ASSOC)){
													if ($data['ic_no']==NULL){
														$data['ic_no']=$data['passport_no'];
													}
                                                    echo "<tr>";
                                                    echo "<td>{$data['ic_no']}</td>";
                                                    echo "<td>{$data['username']}</td>";
                                                    echo "<td>{$data['email']}</td>";
													echo "<td>
													<form action='deleteUser.php' method='post'>
													<input type='text' name='id' value='{$data['id']}' hidden/>
													<!-- Modal for warning admin from delete user -->
													<div class=\"modal fade\" id=\"alertmessage{$data['id']}\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"alertmessage\" aria-hidden=\"true\">
														<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
															<div class=\"modal-content\">
																<button class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
																	<span aria-hidden=\"true\">&times;</span>
																</button>
																<div class=\"modal-body\">
																	<div class=\"px-3 pt-3 text-center\">
																		<div class=\"event-type warning\">
																			<div class=\"event-indicator\">
																				<svg style=\"width: 60px; height: 60px;\" viewBox=\"0 0 24 24\">
																					<path fill=\"#000000\" d=\"M11,4.5H13V15.5H11V4.5M13,17.5V19.5H11V17.5H13Z\" />
																				</svg>
																			</div>
																		</div>
																		<br />
																		<br />
																		<h5>Are you sure to delete this user?</h5>
																		<p style=\"text-align: center;\">This action cannot be undone.</p>
																	</div>
																</div>
																<div class=\"modal-footer\">
																	<button type='submit' class=\"btn btn-cstm-danger\">Continue</button>
																	<a href=\"#\" class=\"btn btn-cstm-secondary\" data-dismiss=\"modal\" aria-label=\"Close\">Cancel</a>
																</div>
															</div>
														</div>
													</div>
													<!-- Modal for warning admin from delete user ends -->
													</form><a class='btn btn-info' onclick=window.location.href=\"userprofile.php?edit={$data['id']}\">Edit</a>&nbsp;";
                                                    echo "
													<a class='btn btn-danger deletebtn' data-toggle='modal' data-target='#alertmessage{$data['id']}'>Delete User</a></td>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Table user ends -->
                                <!-- Modal -->
								<!-- Modal for successful delete user -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="successModal" aria-hidden="true">
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
                                                    <h4 class="pt-4">The user has successfully deleted.</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								 <!-- Modal start -->
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
													<h4 class="pt-4">This user has been modified.</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Both modal Ends -->
								<!-- Modal for successful delete user ends -->
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
        <script type="text/javascript" src="../assets/js/tablesearch.js"></script>
        <!-- FOR TABLE SEARCH ONLY -->
		<script>
			var hash = window.location.hash;
			if(hash == '#successModal') {
				setTimeout(function(){
				   $(hash).modal('show');
			   }, 500);
			}else if(hash == '#deleteModal'){
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

