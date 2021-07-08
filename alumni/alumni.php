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
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <!-- External styling ends -->
        <!-- To style modal function -->
        <link rel="stylesheet" href="../assets/css/lunar.css" />
        <!-- Main style css file for all content !DO NOT REMOVE! -->
        <link rel="stylesheet" href="../assets/css/style.css" />
		<style>
		.tooltip-wrapper {
		  display: inline-block; /* display: block works as well */
		}

		.tooltip-wrapper .btn[disabled] {
		  /* don't let button block mouse events from reaching wrapper */
		  pointer-events: none;
		}

		.tooltip-wrapper.disabled {
		  /* OPTIONAL pointer-events setting above blocks cursor setting, so set it here */
		  cursor: not-allowed;
		}
	</style>
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
                    <a class="current" href="#">ALUMNI</a>
                    <a href="job.php">JOBS</a>
                    <a href="event.php">EVENT</a>
                </div>
            </div>
        </nav>
        <!-- Navigation ends -->
    </header>

    <body>
        <div id="page">
			<?php
			$userID = $_SESSION['id'];
			$get_alumni = $con->prepare("SELECT alumni.id, alumni.email, alumni_profile.fullname, alumni_profile.phone_no, alumni_profile.profile_pic, alumni_profile.privacy_contact, academic_major.major FROM alumni INNER JOIN alumni_profile ON alumni.id = alumni_profile.alumni_id INNER JOIN academic_major ON alumni_profile.major_id = academic_major.id WHERE alumni.status=1 AND NOT alumni.id=$userID ORDER BY alumni_profile.fullname DESC");
			$get_alumni->execute();
			$res_alumni = $get_alumni->get_result();
			$get_alumni->store_result();
			?>
            <!-- start of page content div -->
            <div class="row">
				<!-- Start row content -->
                <div class="col col-md-2 padding-0">
                    <!-- Start 1st column content -->
                    <div class="container">
                        <div class="nav-page-area">
                            <!-- Side Navigation Content Start-->
                            <div class="sidebar">
                            <ul>
                                <li class="active">
                                    <a href="#" class="active"><i class="fa fa-users"></i>All Alumni</a>
                                </li>
                                <li>
                                    <a href="friend.php"><i class="fas fa-user-friends"></i>Friends</a>
                                </li>
                                <li>
                                    <a href="friendRequest.php"><i class="fa fa-user-plus"></i>Friend Requests</a>
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
                        <h2>All Alumni</h2>
                        <input type="text" id="myInput" onkeyup="searchAlumni()" placeholder="Search for name/department.." title="Type in a job" />
						<div id="noresults" style="display: none;">
							<img alt="searchicon" src="../images/searchicon.png"><br><br>
							<span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any name/department matches for &#39;<span id="searchitem"></span>&#39;</span><br>
							<span style="text-align: center">Double check your search for any typos or spelling errors - or try a different search term.</span>
						</div>
                            <?php
							if($res_alumni -> num_rows > 0){
								echo '<div id="profile-list">';
								while ($row_alumni = $res_alumni->fetch_array(MYSQLI_ASSOC)) {
									if ($row_alumni['profile_pic'] == NULL) {
										$row_alumni['profile_pic'] = 'default.png';
									}
									$id = $row_alumni['id'];
									$checkfriend = $con->prepare("SELECT * FROM friend_list WHERE ((sender_id = $userID AND receiver_id = $id) OR (sender_id = $id AND receiver_id = $userID))");
									$checkfriend->execute();
									$checkfriend_result = $checkfriend->get_result();
									//$checkfriend_result->store_result();
									$rowdata = $checkfriend_result->fetch_array(MYSQLI_ASSOC);
									$rowcheck = mysqli_num_rows($checkfriend_result);
									echo '<div class="profile-card">
									<img src="../images/profileimg/', $row_alumni['profile_pic'], '" class="alumni-photo" alt="profile photo" />
									<p class="search-filter alumni-name">', $row_alumni['fullname'], '</p>
									<p class="search-filter alumni-department">', $row_alumni['major'], '</p>';
									
									if ($rowcheck > 0){
										if($rowdata['approval_status']==2){ //IF FRIEND
											if ($row_alumni['privacy_contact'] == 1) {
													echo '<p class="alumni-email">', $row_alumni['email'], '</p>
													<p class="alumni-no">', $row_alumni['phone_no'], '</p>';
											}else{
												echo '<div class="tooltip-wrapper" data-title="Not shared"><p style="font-size: 14px;" class="alumni-email"><i class="fa fa-lock">&nbsp;</i>Contact information</p></div>';
											}
										}else{ //NOT ACCEPT YET AS FRIEND
                                            if($rowdata['sender_id']==$userID){
                                                echo '<div class="tooltip-wrapper disabled" data-title="Request sent"><button class="btn btn-primary" style="margin: 0; width: 150px;" disabled>Add as friend</button></div>';
                                            } else {
                                                echo '<div class="tooltip-wrapper disabled" data-title="User sent you a friend request"><button class="btn btn-primary" style="margin: 0; width: 150px;" disabled>Add as friend</button></div>';
                                            }
										}
									}else{
										echo '<form action="addfriend.php" method="post" style="display: inline;">
										<input type="id" value="', $row_alumni['id'], '" name="id" id="id" hidden>
										<button class="btn btn-primary" style="margin: 0; width: 150px" type="submit">Add as friend</button></form>';
									}
									
									echo '<a href="alumnidetail.php?alumniID=', $row_alumni['id'], '" class="btn btn-primary" style="width: 150px">View Profile</a>
									</div>';
								}
							echo '</div>';
							}else{
								echo '<div id="noresults">
								<img alt="searchicon" src="../images/searchicon.png"><br><br>
								<span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any alumni</span><br></div>';
							}
                            
                            ?>
                    </div>
                </div>
            </div>
            <!-- End of row content -->
        </div>
			
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
                                                <h4 class="pt-4">Request sent.</h4>
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
                                                <h4 class="pt-4" style="color: red">Fail to request. Please try again.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End for both modal -->
		</div>
        <!-- End of page content div -->

       <!-- Back to top function -->
    <a id="back2Top" title="Back to top" href="#">Back to top</a>
    <!-- SCRIPTS -->
    <script src="../assets/js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/ce95fe7de4.js" crossorigin="anonymous"></script>
    <!--For navigation animation-->
    <!-- For back to top function -->
    <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
    <!-- FOR TABLE SEARCH ONLY -->
    <script type="text/javascript" src="../assets/js/tablesearch.js"></script>
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
		
		$(function() {
			$('.tooltip-wrapper').tooltip({position: "bottom"});
			function addTooltip() {
            $(".alumni-name").each(function() {
                var thisTxt = $(this).text();
                var cloneEle = document.createElement("div");
                cloneEle = $(cloneEle);
                cloneEle.addClass("ele-clone");
                cloneEle.html(thisTxt);
                $("body").append(cloneEle);
                if ($(this).width() <= cloneEle.width()) {
                    $(this).attr("title", thisTxt);
                    $(this).tooltip();
                } else {
                    $(this).removeAttr("title");
                }
                cloneEle.remove();
            });
        };
        addTooltip();
		});
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