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
                    <a href="alumni.php">ALUMNI</a>
                    <a href="job.php">JOBS</a>
                    <a class="current" href="#">EVENT</a>
                </div>
            </div>
        </nav>
        <!-- Navigation ends -->
    </header>

    <body>
        <div id="page">
			<?php
			$get_event = $con->prepare("SELECT * FROM `event` ORDER BY `date_start` ASC");
			$get_event->execute();
			$res_event = $get_event->get_result();
			$get_event->store_result();
			?>
            <!-- start of page content div -->
            <div class="row">
                <div class="container">
					<a class="btn btn-primary" href="<?php echo $_SERVER["HTTP_REFERER"]?>" style="margin-top: 10px;">&#60;&nbsp;back</a>
					<div class="profile-area">
                    <div class="page-area-form">
                        <!-- Start Feature Content -->
                        <h2>All Event</h2>
                        <input type="text" id="myInput" onkeyup="searchAlumni()" placeholder="Search for event/type name.." title="Type in a job" />
						<div id="noresults" style="display: none;">
							<img alt="searchicon" src="../images/searchicon.png"><br><br>
							<span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any event matches for &#39;<span id="searchitem"></span>&#39;</span><br>
							<span style="text-align: center">Double check your search for any typos or spelling errors - or try a different search term.</span>
						</div>
                            <?php
							if($res_event -> num_rows > 0){
								echo '<div id="profile-list">';
								while ($row = $res_event->fetch_array(MYSQLI_ASSOC)) {
								if($row['photo']!=NULL){
									$photo = $row['photo'];
								}else{
									$photo = 'default-event-photo.png';
								}
                                echo '<div class="profile-card">
                                <img src="../images/event/', $photo, '" class="alumni-photo" alt="event photo" />
                                <p class="search-filter alumni-name">', $row['title'], '</p>
                                <p class="search-filter alumni-department">', $row['category'], '</p>';
                                echo '<p class="alumni-email">', date("d/m/Y H:i A", strtotime($row['date_start'])), '</p>';
                                echo '<a href="eventdetail.php?eventID=', $row['id'], '" class="btn btn-primary" style="width: 150px">View Event</a>
								</div>';
								}
								echo '</div>';
							}else{
								echo '<div id="noresults">
								<img alt="searchicon" src="../images/searchicon.png"><br><br>
								<span style="font-size: 23px;">Hmmmmm..... we couldn&#39;t find any event</span><br></div>';
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