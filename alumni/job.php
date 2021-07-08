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
									<li class="active">
                                        <a href="#" class="active"><i class="fa fa-pencil-square-o"></i>Job Ads</a>
                                    </li>
                                    <li>
                                        <a href="createjob.php"><i class="fa fa-briefcase"></i>Create Job</a>
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
                        <h2>JOB Advertisement</h2>
						<input type="text" id="myInput" onkeyup="searchJob1()" placeholder="Search for job name/company/area.." title="Type in a job"/>
						<div id="noresults" style="display: none;">
							<img alt="searchicon" src="../images/searchicon.png"><br><br>
							<span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any matches for &#39;<span id="searchitem"></span>&#39;</span><br>
							<span style="text-align: center">Double check your search for any typos or spelling errors - or try a different search term.</span>
						</div>
                            <?php
                                $query = "SELECT * FROM job";
                                $result = mysqli_query($con,$query);
                                $check_result = mysqli_num_rows($result) > 0;

                            if($result){
								if($check_result){
									echo '<div id="profile-list">';
										while($row=mysqli_fetch_assoc($result)){
										$JobID = $row['id'];
										$JobPic = $row['job_pic'];
										if($JobPic==NULL){
											$JobPic='default-job-photo.PNG';
										}
										$JobTitle = $row['job_title'];
										$CompanyName = $row['company_name'];
										$JobType = $row['job_type'];
										$Area = $row['area'];
										?>  
							
									<div class="profile-card" >
											<img src="../images/job/<?php echo $JobPic?>" class="alumni-photo" alt="profile photo">
											<p class="search-filter alumni-name"><?php echo $JobTitle?></p>
											<p class="search-filter alumni-department"><?php echo $CompanyName?></p>
											<p class="alumni-email job-type"><?php echo $JobType?></p>
											<p class="alumni-no job-location"><?php echo $Area?></p>
											<a href="jobdetail.php?GetID=<?php echo $JobID ?>" class="btn btn-primary">View Detail</a>
									</div>
										<?php  
									}
									echo '</div>';
								}else{
									 echo '<div id="noresults">
									<img alt="searchicon" src="../images/searchicon.png"><br><br>
									<span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any job</span><br></div>';}
                            }else{
                                 echo '<div id="noresults">
								<img alt="searchicon" src="../images/searchicon.png"><br><br>
								<span style="font-size: 23px;">An error occured. Please contact the administrator.</span><br></div>';
                            }
    
                            ?>
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
			
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <!--For navigation animation-->
        <!-- For back to top function -->
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
		<!-- FOR TABLE SEARCH ONLY -->
        <script type="text/javascript" src="../assets/js/tablesearch.js"></script>
			<script>
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
					$(".job-location").each(function() {
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

