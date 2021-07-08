<?php 
//Add this file to open session for every file
require("sessionconfig.php");
//Add this file to use database for every file
include("../db.php");
?>
<!-- query utk rsvp event -->   
<?php 
    $alumni_id=$_SESSION["id"];
    $get_event_id = "SELECT `event`.* FROM `event_rsvp` INNER JOIN `event` ON `event_rsvp`.`event_id` = `event`.`id` AND `event_rsvp`.alumni_id='$alumni_id' ORDER BY `event`.date_start ASC";
    $get_event_id_run = $con->query($get_event_id);
    $counter = mysqli_num_rows($get_event_id_run);
    $j = 0;
	if($counter>0){
    while($data = mysqli_fetch_assoc($get_event_id_run)){
        $event_id[] = $data['id'];
		$countdown[]= $data['date_start'];
		$titlersvp[]=$data['title'];
		$photo[]=$data['photo'];
    }
    $new_id = implode(",",$event_id);    
	}
?>
<!-- query utk rsvp event -->


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
        <!-- External styling ends -->
        <!-- To style modal function -->
        <link rel="stylesheet" href="../assets/css/lunar.css" />
        <!-- Main style css file for all content !DO NOT REMOVE! -->
        <link rel="stylesheet" href="../assets/css/style.css" />
        <!-- To style table data -->
        <link rel="stylesheet" href="../assets/css/tablestyle.css" />
		<style>
		/* PROFILE CARD STYLE */
		.card {
			float: right;
			background: #272e48;
			color: #fafaff;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 10px;
			border: 0;
			width: 100%;
		}

		.profile-card-body {
			background-color: #e4d9ff;
			color: #30343f;
			padding: 10px 10px 0;
		}

		.profile-card-nav-btn {
			background-color: #272e48;
			width: 100%;
			margin-bottom: 10px;
		}

		.profile-card-btn p {
			display: none;
		}

		.profile-card-nav-btn a {
			padding: 13px 19px;
			border-color: white;
			text-align: center;
			cursor: pointer;
			transition: 0.2s;
			color: #fafaff;
			border-radius: 10px 10px 0 0;
			text-decoration: none;
		}

		.profile-card-nav-btn > .active {
			background-color: #e4d9ff;
			color: #30343f;
		}

		.profile-card-nav-btn a:hover {
			background-color: #e4d9ff;
			color: #30343f;
		}

		.profile-label {
			text-align: right;
		}

		.profile-label::after {
			content: ": ";
		}

		.profile-card-btn {
			margin: 10px;
		}

		.profile-card-btn .btn {
			display: block;
			float: right;
			border-radius: 10px;
			background-color: #e4d9ff;
			color: #30343f;
		}

		.profile-card-btn .btn:hover {
			background-color: #cdbef3;
			color: #30343f;
		}

		.hide {
			display: none !important;
		}
		.tab-pane {
			margin-bottom: 10px;
		}

		.tab-pane p {
			text-align: left;
			padding: 0;
			margin: 0;
		}

		@media screen and (max-width: 767px) {
			.profile-card-nav-btn a {
				margin: 20px;
				border-radius: none;
			}
			.profile-card-nav-btn > .active {
				background-color: transparent;
				color: #fafaff;
			}

			.profile-card-nav-btn a:hover {
				background-color: transparent;
				color: #e4d9ff;
			}

			.profile-card-body p {
				text-align: center;
			}
		}

		.account-settings .user-profile {
			margin: 0 0 1rem 0;
			padding-bottom: 1rem;
			text-align: center;
		}
		.account-settings .user-profile .user-avatar {
			margin: 0 0 1rem 0;
		}
		.account-settings .user-profile .user-avatar img {
			width: 90px;
			height: 90px;
			-webkit-border-radius: 100px;
			-moz-border-radius: 100px;
			border-radius: 100px;
		}
		.account-settings .user-profile h5.user-name {
			font-size: 100%;
		}
		.account-settings .user-profile h6.user-details {
			margin: 0;
			font-size: 0.8rem;
			font-weight: 400;
		}
		/* PROFILE CARD STYLE ENDS */
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
                    <a class="current" href="#">HOME</a>
                    <a href="alumni.php">ALUMNI</a>
                    <a href="job.php">JOBS</a>
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
                <div class="container">
                    <div class="profile-area">
                        <!-- Start Feature Content --> 
                        <div class="row">
                            <div class="col-md-8">
                                <h2 style="font-size: 16px; padding: 10px;">countdown your upcoming rsvp event</h2>
								<?php
									if($counter<1){
										echo '<div class="alert alert-success" role="alert">
											  You didn&#39;t register to any event yet! Join our event and start RSVP today!
											</div>';
									}
								?>
                                <div id="eventCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel Indicators -->
                                    <ol class="carousel-indicators">
                                        <?php for($i = 0; $i < $counter; $i++){ ?>
                                        <li data-target="#eventCarousel" data-slide-to="<?= $i?>" class="<?php echo ($i == 0) ? "active": ""?>"></li>
                                        <?php } ?>
                                    </ol>
                                
                                    <!-- Carousel Slider -->
									
                                    <div class="carousel-inner" role="listbox">
                                    <?php
                                        for($i = 0; $i < $counter; $i++){
											
                                    ?> 
                                        <div class="carousel-item <?php echo ($i == 0) ? "active" : "" ?>">
                                            <img src="../images/event/<?= $photo[$i] ?>" class="d-block w-100" alt="<?= $titlersvp[$i] ?>" />
                                            <div class="carousel-caption">
                                                <h3><?= $titlersvp[$i] ?></h3>
                                                <div class="latest" style="align-content: center; padding: 0;">
                                                    <div class="latest-area" style="margin-bottom: 10px;">
                                                        <div class="countdown" style="padding: 0; margin: 0;">
                                                            <div id="day<?php if ($i!=0)echo $i?>" class="day">NA</div>
                                                            <div id="hour<?php if ($i!=0)echo $i?>" class="hour">NA</div>
                                                            <div id="minute<?php if ($i!=0)echo $i?>" class="minute">NA</div>
                                                            <div id="second<?php if ($i!=0)echo $i?>" class="second">NA</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php      
                                    }
                                    ?>
										
                                    </div>
                                    <!-- Carousel Controls -->
                                    <a href="#eventCarousel" class="carousel-control-prev" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a href="#eventCarousel" class="carousel-control-next" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="center">
                                    <h2 style="font-size: 16px; padding: 10px;">Your profile</h2>
                                </div>
                                <div class="content">
                                    <?php
                                    $id = $_SESSION['id'];
                                    $stmt = $con->prepare("SELECT alumni.username, alumni.email, alumni_profile.title, alumni_profile.fullname, alumni_profile.birthdate, alumni_profile.gender, alumni_profile.religion, alumni_profile.intake_year, alumni_profile.graduate_year, alumni_profile.emp_status, alumni_profile.phone_no, alumni_profile.address, alumni_profile.postcode, alumni_profile.state, alumni_profile.country, alumni_profile.profile_pic, academic.academic_level, academic_major.major FROM alumni INNER JOIN alumni_profile ON alumni.id=alumni_profile.alumni_id INNER JOIN academic ON alumni_profile.degree_id=academic.id INNER JOIN academic_major ON alumni_profile.major_id=academic_major.id WHERE alumni_profile.alumni_id=$id");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="account-settings">
                                                <div class="user-profile">
                                                    <div class="user-avatar">
                                                        <img src="../images/profileimg/<?php if($row['profile_pic']!=NULL){echo $row['profile_pic'];}else{echo 'default.png';} ?>" alt="profilepicture" />
                                                    </div>
                                                    <h5 class="user-name"><?php echo $row['title'], '&nbsp', $row['fullname'] ?></h5>
                                                    <h6 class="user-details"><?php echo '@', $row['username'], ' | ', date("d/m/Y", strtotime($row['birthdate'])) ?></h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-card-nav-btn">
                                            <a class="active" rel="personal" href="javascript:void(0)">Personal</a>
                                            <a rel="address" href="javascript:void(0)">Address</a>
                                            <a rel="academic" href="javascript:void(0)">Academic</a>
                                        </div>

                                        <!--Profile Card Body Start-->
                                        <div class="profile-card-body">
                                            <!--Personal tab start-->
                                            <div id="personal" class="tab-pane">
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="title-label" class="profile-label">Title </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p id="title" class="profile-info"><?php echo $row['title'] ?></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label id="email-label" class="profile-label">Email </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p id="email" class="profile-info"><?php echo $row['email'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="phone-label" class="profile-label">Phone No. </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p id="phone" class="profile-info"><?php echo $row['phone_no'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="gender-label" class="profile-label">Gender </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p id="gender" class="profile-info"><?php echo $row['gender'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="religion-label" class="profile-label">Religion </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p id="religion" class="profile-info"><?php echo $row['religion'] ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Address tab start-->
                                            <div id="address" class="tab-pane hide">
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="fullAddress-label" class="profile-label">Full Address </label>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <p id="fullAddress" class="profile-info">
                                                        <?php echo $row['address'].'<br>'.$row['postcode'].'<br>'.$row['state'].', '.$row['country'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Academic tab start-->
                                            <div id="academic" class="tab-pane hide">
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="regyear-label" class="profile-label">Registration year </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p id="regyear" class="profile-info"><?php echo $row['intake_year'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="gradyear-label" class="profile-label">Graduation year </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p id="gradyear" class="profile-info"><?php echo $row['graduate_year'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="course-label" class="profile-label">Course </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p id="course" class="profile-info"><?php echo $row['academic_level'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label id="major-label" class="profile-label">Major </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p id="major" class="profile-info"><?php echo $row['major'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Profile Card Edit/Save Button Start-->
                                        <div class="profile-card-btn">
                                            <a href="editprofile.php" class="btn btn-edit">Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of row content -->
        </div>
        <!-- End of page content div -->

        <!-- loader start -->
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="48px" height="48px">
                <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#FAFAFF" />
                <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#273469" />
            </svg>
        </div>
        <!-- loader ends -->

        <!-- Back to top function -->
        <a id="back2Top" title="Back to top" href="#">Back to top</a>
        <!-- SCRIPTS -->
        <script src="../assets/js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!--For navigation animation-->
        <!-- For load hold start page -->
        <script src="../assets/js/loader.js"></script>
        <!-- For back to top function -->
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <script type="text/javascript" src="../assets/js/profile.js"></script>
        <!-- <script type="text/javascript" src="../assets/js/countdown.js"></script> -->
		<script>
			<?php 
				for($i = 0; $i < $counter; $i++){
                    $latestDate = date("F d, Y H:i:s", strtotime($countdown[$i]));
                    echo 'var countDate'.$i.' = new Date("'.$latestDate.'").getTime();';
                }
			?>
			function newTime() {
			var now = new Date().getTime();
			<?php 
				for($i = 0; $i < $counter; $i++){
					echo 'gap'.$i.' = countDate'.$i.' - now;';
				}
			?>
			var second = 1000;
			var minute = second * 60;
			var hour = minute * 60;
			var day = hour * 24;
			<?php 
			for($i = 0; $i < $counter; $i++){
				echo '
					var d'.$i.' = Math.floor(gap'.$i.' / day);
					var h'.$i.' = Math.floor((gap'.$i.' % day) / hour);
					var m'.$i.' = Math.floor((gap'.$i.' % hour) / minute);
					var s'.$i.' = Math.floor((gap'.$i.' % minute) / second);';
			}

			for($i = 0; $i < $counter; $i++){
				if($i == 0){
					echo '
					document.getElementById("day").innerText = d'.$i.';
					document.getElementById("hour").innerText = h'.$i.';
					document.getElementById("minute").innerText = m'.$i.';
					document.getElementById("second").innerText = s'.$i.';';
					}else{
						echo '
					document.getElementById("day'.$i.'").innerText = d'.$i.';
					document.getElementById("hour'.$i.'").innerText = h'.$i.';
					document.getElementById("minute'.$i.'").innerText = m'.$i.';
					document.getElementById("second'.$i.'").innerText = s'.$i.';';
				}
			}
			?>
		}
		setInterval(function () {
			newTime();
		}, 1000);
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

