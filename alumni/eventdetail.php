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
                    <a  href="index.php">HOME</a>
					<a href="alumni.php">ALUMNI</a>
					<a href="job.php">JOBS</a>
                    <a  class="current" href="#">EVENT</a>
                </div>
            </div>
        </nav>
        <!-- Navigation ends -->
    </header>

    <body>
    <?php
    $event_id = $_GET['eventID'];
    $alumni_id=$_SESSION["id"];
    $stmt = $con->prepare("SELECT * FROM `event_rsvp` WHERE event_id=$event_id AND alumni_id=$alumni_id");
    $stmt->execute(); 
    $result = $stmt->get_result();
    if($result->num_rows>0){
        $target = "#registered";
    }
    else{
        $target = "#alertmessage";
    }
    
    $stmt = $con->prepare("SELECT * FROM `event` WHERE id=$event_id");
    $stmt->execute();
    if($result = $stmt->get_result()){
        $row = $result->fetch_assoc();
        $date_start = date_create($row['date_start']);
        $date_end = date_create($row['date_end']);
        $title = $row['title'];
        $desc = $row['description'];
        
        $start_date = date_format($date_start, "F j, Y (l)");
        $end_date = date_format($date_end, "F j, Y (l)");

        $start_time = date_format($date_start, "g:i A");
        $end_time = date_format($date_end, "g:i A");
        $category = $row['category'];
        $venue = $row['venue'];
        if($row['photo']!=NULL){
			$pic = $row['photo'];
		}else{
			$pic = 'default-event-photo.png';
		}
        $stmt->close();

        //find date difference
        $difference=date_diff($date_start,$date_end);
        $day = $difference->format("%a");
        $hour = $difference->format("%h");
        if($day>=1){
            $date = $start_date.' - '.$end_date;
            
            if($day == 1){
                $time = $day.' Day ';
            }else{
                $time = $day.' Days ';
            }

            if($hour == 1){
                $time = $time.$hour.' Hour';
            }else if($hour>0){
                $time = $time.$hour.' Hours';
            }
        }
        else{
            $date = $start_date;
            $time = $start_time.' - '.$end_time;
        }

    }else{
        header("Location:event.php");
        exit();
    }


    if(isset($_POST['alumni_id'])){
            $stmt = $con->prepare('INSERT INTO event_rsvp (event_id, alumni_id) VALUES (?, ?)');
            $stmt->bind_param('ii', $_POST['event_id'], $_POST['alumni_id']);
            $stmt->execute();
            echo "<script>$(window).load(function(){
                    $('#successModal').modal('show'); });
                    </script>";
            $target = "#registered";
    }
    ?>
        <div id="page">
            <!-- start of page content div -->
            <div class="row">
                <!-- Start row content -->
                <div class="container">
                    <!-- Back to previous page button -->
                    <a class="btn btn-primary" href="event.php" style="margin-top: 10px;">&#60;&nbsp;back</a>
                    <div class="profile-area">
                        <!-- Start Feature Content -->
                        <h2>Event Details</h2>
                       <div class="row">
                                <div class="col">
                                    <img src="../images/event/<?php echo $pic ?>" height="591px" width="510px">
                                </div>
                                <div class="col">
									<h2 style="margin-bottom: 20px;line-height: 30px;"><?php echo $title ?></h2><br>
                                    <strong>Good Day, All Alumni!</strong><br><br>
                                    <?php echo $desc ?> <br><br>
                                    This is the details of the event: <br>
                                    Date: <?php echo $date ?><br>
                                    Time: <?php echo $time ?><br>
                                    Theme: <?php echo $category ?><br>
                                    Venue: <?php echo $venue ?><br><br>
                                    For more details, do not hesitate to contact Puan Hasnah at +601234567890.<br><br>
                                    <form action="#successModal" method="post">
                                    <input type="text" value="<?php echo $event_id?>" name="event_id" hidden/>
                                    <input type="text" value="<?php echo $alumni_id?>" name="alumni_id" hidden/>
                					
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
                                                        <h5>Are you sure to RSVP this event?</h5>
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
                                    <!-- Modal for warning admin from any action event ends-->
                                    </form>
                                    <a id="checkAlumni" class="btn btn-primary float-right" data-toggle="modal" data-target="<?php echo $target ?>">RSVP NOW</a>
                                </div>
                            </div>
                            <!-- End Feature Content -->

                            <!-- Modal for if alumni has registered -->
                            <div class="modal fade" id="registered" tabindex="-1" role="dialog" aria-labelledby="registered" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <button class="close" data-dismiss="modal" aria-label="Close">
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
                                                <br />
                                                <br />
                                                <h5>You have already registered for the event.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal if alumni has registered ends-->
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
                                                <h4 class="pt-4">Thank you! You have been registered for this event.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for successful from any action event ends -->
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        -->
        <!--For navigation animation-->
        <script src="../assets/js/lunar.js"></script>
        <!-- For load hold start page -->
		<script src="../assets/js/loader.js"></script>
        <!-- For modal design -->
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For back to top function -->
		<script>
			var hash = window.location.hash;
			if(hash == '#successModal') {
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

