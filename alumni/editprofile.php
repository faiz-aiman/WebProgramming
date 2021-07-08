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
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/icon" />
    <!-- External styling -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- External styling ends -->
    <!-- To style modal function -->
    <link rel="stylesheet" href="../assets/css/lunar.css" />
    <!-- Main style css file for all content !DO NOT REMOVE! -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- To style table data -->
    <link rel="stylesheet" href="../assets/css/tablestyle.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .field-icon{
            float: right;
            margin-right: 15px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
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
	<!-- Fetch profile from database -->
	<?php
		$id = $_SESSION['id'];
		$stmt = $con->prepare("SELECT alumni.username, alumni.email, alumni_profile.title, alumni_profile.fullname, alumni.ic_no, alumni.passport_no, alumni_profile.birthdate, alumni_profile.gender, alumni_profile.religion, alumni_profile.intake_year, alumni_profile.graduate_year, alumni_profile.emp_status, alumni_profile.phone_no, alumni_profile.address, alumni_profile.privacy_contact, alumni_profile.privacy_dob, alumni_profile.privacy_status, alumni_profile.postcode, alumni_profile.state, alumni_profile.country, alumni_profile.profile_pic, academic.academic_level, academic_major.major FROM alumni INNER JOIN alumni_profile ON alumni.id=alumni_profile.alumni_id INNER JOIN academic ON alumni_profile.degree_id=academic.id INNER JOIN academic_major ON alumni_profile.major_id=academic_major.id WHERE alumni_profile.alumni_id=$id");
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		//$address = $row['address'].', '.$row['postcode'].', '.$row['state'].', '.$row['country'];
		$dob = date("d/m/Y", strtotime($row['birthdate'])); 
		if ($row['profile_pic']==NULL){
			$row['profile_pic']='default.png';
		}
	?>
    <div id="page">
        <!-- start of page content div -->
        <div class="row">
            <!-- Start row content -->
            <div class="container">
                <!-- Back to previous page button -->
                <a class="btn btn-primary" href="index.php" style="margin-top: 10px;">&#60;&nbsp;back</a>
                <div class="profile-area">
                    <!-- Start Feature Content -->
                    <h2>Edit Profile</h2>
                    <div class="col">
                        <div class="row">
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="e-profile">
                                            <div class="row">
                                                <!-- Start Header Feature Content -->
                                                <div class="col-12 col-sm-auto mb-3">
                                                    <div class="mx-auto" style="width: 140px;">
                                                        <img src="../images/profileimg/<?php echo $row['profile_pic'] ?>"
                                                            class="d-flex justify-content-center align-items-center rounded"
                                                            style="height: 140px; width: 140px; background-color: rgb(233, 236, 239);"
                                                            alt="profilepicture" id="preview" />
                                                    </div>
                                                </div>
                                                <div>
                                                    <class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                    <form id="register" class="register-form needs-validation" action="updateProfile.php" method="post" enctype="multipart/form-data" novalidate>
                                                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $row['title'].'&nbsp'.$row['fullname']?></h4></h4>
                                                        <p class="mb-0">@<?php echo $row['username'] ?></p>
                                                        <div class="mt-2">
                                                            <input type="file" name="img" class="file"
                                                                accept="image/png, image/jpeg" />
                                                            <a type="file" class="browse btn btn-primary"
                                                                id="file">
                                                                <i class="fa fa-fw fa-camera"></i>
                                                                <span>Change Photo</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a href="javascript:void(0)" rel="settings" class="active nav-link" style="color: #495057">Settings</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)" rel="privacy" class="nav-link" style="color: #495057">Privacy</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)" rel="changePassword" class="nav-link" style="color: #495057">Change Password</a>
                                                </li>
                                            </ul>
                                            <!-- Header Feature Content ends -->
                                            <!-- Start event information content -->
                                            <!-- Start form for the user profile -->
                                            <div class="tab-content pt-3">
                                                <div id="settings" class="tab-pane active">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-sm-3 md">
                                                                        <div class="form-group">
                                                                            <label>Title</label>
                                                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="title">
																				<option selected value="" disabled>Please choose...</option>
                                                                                <option value="Mr" <?php if ($row['title'] == "Mr") echo 'selected="selected"'; ?>>Mr</option>
                                                                                <option value="Mrs" <?php if ($row['title'] == "Mrs") echo 'selected="selected"'; ?>>Mrs</option>
                                                                                <option value="Ms" <?php if ($row['title'] == "Ms") echo 'selected="selected"'; ?>>Ms</option>
                                                                                <option value="Doctor" <?php if ($row['title'] == "Doctor") echo 'selected="selected"'; ?>>Doctor</option>
                                                                                <option value="Prof" <?php if ($row['title'] == "Prof") echo 'selected="selected"'; ?>>Prof</option>
                                                                                <option value="Tan Sri" <?php if ($row['title'] == "Tan Sri") echo 'selected="selected"'; ?>>Tan Sri</option>
                                                                                <option value="Puan Sri" <?php if ($row['title'] == "Puan Sri") echo 'selected="selected"'; ?>>Puan Sri</option>
                                                                                <option value="Dato" <?php if ($row['title'] == "Dato") echo 'selected="selected"'; ?>>Dato</option>
                                                                                <option value="Datuk" <?php if ($row['title'] == "Datuk") echo 'selected="selected"'; ?>>Datuk</option>
                                                                                <option value="Datin" <?php if ($row['title'] == "Datin") echo 'selected="selected"'; ?>>Datin</option>
                                                                                <option value="Datin Sri" <?php if ($row['title'] == "Datin Sri") echo 'selected="selected"'; ?>>Datin Sri</option>
                                                                                <option value="Datuk Seri" <?php if ($row['title'] == "Datuk Seri") echo 'selected="selected"'; ?>>Datuk Seri</option>
                                                                                <option value="Tun" <?php if ($row['title'] == "Tun") echo 'selected="selected"'; ?>>Tun</option>
                                                                                <option value="Toh Puan" <?php if ($row['title'] == "Toh Puan") echo 'selected="selected"'; ?>>Toh Puan</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Full Name</label>
                                                                            <input class="form-control" type="text"
                                                                                name="name"
                                                                                value="<?php echo $row['fullname'] ?>"
                                                                                disabled/>
                                                                            <small>Please contact administrator to
                                                                                change your name.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Username</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="inputGroupPrepend">@</span>
                                                                                </div>
                                                                                <input class="form-control" type="text"
                                                                                    name="username" pattern=".{4,20}"
                                                                                    value="<?php echo $row['username']?>" />
																				<div class="invalid-tooltip">
																					<div id="defaultmessage">Please enter a valid username. Your username must be between four and 20 characters only.</div>
																					<div id="message"></div>
																				</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label><?php if($row['ic_no']!=NULL){echo 'IC Number';}else{echo 'Passport Number';} ?></label>
                                                                            <input class="form-control" type="text"
                                                                                name="idnumber" value="<?php if($row['ic_no']!=NULL){echo $row['ic_no'];}else{echo $row['passport_no'];} ?>"
                                                                                disabled />
                                                                            <small>Please contact administrator to
                                                                                change your <?php if($row['ic_no']!=NULL){echo 'IC Number';}else{echo 'Passport Number';} ?>.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Date of Birth</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="inputdate"><i
                                                                                            class="fa fa-calendar"></i></span>
                                                                                </div>
                                                                                <input style="background-color: #fff !important; cursor: pointer;" class="form-control" id="datepicker" type="text" name="date" value="<?php echo $dob ?>" <?php if($row['ic_no']!=NULL){echo 'disabled';} ?>
                                                                                readonly="readonly" />
																				<?php if($row['ic_no']!=NULL){
																					echo '<input type="text" name="icnum" value="'.$dob.'" hidden/>';
																				} ?>
																				
                                                                            </div>
                                                                            <?php if($row['ic_no']!=NULL){echo '<small> This data retrieved from the IC Number.</small>';}?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Email</label>
                                                                            <div class="input-group">
                                                                                <input type="email" class="form-control" 
                                                                                    name="email" id="email" 
                                                                                    value="<?php echo $row['email'] ?>" required/>
                                                                                <div class="invalid-tooltip">
																					<div id="defaultmessageemail">Please enter a valid email address.</div>
																					<div id="messageemail"></div>
																				</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Gender</label>
                                                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="gender" name="gender">
																				<option selected value="" disabled>Please choose...</option>
                                                                                <option value="Male" <?php if ($row['gender'] == "Male") echo 'selected="selected"'; ?>>Male
                                                                                </option>
                                                                                <option value="Female" <?php if ($row['gender'] == "Female") echo 'selected="selected"'; ?>>Female</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Religion</label>
                                                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="religion" name="religion">
																				<option selected value="" disabled>Please choose...</option>
                                                                                <option value="Islam" <?php if ($row['religion'] == "Islam") echo 'selected="selected"'; ?>>Islam
                                                                                </option>
                                                                                <option value="African Traditional &amp; Diasporic" <?php if ($row['religion'] == "African Traditional &amp; Diasporic") echo 'selected="selected"'; ?>>
                                                                                    African Traditional &amp; Diasporic
                                                                                </option>
                                                                                <option value="Agnostic" <?php if ($row['religion'] == "Agnostic") echo 'selected="selected"'; ?>>Agnostic
                                                                                </option>
                                                                                <option value="Atheist" <?php if ($row['religion'] == "Atheist") echo 'selected="selected"'; ?>>Atheist</option>
                                                                                <option value="Baha'i" <?php if ($row['religion'] == "Baha'i") echo 'selected="selected"'; ?>>Baha'i</option>
                                                                                <option value="Buddhism" <?php if ($row['religion'] == "Buddhism") echo 'selected="selected"'; ?>>Buddhism
                                                                                </option>
                                                                                <option value="Cao Dai" <?php if ($row['religion'] == "Cao Dai") echo 'selected="selected"'; ?>>Cao Dai</option>
                                                                                <option value="Chinese traditional religion" <?php if ($row['religion'] == "Chinese traditional religion") echo 'selected="selected"'; ?>>
                                                                                    Chinese traditional religion
                                                                                </option>
                                                                                <option value="Christianity" <?php if ($row['religion'] == "Christianity") echo 'selected="selected"'; ?>>
                                                                                    Christianity</option>
                                                                                <option value="Hinduism" <?php if ($row['religion'] == "Hinduism") echo 'selected="selected"'; ?>>Hinduism
                                                                                </option>
                                                                                <option value="Jainism" <?php if ($row['religion'] == "Jainism") echo 'selected="selected"'; ?>>Jainism</option>
                                                                                <option value="Juche" <?php if ($row['religion'] == "Juche") echo 'selected="selected"'; ?>>Juche</option>
                                                                                <option value="Judaism" <?php if ($row['religion'] == "Judaism") echo 'selected="selected"'; ?>>Judaism</option>
                                                                                <option value="Neo-Paganism" <?php if ($row['religion'] == "Neo-Paganism") echo 'selected="selected"'; ?>>
                                                                                    Neo-Paganism</option>
                                                                                <option value="Nonreligious" <?php if ($row['religion'] == "Nonreligious") echo 'selected="selected"'; ?>>
                                                                                    Nonreligious</option>
                                                                                <option value="Rastafarianism" <?php if ($row['religion'] == "Rastafarianism") echo 'selected="selected"'; ?>>
                                                                                    Rastafarianism</option>
                                                                                <option value="Secular" <?php if ($row['religion'] == "Secular") echo 'selected="selected"'; ?>>Secular</option>
                                                                                <option value="Shinto" <?php if ($row['religion'] == "Shinto") echo 'selected="selected"'; ?>>Shinto</option>
                                                                                <option value="Sikhism" <?php if ($row['religion'] == "Sikhism") echo 'selected="selected"'; ?>>Sikhism</option>
                                                                                <option value="Spiritism" <?php if ($row['religion'] == "Spiritism") echo 'selected="selected"'; ?>>Spiritism
                                                                                </option>
                                                                                <option value="Tenrikyo" <?php if ($row['religion'] == "Tenrikyo") echo 'selected="selected"'; ?>>Tenrikyo
                                                                                </option>
                                                                                <option value="Unitarian-Universalism" <?php if ($row['religion'] == "Unitarian-Universalism") echo 'selected="selected"'; ?>>
                                                                                    Unitarian-Universalism</option>
                                                                                <option value="Zoroastrianism" <?php if ($row['religion'] == "Zoroastrianism") echo 'selected="selected"'; ?>>
                                                                                    Zoroastrianism</option>
                                                                                <option value="primal-indigenous" <?php if ($row['religion'] == "primal-indigenous") echo 'selected="selected"'; ?>>
                                                                                    primal-indigenous</option>
                                                                                <option value="Other" <?php if ($row['religion'] == "Other") echo 'selected="selected"'; ?>>Other</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Course</label>
                                                                            <input class="form-control" type="text"
                                                                                placeholder="<?php echo $row['academic_level'] ?>"
                                                                                disabled />
                                                                            <small>This data retrieved from the <?php if($row['ic_no']!=NULL){echo 'IC Number';}else{echo 'Passport Number';} ?>.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Major</label>
                                                                            <input class="form-control" type="text"
                                                                                placeholder="<?php echo $row['major'] ?>"
                                                                                disabled />
                                                                            <small>This data retrieved from the <?php if($row['ic_no']!=NULL){echo 'IC Number';}else{echo 'Passport Number';} ?>.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Registration year</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="registrationdate"> <i
                                                                                            class="fa fa-calendar"></i></span>
                                                                                </div>
                                                                                <input class="form-control" type="text"
                                                                                    name="date" value="<?php echo $row['intake_year'] ?>"
                                                                                    disabled />
                                                                            </div>

                                                                            <small>This data retrieved from the <?php if($row['ic_no']!=NULL){echo 'IC Number';}else{echo 'Passport Number';} ?>.</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Graduation year</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"
                                                                                        id="graduationdate"><i class="fa fa-calendar"></i></span>
                                                                                </div>
                                                                                <input class="form-control" type="text"
                                                                                    name="date" value="<?php echo $row['graduate_year'] ?>"
                                                                                    disabled />
                                                                            </div>
                                                                            <small>This data retrieved from the <?php if($row['ic_no']!=NULL){echo 'IC Number';}else{echo 'Passport Number';} ?>.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="status">
																				<option selected value="" disabled>Please choose...</option>
                                                                                <option value="working" <?php if ($row['emp_status'] == "Working") echo 'selected="selected"'; ?>>Working
                                                                                </option>
                                                                                <option value="unemployed" <?php if ($row['emp_status'] == "Unemployed") echo 'selected="selected"'; ?>>Unemployed
                                                                                </option>
                                                                                <option value="furtherstudy" <?php if ($row['emp_status'] == "Furtherstudy") echo 'selected="selected"'; ?>>Further
                                                                                    Study</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <div class="form-group">
                                                                            <label>Phone number</label>
                                                                            <div class="input-group">
																				<input type="text" id="countryphone" name="countryphone" hidden/>
                                                                                <input class="form-control" type="text"
                                                                                    name="phonenumber"
                                                                                    value="<?php echo $row['phone_no'] ?>" />
                                                                                <div class="invalid-tooltip">
                                                                                    Please enter a valid phone number
                                                                                    without country code (+6).
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
																	<div class="col-md">
																		<label for="address">Current Address</label>
																		<input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address'] ?>" autocomplete="off" minlength="4" required />
																	</div>
																</div>
																<br />
																<div class="row">
																	<div class="col-md-3">
																		<label for="postcode">Postcode</label>
																		<input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $row['postcode'] ?>" autocomplete="off" pattern="^(?!^0+$)[a-zA-Z0-9]{5,13}$" required />
																	</div>
																	<div class="col-md-4">
																		<label for="country">Country</label>
																		<select id="country" name="country" class="custom-select mb-2 mr-sm-2 mb-sm-0" required>
																		</select>
																	</div>
																	<div class="col-md-5">
																		<label for="state">State</label>
																		<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="state" name="state" autocomplete="off" required/></select>
																	</div>
																</div>
															<br>
                                                            </div>
                                                        </div>
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
                                                                                    <h5>Are you sure to change?</h5>
                                                                                    <p style="text-align: center;">This action cannot be undone.</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button id="registerbutton" class="btn btn-cstm-danger" type="submit">Continue</button>
                                                                                <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    </form>
                                                    <div class="row">
														<form action="deleteAccount.php" method="post" style="display: inline;">
                                                            <input type="id" value="<?php echo $id ?>" name="id" id="id" hidden>
                                                            <div class="modal fade" id="deletealertmessage" tabindex="-1" role="dialog" aria-labelledby="alertmessage" aria-hidden="true">
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
                                                                                <h5>Are you sure to delete your account?</h5>
                                                                                <p style="text-align: center; color: red;">REMEMBER! This action cannot be
                                                                                    undone.</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-cstm-danger">Continue</button>
                                                                            <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <a class="btn btn-danger" style="float: left"
                                                            data-toggle="modal" data-target="#deletealertmessage">Delete
                                                            Account</a>
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#alertmessage">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="privacy" class="tab-pane">
                                                    <form class="register-form needs-validation" action="updatePrivacy.php" method="post"
                                                        novalidate>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Show contact and address details</label>
																			<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="contactprivacy" name="contactprivacy">
                                                                                <option value="0" <?php if ($row['privacy_contact'] == 0) echo 'selected="selected"'; ?>>Only Me
                                                                                </option>
                                                                                <option value="1" <?php if ($row['privacy_contact'] == 1) echo 'selected="selected"'; ?>>My Connections</option>
                                                                                <option value="2" <?php if ($row['privacy_contact'] == 2) echo 'selected="selected"'; ?>>Public</option>
                                                                            </select>
                                                                        </div>
																		<div class="form-group">
                                                                            <label>Date of birth detail</label>
                                                                            <select
                                                                                class="custom-select mb-2 mr-sm-2 mb-sm-0"
                                                                                id="dobprivacy" name="dobprivacy">
                                                                                <option value="0" <?php if ($row['privacy_dob'] == 0) echo 'selected="selected"'; ?>>Only Me
                                                                                </option>
                                                                                <option value="1" <?php if ($row['privacy_dob'] == 1) echo 'selected="selected"'; ?>>My Connections</option>
                                                                                <option value="2" <?php if ($row['privacy_dob'] == 2) echo 'selected="selected"'; ?>>Public</option>
                                                                            </select>
                                                                        </div>
																		<div class="form-group">
                                                                            <label>Current status detail</label>
                                                                            <select
                                                                                class="custom-select mb-2 mr-sm-2 mb-sm-0"
                                                                                id="statusprivacy" name="statusprivacy" >
                                                                                <option value="0" <?php if ($row['privacy_status'] == 0) echo 'selected="selected"'; ?>>Only Me
                                                                                </option>
                                                                                <option value="1" <?php if ($row['privacy_status'] == 1) echo 'selected="selected"'; ?>>My Connections</option>
                                                                                <option value="2" <?php if ($row['privacy_status'] == 2) echo 'selected="selected"'; ?>>Public</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<div class="modal fade" id="privacyalertmessage" tabindex="-1" role="dialog" aria-labelledby="alertmessage" aria-hidden="true">
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
                                                                                    <h5>Are you sure to change?</h5>
                                                                                    <p style="text-align: center;">This action cannot be undone.</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-cstm-danger" type="submit">Continue</button>
                                                                                <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#privacyalertmessage">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="changePassword" class="tab-pane">
                                                    <form class="register-form needs-validation" action="updatePassword.php" method="post" novalidate>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="oldpassword">Current Password</label>
                                                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Password" autocomplete="off" required />
                                                                        <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                                        <div class="invalid-tooltip">
                                                                        Please enter your current password.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="password">New Password</label>
                                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required />
                                                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                                        <div class="invalid-tooltip">
                                                                        Please enter a password between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="matchpassword">Confirm Password</label>
                                                                        <input type="password" class="form-control" id="matchpassword" name="matchpassword" placeholder="Password" autocomplete="off" required />
                                                                        <span toggle="#matchpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                                        <div class="invalid-tooltip">
                                                                            Those passwords didn’t match. Try again.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<div class="modal fade" id="passwordalertmessage" tabindex="-1" role="dialog" aria-labelledby="passwordalertmessage" aria-hidden="true">
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
                                                                            <h5>Are you sure to change?</h5>
                                                                            <p style="text-align: center;">This action cannot be undone.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-cstm-danger" type="submit">Continue</button>
                                                                        <a href="#" class="btn btn-cstm-secondary" data-dismiss="modal" aria-label="Close">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#passwordalertmessage">Save Changes</button>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- form for the user ends -->
                        <!-- Modal for succesful to edit -->
                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                            aria-labelledby="successModal" aria-hidden="true">
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
                                                        <path fill="#ffffff"
                                                            d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <h4 class="pt-4">Your profile has been modified.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Both modal Ends -->
                        <!-- End Feature Content -->
                    </div>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    <!-- For image preview -->
    <script src="../assets/js/imgpreview.js"></script>
    <!-- For navtab-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
	<script src="../assets/js/intlTelInput.min.js"></script>
	<script src="../assets/js/countries.js"></script>
		<script>
			populateCountriesEdit("country", "state", "<?php echo $row['country'] ?>", "<?php echo $row['state'] ?>"); 
		</script>
        <script>
            var maxBirthdayDate = new Date();
            maxBirthdayDate.setFullYear(maxBirthdayDate.getFullYear() - 18);
            maxBirthdayDate.setMonth(11, 31);
            $("#datepicker").datepicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true,
                maxDate: maxBirthdayDate,
                yearRange: "1950:" + maxBirthdayDate.getFullYear(),
            });
        </script>
	
	<script>
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
				preferredCountries: ["my", "us", "gb", "cn"],
				hiddenInput: "full_phone",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
			$('#phone').on('focus', function(){
				var $this = $(this),
				// Get active country's phone number format from input placeholder attribute
				activePlaceholder = $this.attr('placeholder'),
				// Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
				newMask = activePlaceholder.replace(/[1-9]/g, "0");
				// console.log(activePlaceholder + ' => ' + newMask);

				// Init new mask for focused input
				$this.mask(newMask);
			});
      </script>
    <script>
        $(".e-profile > ul > li > a").on('click', function () {
            var targetPT = $(this).attr("rel");
            $("#" + targetPT).addClass("active").siblings("div").removeClass("active");

            $(".e-profile > ul > li > a.active").removeClass("active");
            $(this).addClass("active");
        });

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
		var hash = window.location.hash;
        if (hash == '#successModal') {
            setTimeout(function() {
                $(hash).modal('show');
            }, 500);
        };
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
                            <a class="facebook" href="https://www.facebook.com/CARIAUM"><i
                                    class="fa fa-facebook"></i></a>
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