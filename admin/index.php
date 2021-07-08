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
        <!-- Main style css file for all content !DO NOT REMOVE! -->
        <link rel="stylesheet" href="../assets/css/style.css" />
		<link rel="stylesheet" href="../assets/css/material-dashboard.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
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
                    <a class="current" href="#">HOME</a>
					<a href="manageuser.php">MANAGE USER</a>
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
                <div class="container">
					<div class="profile-area">
                        <!-- Start Feature Content -->
                        <h2>Home</h2>
						<!--* Card init *-->
						<div class="content">
          <div class="row">
			  
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Pending Verified User</p>
                  <h3 class="card-title">
					 <?php 
						$stmt = $con->prepare("SELECT COUNT(verified) FROM `alumni` WHERE verified=1");
						$stmt->execute();
						if($result = $stmt->get_result()){
							$pendinguser = $result->fetch_array()['COUNT(verified)'];
							if($pendinguser!=0){
							echo $pendinguser;
							}else{
							echo '0';
							}
						}else{
							echo 'error';
						}
					  ?></h3>
                </div>
                <div class="card-footer">
					<div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">event</i>
                  </div>
                  <p class="card-category">Event</p>
                  <h3 class="card-title">
					<?php 
						$stmt = $con->prepare("SELECT COUNT(id) FROM `event` WHERE date_start > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
						$stmt->execute();
						if($result = $stmt->get_result()){
							$countevent = $result->fetch_array()['COUNT(id)'];
							if($countevent!=0){
							echo $countevent;
							}else{
							echo '0';
							}
						}else{
							echo 'error';
						}
					  ?>
				  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
					  <i class="material-icons">date_range</i> Last 24 Hours
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">groups</i>
                  </div>
                  <p class="card-category">Total Alumni</p>
                  <h3 class="card-title">
					<?php 
						$stmt = $con->prepare("SELECT COUNT(id) FROM `alumni`");
						$stmt->execute();
						if($result = $stmt->get_result()){
							$countalumni = $result->fetch_array()['COUNT(id)'];
							if($countalumni!=0){
							echo $countalumni;
							}else{
							echo '0';
							}
						}else{
							echo 'error';
						}
					  ?>
				  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
			  <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">chat</i>
                  </div>
                  <p class="card-category">Pending reply feedback</p>
                  <h3 class="card-title">
					<?php
						$date = date("Y",strtotime("-1 year"));;
						$stmt = $con->prepare("SELECT COUNT(id) AS count FROM alumni WHERE date_registered LIKE '$date%'");
						$stmt->execute();
						if($result = $stmt->get_result()){
							$count = $result->fetch_array()['count'];
							if($count!=0){
							echo $count;
							}else{
							echo '0';
							}
						}else{
							echo 'error';
						}
						
					?>
				  </h3>
                </div>
				  <div class="card-body">
					<span class="card-title">Feedback</span>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
			  <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">login</i>
                  </div>
                  <p class="card-category">Total login today</p>
                  <h3 class="card-title">
					<?php
						$date = date("Y-m-d");
						$stmt = $con->prepare("SELECT COUNT(login_info) AS count FROM alumni_login WHERE login_info LIKE '$date%'");
						$stmt->execute();
						if($result = $stmt->get_result()){
							$count = $result->fetch_array()['count'];
							if($count!=0){
							echo $count;
							}else{
							echo '0';
							}
						}else{
							echo 'error';
						}
						
					?>
				  </h3>
                </div>
				  <div class="card-body">
					  <span class="card-title">Daily Active User</span>
                  <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase today.</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
			  <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">how_to_reg</i>
                  </div>
                  <p class="card-category">Total Performance</p>
                  <h3 class="card-title">
					<?php
						$date = date("Y",strtotime("-1 year"));;
						$stmt = $con->prepare("SELECT COUNT(id) AS count FROM alumni WHERE date_registered LIKE '$date%'");
						$stmt->execute();
						if($result = $stmt->get_result()){
							$count = $result->fetch_array()['count'];
							if($count!=0){
							echo $count;
							}else{
							echo '0';
							}
						}else{
							echo 'error';
						}
						
					?>
				  </h3>
                </div>
				  <div class="card-body">
					<span class="card-title">Alumni Registered Status</span>
                  <p class="card-category">Last Year Performance</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> updated every 31st December
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
			<?php mysqli_close($con); ?>
        </div>
        <!-- End of page content div -->

        <!-- Back to top function -->
        <a id="back2Top" title="Back to top" href="#">Back to top</a>
        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!--For navigation animation-->
		<!-- For back to top function -->
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
		<script src="../assets/js/chartist.min.js"></script>
		<script src="../assets/js/material-dashboard.js"></script>
		<script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

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