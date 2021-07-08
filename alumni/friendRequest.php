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
    <!-- To style table data -->
    <link rel="stylesheet" href="../assets/css/tablestyle.css" />
</head>
<header>
    <!-- Navigation start -->
    <div class="topnav">
        <div class="infotopnav">
            <h5>Welcome, <?php echo $_SESSION['title'], '&nbsp;', $_SESSION['fullname'] ?>!</h5>
        </div>
        <div class="btn-navbar">
            <a href="../logout.php" class="btn btn-3">
                <span class="txt">Logout</span>
                <span class="round"><i class="fa fa-chevron-right"></i></span>
            </a>
        </div>
        <?php include("../notification.php") ?>
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
        $friend_req = $con->prepare("SELECT alumni_profile.fullname, friend_list.sender_id, friend_list.date_requested FROM friend_list INNER JOIN alumni_profile ON alumni_profile.alumni_id=friend_list.sender_id WHERE receiver_id = $userID AND approval_status = 1");
        $friend_req->execute();
        $req_res = $friend_req->get_result();
        $countrow = $req_res->num_rows;
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
                                <li>
                                    <a href="alumni.php"><i class="fa fa-users"></i>All Alumni</a>
                                </li>
                                <li>
                                    <a href="friend.php"><i class="fas fa-user-friends"></i>Friends</a>
                                </li>
                                <li class="active">
                                    <a href="#" class="active"><i class="fa fa-user-plus"></i>Friend Requests</a>
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
                    <div class="page-area">
                        <!-- Start Feature Content -->
                        <h2>Friend Requests</h2>
                        <input type="text" id="myInput" onkeyup="search()" placeholder="Search requests.." title="Type in a name" />
                        <!-- Table pending user start -->
                        <div class="userrequest">
                            <table id="table" class="overflow-y">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>REQUEST DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="display: none;" id="noresultstable">
                                        <td colspan="4" style="text-align: center">
                                            <span style="font-size: 23px;">Sorry... No results found.</span><br>
                                            <span style="text-align: center">Double check your search for any typos or spelling errors - or try a different search term.</span>
                                        </td>
                                    </tr>

                                    <?php
                                    if ($countrow < 1) {
                                        echo '<tr><td colspan="4" style="text-align: center">No new requests as for now.</td></tr>';
                                    } else {
                                        function timeAgo($timeago){
                                            $time_ago = strtotime($timeago) + 7249;
                                            $cur_time   = time() + 28800;
                                            $time_elapsed   = $cur_time - $time_ago;
                                            $seconds    = $time_elapsed;
                                            $minutes    = round($time_elapsed / 60);
                                            $hours      = round($time_elapsed / 3600);
                                            $days       = round($time_elapsed / 86400);
                                            $weeks      = round($time_elapsed / 604800);
                                            $months     = round($time_elapsed / 2600640);
                                            $years      = round($time_elapsed / 31207680);
                                            // Seconds
                                            if ($seconds <= 60) {
                                                return "Just now";
                                            }
                                            //Minutes
                                            else if ($minutes <= 60) {
                                                if ($minutes == 1) {
                                                    return "One minute ago";
                                                } else {
                                                    return "$minutes minutes ago";
                                                }
                                            }
                                            //Hours
                                            else if ($hours <= 24) {
                                                if ($hours == 1) {
                                                    return "An hour ago";
                                                } else {
                                                    return "$hours hrs ago";
                                                }
                                            }
                                            //Days
                                            else if ($days <= 7) {
                                                if ($days == 1) {
                                                    return "Yesterday";
                                                } else {
                                                    return "$days days ago";
                                                }
                                            }
                                            //Weeks
                                            else if ($weeks <= 4.3) {
                                                if ($weeks == 1) {
                                                    return "A week ago";
                                                } else {
                                                    return "$weeks weeks ago";
                                                }
                                            }
                                            //Months
                                            else if ($months <= 12) {
                                                if ($months == 1) {
                                                    return "A month ago";
                                                } else {
                                                    return "$months months ago";
                                                }
                                            }
                                            //Years
                                            else {
                                                if ($years == 1) {
                                                    return "One year ago";
                                                } else {
                                                    return "$years years ago";
                                                }
                                            }
                                        }
                                        while ($row = $req_res->fetch_array(MYSQLI_ASSOC)) {
                                            $date = date("Y-m-d H:m:s", strtotime($row['date_requested']));
                                            echo '<tr>', '<td><a style="color:black" href="alumnidetail.php?alumniID=', $row['sender_id'], '"><u>', $row['fullname'], '</u></a></td>';
                                            echo '<td>', timeAgo($date);
                                            '</td>';
                                            echo '<td>
												<form action="acceptFriend.php" method="post">
												<input type="id" value="', $row['sender_id'], '" name="senderID" hidden>
												<!-- Modal for warning admin from any action event -->
												<div class="modal fade" id="alertmessage', $row['sender_id'], '" tabindex="-1" role="dialog" aria-labelledby="alertmessage', $row['sender_id'], '" aria-hidden="true">
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
																	<h5>Accept ', $row['fullname'], ' friend request?</h5>
																	<p style="text-align: center;">This action cannot be undone.</p>
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" name="accept" class="btn btn-cstm-danger">Continue</button>
																<a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
															</div>
														</div>
													</div>
												</div>
												<!-- Modal for warning admin from any action event ends-->
												</form>
												<form action="acceptFriend.php" method="post">
												<input type="id" value="', $row['sender_id'], '" name="senderID" hidden>
												<!-- Modal for warning admin from any action event -->
												<div class="modal fade" id="alertmessagereject', $row['sender_id'], '" tabindex="-1" role="dialog" aria-labelledby="alertmessagereject', $row['sender_id'], '" aria-hidden="true">
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
																			<h5>Reject friend request from ', $row['fullname'], '?</h5>
																			<p style="text-align: center;">This action cannot be undone.</p>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="submit" name="reject" class="btn btn-cstm-danger">Continue</button>
																		<a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
																	</div>
																</div>
															</div>
														</div>
														<!-- Modal for warning admin from any action event ends-->
												</form>
												<button class="btn btn-primary" data-toggle="modal" data-target="#alertmessage', $row['sender_id'], '">Accept</button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#alertmessagereject', $row['sender_id'], '">Reject</button>
												</td></tr>';
                                        }
                                    } //end count check
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table pending user ends -->
                        <!-- Modal -->
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
                                            <h4 class="pt-4"><?php if ($_GET['removeID'] == 1) {
                                                                    echo 'The request has been removed in your request list.';
                                                                } else {
                                                                    echo 'The user successfully added in your friendlist.';
                                                                } ?></h4>
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
                                            <h4 class="pt-4" style="color: red">Fail to reject. Please contact administrator.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End for both modal -->
                    </div>
                    <!-- End Feature Content -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://kit.fontawesome.com/ce95fe7de4.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
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
    <script>
        var hash = window.location.hash;
        if (hash == '#successModal') {
            setTimeout(function() {
                $(hash).modal('show');
            }, 500);
        } else if (hash == '#failModal') {
            setTimeout(function() {
                $(hash).modal('show');
            }, 500);
        }
    </script>

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