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
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/icon" />
        <!-- External styling -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" media="all" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- External styling ends -->
        <!-- Main style css file for all content !DO NOT REMOVE! -->
        <link rel="stylesheet" href="../assets/css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
        <style>
            .progress {
                width: 100%;
                max-width: 360px;
                height: 10px;
                background: #e1e4e8;
                border-radius: 3px;
                overflow: hidden;
                margin-bottom: 20px;
            }
            .progress .progress-bar {
                display: block;
                height: 100%;
                background: linear-gradient(90deg, #ffd33d, #ea4aaa 17%, #b34bff 34%, #01feff 51%, #ffd33d 68%, #ea4aaa 85%, #b34bff);
                background-size: 300% 100%;
                -webkit-animation: progress-animation 2s linear infinite;
                animation: progress-animation 2s linear infinite;
            }

            @-webkit-keyframes progress-animation {
                0% {
                    background-position: 100%;
                }
                100% {
                    background-position: 0;
                }
            }

            @keyframes progress-animation {
                0% {
                    background-position: 100%;
                }
                100% {
                    background-position: 0;
                }
            }
            .col-center-block {
                text-align: left;
                float: none;
                display: block;
                margin: 0 20%;
            }

            @media screen and (max-width: 530px) {
                .col-center-block {
                    margin: 0 auto;
                }
            }
        </style>
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
    </header>
    <body>
		<?php
			$id=$_SESSION["id"];
			$stmt = $con->prepare("SELECT ic_no, email FROM alumni WHERE id=$id");
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			if($row['ic_no']!=NULL){
				$dob=$row['ic_no'];
				$year=substr($dob,0,2);
				$checkyear = date("Y");
				$checkyear = substr($checkyear,2,3);
				if($year>$checkyear){
					$year='19'.$year;
				}else{
					$year='20'.$year;
				}
				$month=substr($dob,2,2);
				$day=substr($dob,4,2);
				$ic = strtotime($year.'/'.$month.'/'.$day);
				$dob = date("d/m/Y",$ic);
				$email=$row['email'];
			}
			//EXAMPLE FOR FILE UPLOAD IMG. MAKE SURE DOWNLOAD THE NEW DATABASE SQL AND CHANGE THE CURRENT DATABASE SQL. 
			if(isset($_POST['submit'])){
			$statusMsg = '';
			// File upload path
			$id = $_SESSION['id'];
			//CHANGE TO DIRECTORY. PROFILEIMG ONLY FOR PROFILEIMG. IF JOB, THEN CREATE NEW FOLDER JOB. MAKE SURE PERMISSION ALL. 
			$targetDir = "../images/profileimg/";
			$fileName = $_FILES['profileimg']['name'];
			$unique_file_name = time(). $_SERVER['REMOTE_ADDR']. $_FILES['profileimg']['name']; 
			$targetFilePath = $targetDir;
				// Upload file to server
				if(move_uploaded_file($_FILES['profileimg']['tmp_name'], $targetFilePath.$id.$unique_file_name)){
					// Insert image file name into database
					$insert = $con->query("UPDATE alumni_profile SET profile_pic='$fileName' WHERE alumni_id=$id");
					//MAY REMOVE THIS PART FOR ECHO PURPOSE ONLY FOR CHECK. 
					if($insert){
						$statusMsg = "The file has been uploaded successfully.";
					}else{
						$statusMsg = "File upload failed, please try again.";
					} 
				}else{
					$statusMsg = "Sorry, there was an error uploading your file.";
				}
			// Display status message
			echo $statusMsg;
			}
		?>
        <div id="page">
            <div class="container">
                <div class="profile-area">
                    <center>
                        <h2 style="font-size: 16px; padding: 10px; margin-bottom: 20px;">Please complete your profile to proceed</h2>
                        <br />
                        Your progress...<br />
                        <div class="progress">
                            <span class="progress-bar" style="width: 75%;"></span>
                        </div>
                    </center>
                    <div class="row">
                        <div class="col-center-block">
                            <form id="register" action="updateProfile.php" class="register-form needs-validation" method="post" novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-9">
										<div class="form-group">
                                        <label><strong>Profile Picture: </strong></label>
                                        <input type="file" name="profileimg" class="file" accept="image/png, image/jpeg" />
                                        <div class="input-group">
                                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file" />
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-primary">Browse...</button>
                                            </div>
                                        </div>
										</div>
                                        <small>This photo will be visible to other alumni. If you didn't upload any, the system will set to default photo. You may change later.</small>
                                    </div>
                                    <div class="col-sm-3 my-auto" style="padding-bottom: 10px;">
                                        <label><strong>Preview: </strong></label>
                                        <img src="../images/profileimg/default.png" id="preview" class="img-thumbnail" alt="event-thumbnail" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Title*</label><br />
                                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="title" required>
                                            <option value="" selected disabled>Salutation</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Prof">Prof</option>
                                            <option value="Tan Sri">Tan Sri</option>
                                            <option value="Puan Sri">Puan Sri</option>
                                            <option value="Dato">Dato</option>
                                            <option value="Datuk">Datuk</option>
                                            <option value="Datin">Datin</option>
                                            <option value="Datin Sri">Datin Sri</option>
                                            <option value="Datuk Seri">Datuk Seri</option>
                                            <option value="Tun">Tun</option>
                                            <option value="Toh Puan">Toh Puan</option>
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <label for="phonenumber"><i class="fa fa-lock">&nbsp;</i>Phone Number&#42; </label>
										<input type="text" id="countryphone" name="countryphone" hidden/>
                                        <input type="tel" class="form-control mb-2" id="phone" name="phonenumber" required />
                                    </div>
                                    <div class="col-md">
                                        <label>Gender&#42;</label>
                                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="gender" name="gender" required>
                                            <option value="" selected disabled>Please choose...</option>
                                            <option value="Male">Male </option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Religion&#42;</label>
                                            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="religion" name="religion" required>
                                                <option value="" selected disabled>Please choose...</option>
                                                <option value="Islam">Islam </option>
                                                <option value="African Traditional &amp; Diasporic">
                                                    African Traditional &amp; Diasporic
                                                </option>
                                                <option value="Agnostic">Agnostic </option>
                                                <option value="Atheist">Atheist</option>
                                                <option value="Baha'i">Baha'i</option>
                                                <option value="Buddhism">Buddhism </option>
                                                <option value="Cao Dai">Cao Dai</option>
                                                <option value="Chinese traditional religion">
                                                    Chinese traditional religion
                                                </option>
                                                <option value="Christianity"> Christianity</option>
                                                <option value="Hinduism">Hinduism </option>
                                                <option value="Jainism">Jainism</option>
                                                <option value="Juche">Juche</option>
                                                <option value="Judaism">Judaism</option>
                                                <option value="Neo-Paganism"> Neo-Paganism</option>
                                                <option value="Nonreligious"> Nonreligious</option>
                                                <option value="Rastafarianism"> Rastafarianism</option>
                                                <option value="Secular">Secular</option>
                                                <option value="Shinto">Shinto</option>
                                                <option value="Sikhism">Sikhism</option>
                                                <option value="Spiritism">Spiritism </option>
                                                <option value="Tenrikyo">Tenrikyo </option>
                                                <option value="Unitarian-Universalism"> Unitarian-Universalism</option>
                                                <option value="Zoroastrianism"> Zoroastrianism</option>
                                                <option value="primal-indigenous"> primal-indigenous</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><i class="fa fa-lock">&nbsp;</i>Status&#42;</label>
                                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="status" required>
                                            <option selected value="" disabled>Please choose...</option>
                                            <option value="working">Working </option>
                                            <option value="unemployed">Unemployed </option>
                                            <option value="furtherstudy">Further Study</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label><i class="fa fa-lock">&nbsp;</i>Date of Birth&#43;&#42;</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputdate"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" <?php if($row['ic_no']==NULL){ echo 'style="background-color: #fff !important; cursor: pointer;" id="datepicker"';}?> class="form-control" name="date" placeholder="DD/MM/YYYY" <?php if($row['ic_no']!=NULL){echo "value='".$dob."'";} ?>readonly="readonly" required/>
                                        </div>
										 <?php if($row['ic_no']!=NULL){echo '<small>Data retrieved from the IC No.<br></small>';}?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <label for="address"><i class="fa fa-lock">&nbsp;</i>Current Address&#42;</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="" autocomplete="off" minlength="4" required />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="postcode"><i class="fa fa-lock">&nbsp;</i>Postcode&#42;</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" autocomplete="off" pattern="^(?!^0+$)[a-zA-Z0-9]{5,13}$" required />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country"><i class="fa fa-lock">&nbsp;</i>Country&#42;</label>
                                        <select id="country" name="country" class="custom-select mb-2 mr-sm-2 mb-sm-0" required>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="state"><i class="fa fa-lock">&nbsp;</i>State&#42;</label>
                                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="state" name="state" autocomplete="off" required/></select>
                                    </div>
									<input type='text' name="firsttime" value="1" hidden/>
									<input type='text' name="email" value="<?php echo $email?>" hidden/>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-15">
                                        <label>
                                            <small style="color: red; float: right;">
                                                &#40;&#42;&#41; is required input. Please fill in the details<br>
                                                <i class="fa fa-lock">&nbsp;</i>This information will be hidden from other alumni. You can change the visibility in your settings.
												<?php if($row['ic_no']!=NULL){echo '<br>
												&#40;&#43;&#41; retrieved from your Identification Card number. Please contact an administrator if you believe this is an error.';} ?>
                                            </small>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
										<small style="color: red; float: right;" id="error" hidden="true">Please fill in all details with correct format before submitting</small><br>
                                        <button class="btn btn-primary upload" name="submit" style="float: right;">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/js/validator.js"></script>
        <!--For navigation animation-->
        <script src="../assets/js/imgpreview.js"></script>
        <!-- For load hold start page -->
        <script src="../assets/js/loader.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
        <script src="../assets/js/intlTelInput.min.js"></script>
		<script src="../assets/js/countries.js"></script>
		<script language="javascript">
			populateCountries("country", "state"); 
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
            function getIp(callback) {
                fetch("https://ipinfo.io/json?token=307e862f458995", { headers: { Accept: "application/json" } })
                    .then((resp) => resp.json())
                    .catch(() => {
                        return {
                            country: "my",
                        };
                    })
                    .then((resp) => callback(resp.country));
            }
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                preferredCountries: ["my", "us", "gb", "cn"],
                initialCountry: "auto",
				hiddenInput: "full_phone",
                geoIpLookup: getIp,
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
				var countryCode = $('.iti__selected-flag').attr('title');
			    var countryCode = countryCode.replace(/[^0-9]/g,'')
				document.getElementById("countryphone").value=countryCode;
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

