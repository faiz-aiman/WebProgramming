<?php 
//Add this file to open session for every file
require("sessionconfig.php");
//Add this file to use database for every file
include("../db.php");
$JobID = $_GET['GetID'];
$query = "SELECT * FROM job WHERE id='".$JobID."'";
$result = mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($result))
{
    $JobTitle = $row['job_title'];
    $CompanyName = $row['company_name'];
    $Area = $row['area'];
    $Description = $row['description'];
    $JobType = $row['job_type'];
    $Salary = $row['salary'];
    $Start = date_create($row['start_date']);
	$Start= date_format($Start, "d/m/Y H:i");
    $End = date_create($row['end_date']);
	$End= date_format($End, "d/m/Y H:i");
    $ContactNo = $row['contact_no'];
    $Email = $row['email'];
    $JobPic = $row['job_pic'];
	if($JobPic==NULL){
		$JobPic='default-job-photo.PNG';
	}
}
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
                <div class="container">
                    <!-- Back to previous page button -->
                    <a class="btn btn-primary" href="job.php" style="margin-top: 10px;">&#60;&nbsp;back</a>
                    <div class="profile-area">
                        <!-- Start Feature Content -->
                        <h2>Job Details</h2>
                       <!-- Job Title Overlay Job Poster -->

    <section class="job-detail-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <img src="../images/job/<?php echo $JobPic?>" class="job-banner img-fluid" alt="jobbanner">
                    <div class="row justify-content-center job-title-div">
                        <div class="col-md-8 col-sm-10 col-xs-12 job-title">
                            <h3><?php echo $JobTitle ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Details Body Start-->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <!-- Job Top Section Start-->
                <div class="row">
                    <!-- Job Summary Start -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="detail-header">
                            <p class="title">Job Summary</p>
                        </div>
                        <dl>
                            <dt>Job Type</dt>
                            <dd><?php echo $JobType?></dd>
                            <dt>Area</dt>
                            <dd><?php echo $Area?></dd>
                            <dt>Salary</dt>
                            <dd>RM<?php echo $Salary?></dd>
                            <dt>Posted On</dt>
                            <dd><?php echo $Start ?></dd>
                            <dt>Closing Date</dt>
                            <dd><?php echo $End ?> </dd>
                        </dl>
                    </div>

                    <!-- Contact Information Start-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="detail-header">
                            <p class="title">Contact Information</p>
                        </div>
                        <div class="contact-information">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Company Name</th>
                                        <td><?php echo $CompanyName?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td><?php echo $ContactNo?></td>
                                    </tr>
                                    <tr>
                                        <th>Email Address</th>
                                        <td><?php echo $Email?></td>
                                    </tr>
									<tr>
										<a href="tel:<?php echo $ContactNo?>" class="btn btn-primary float-right">Call Now</a>
									</tr>
									<tr>
										<a href="mailto:<?php ecHo $Email?>" class="btn btn-primary float-right" style="margin-right: 10px">Email Now</a>
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Job Description Start -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="detail-header">
                            <p class="title">Job Description</p>
                        </div>
                        <div class="job-description">
                            <p>
                                <?php echo $Description?>
                            </p>
                        </div>
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
        <script src="../assets/js/lunar.js"></script>
        <!-- For load hold start page -->
		<script src="../assets/js/loader.js"></script>
        <!-- For modal design -->
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For back to top function -->
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

