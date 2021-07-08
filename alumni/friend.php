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
		<?php
        $userID = $_SESSION['id'];
        $get_alumni = $con->prepare("SELECT `alumni`.`id`, `alumni_profile`.`fullname`, `academic_major`.`major`, `alumni`.`email`, `alumni_profile`.`phone_no`, `alumni_profile`.`profile_pic`, `alumni_profile`.`privacy_contact`, `friend_list`.`approval_status`
        FROM `alumni_profile` 
            LEFT JOIN `academic_major` ON `alumni_profile`.`major_id` = `academic_major`.`id` 
            LEFT JOIN `alumni` ON `alumni_profile`.`alumni_id` = `alumni`.`id`
            , `friend_list`
        WHERE ((`friend_list`.`sender_id` = $userID AND `friend_list`.`receiver_id` = `alumni`.`id`) OR (`friend_list`.`sender_id` = `alumni`.`id` AND `friend_list`.`receiver_id` = $userID)) AND `friend_list`.`approval_status` = '2'");
        $get_alumni->execute();
        $res_alumni = $get_alumni->get_result();
		$checkrow = mysqli_num_rows($res_alumni) > 0;
        ?>
        <div id="page">
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
                                <li>
                                    <a href="alumni.php"><i class="fa fa-users"></i>All Alumni</a>
                                </li>
                                <li class="active">
                                    <a href="#" class="active"><i class="fas fa-user-friends"></i>Friends</a>
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
                        <h2>Your friends</h2>
                        <input type="text" id="myInput" onkeyup="searchAlumni()" placeholder="Search for name/department.." title="Type in a job" />
                        <div id="noresults" style="display: none;">
                            <img alt="searchicon" src="../images/searchicon.png"><br><br>
                            <span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any matches for &#39;<span id="searchitem"></span>&#39;</span><br>
                            <span style="text-align: center">Double check your search for any typos or spelling errors - or try a different search term.</span>
                        </div>
                        <div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>
                            <?php
							if($checkrow){
								echo '<div id="profile-list">';
								while ($row_alumni = $res_alumni->fetch_array(MYSQLI_ASSOC)) {
								if ($row_alumni['profile_pic'] == NULL) {
										$row_alumni['profile_pic'] = 'default.png';
									}
									echo '<div class="profile-card">
									<img src="../images/profileimg/', $row_alumni['profile_pic'], '" class="alumni-photo" alt="profile photo" />
									<p class="search-filter alumni-name" data-toggle="tooltip" data-placement="top" title="', $row_alumni['fullname'], '">', $row_alumni['fullname'], '</p>
									<p class="search-filter alumni-department">', $row_alumni['major'], '</p>';
									if ($row_alumni['privacy_contact'] == 0) {
										echo '<p class="alumni-email" data-toggle="tooltip" data-placement="top" title="Not shared"><i class="fa fa-lock">&nbsp;</i>Contact Information</p>
										';
									} else {
										echo '<p class="alumni-email">', $row_alumni['email'], '</p>
										<p class="alumni-no">', $row_alumni['phone_no'], '</p>';
									}
									echo '<a href="alumnidetail.php?alumniID=', $row_alumni['id'], '" class="btn btn-primary" style="width: 150px">View Profile</a></div>';
								}
								echo '</div>';
							}else{
									echo '<div id="noresults">
									<img alt="searchicon" src="../images/searchicon.png"><br><br>
									<span style="font-size: 23px;">Hmmmmm..... you don&#39;t have any friend yet... Go add someone!</span><br></div>';
							}
                            
                            ?>
                    </div>
                </div>
            </div>
            <!-- End of row content -->
        </div>
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
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
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