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
		<?php
        $stmt = $con->prepare("SELECT `id`, `title` , `description`,  `date_start`, `photo` FROM `event` WHERE date_start>NOW() ORDER BY date_start LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0 ){
            $row = $result->fetch_assoc();
            $latestDate = date("F d, Y H:i:s", strtotime($row['date_start'])); 
            $latestEventID = $row['id'];  
			if($row['photo']!=NULL){
				$photo = $row['photo'];
			}else{
				$photo = 'default-event-photo.png';
			}
            $title = $row['title'];  
            $desc = $row['description'];
        }                                
    ?>
        <div id="page">
            <!-- start of page content div -->
            <div class="row">
                <!-- Start row content -->
                <div class="container">
                    <div class="profile-area">
                        <!-- Start Feature Content -->
                        <div class="center">
                            <h2>UPCOMING EVENT</h2>
                        </div>
                       <div class="latest">
                            <div class="latest-area">
                                <div class="row">
                                    <div class="col">
                                        <img class="image" src="../images/event/<?php echo $photo ?>" alt="Annual Dinner Alumni" height="500px" width="450px" />
                                    </div>
                                    <div class="col-6">
                                        <div class="latest-description">
                                            <div class="countdown">
                                                <div id="day" class="day">NA</div>
                                                <div id="hour" class="hour">NA</div>
                                                <div id="minute" class="minute">NA</div>
                                                <div id="second" class="second">NA</div>
                                            </div>
                                            <h2 style="margin-bottom: 20px;line-height: 30px;"><?php echo $title?></h2>
                                            <p>
                                                <?php echo $desc ?>
                                            </p>
                                            <?php echo '<a href="eventdetail.php?eventID=', $latestEventID,'" class="btn btn-primary" style="float: right; margin-top: 10px;">View Details</a>';?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventlist">
                            <div class="eventlist-area">
                                <div class="leftBox">
                                    <div class="content">
                                        <h1>All Alumni Event</h1>
                                        <p>
                                            The spirit of alumniship is kept alive and vibrant in UM as long as alumni stay connected - one alumnus with one another, each alumni with many others and between alumni and their alma mater.
                                            Connected through shared memories, experiences and relationships the bond between alumni and their alma mater is for life.
                                        </p>
                                    </div>
                                </div>
                                <div class="events">
                                    <ul>
										<?php 
                                            $stmt = $con->prepare("SELECT `id`, `title` , `description`,  `date_start`, `photo` FROM `event` WHERE date_start>NOW() AND `id`!= $latestEventID ORDER BY date_start LIMIT 2");
											$stmt->execute();
											$result = $stmt->get_result();
                                            
                                            //start while loop
                                            while($row = $result->fetch_assoc()){
                                                $date = date_create($row['date_start']);
                                                $day = date_format($date, "j");
                                                $month = date_format($date, "F");

                                            echo '<li>
                                                <div class="time">
                                                    <h2>
                                                        ',$day,'<br/><span>', $month ,'</span>
                                                    </h2>
                                                </div>
                                                <div class="details">
                                                    <h3>', $row['title'], '</h3>
                                                    <p>',$row['description'], '</p>
                                                    <a href="eventdetail.php?eventID=',$row['id'],'" class="btn btn-primary" style="float: right; margin-top: 10px;">View Details</a>'
        
                                            ;}//end while
                                           echo '</div>  
                                             </li>' 
                                        ?>
                                    </ul>
									<a href="eventlist.php" style="float: right" class="btn btn-primary">View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Feature Content -->
                </div>
                <!-- End of row content -->
            </div>
        </div>
        <!-- End of page content div -->

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
        <!-- For modal design -->
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <script type="text/javascript" src="../assets/js/backtotopscroll.js"></script>
        <!-- For back to top function -->
        <!-- For image preview -->
        <script src="../assets/js/imgpreview.js"></script>
        <script>
            var countDate = new Date("<?php echo $latestDate;?>").getTime();

            function newTime() {
                var now = new Date().getTime();
                gap = countDate - now;
                var second = 1000;
                var minute = second * 60;
                var hour = minute * 60;
                var day = hour * 24;

                var d = Math.floor(gap / day);
                var h = Math.floor((gap % day) / hour);
                var m = Math.floor((gap % hour) / minute);
                var s = Math.floor((gap % minute) / second);

                document.getElementById("day").innerText = d;
                document.getElementById("hour").innerText = h;
                document.getElementById("minute").innerText = m;
                document.getElementById("second").innerText = s;
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