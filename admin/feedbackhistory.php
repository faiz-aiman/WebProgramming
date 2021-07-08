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
        <!-- To style table data -->
        <link rel="stylesheet" href="../assets/css/tablestyle.css" />
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
					<a href="manageuser.php">MANAGE USER</a>
                    <a href="event.php">EVENT</a>
					<a class="current" href="#">FEEDBACK</a>
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
                                    <li>
                                        <a href="feedback.php"><i class="fa fa-tasks"></i>Pending</a>
                                    </li>
                                    <li class="active">
                                        <a href="#" class="active"><i class="fa fa-archive"></i>History</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Side Navigation Content -->
                        </div>
                    </div>
                </div>
                <div class="col-md-10 padding-1">
                    <!-- Start 2nd column content -->
                    <div class="container">
                        <div class="page-area">
                            <!-- Start Feature Content -->
                            <h2>History feedback</h2>
                            <input type="text" id="myInput" onkeyup="search()" placeholder="Search for name.." title="Type in a name" />
                            <!-- Table pending user start -->
                            <div class="userrequest">
                                <table id="table" class="overflow-y">
                                    <thead>
                                        <tr>
                                            <th width="20%">Email</th>
                                            <th width="20%">Name</th>
                                            <th width="40%">Feedback</th>
                                            <th width="20%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$stmt = $con->prepare("SELECT `id`, `name` , `email`, `feedback` FROM `feedback` WHERE readstatus=1");
											$stmt->execute();
											$result = $stmt->get_result();
											while ($row = $result->fetch_array(MYSQLI_ASSOC)){
												echo '<tr>', '<td>', $row['email'], '</td>';
												echo '<td>', $row['name'], '</td>';
												echo '<td>', $row['feedback'], '</td>';
												echo '<td><a class="btn btn-success" href="feedbackdetails.php?reportID=', $row['id'],'">Email</button></td></tr>';}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table pending user ends -->
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
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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