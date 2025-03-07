<?php 
session_start();
ini_set('memory_limit', '-1');
$userlogin = $_SESSION['farmer_login_user'] ?? '';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";

// Create Connection 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve values from session (if available)
$form_data = $_SESSION['form_data'] ?? [];
$prediction = $_SESSION['prediction'] ?? '';
unset($_SESSION['form_data'], $_SESSION['prediction']); // Clear session after use
?>
<!DOCTYPE html>
<html>
<head>
<title>Agriculture Portal </title>

<!--Myprofile Css-->
<link rel="stylesheet" href="css/myprofilecss.css">

<!--MyProfile Checkbox CSS-->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/build.css">

<!--Myprofile Photo upload Css-->
<link rel="stylesheet" href="css/myprofileupload.css">

<!--Bootstrap-->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />


<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>

<!--Js for Crop Prediction through Location State and District-->
<script src="js/crop_predict_location.js"></script>
  

<!--Js for Validation of form -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

<!--Js for signupform-->
<script src="js/validateform.js"></script>



<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Gardening Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>

<!--/script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>

<!--Notify-->
<link href="css/pnotify.css" rel="stylesheet">
<link href="css/pnotify.brighttheme.css" rel="stylesheet">
<script src="js/pnotify.js"></script>


</head>
<body>

	<!-- header-section-starts -->
	<div class="header-banner" style="min-height:220px">
		<div class="container">
			
			<div class="header-top">
				<div class="social-icons">
					
					
					<div id="google_translate_element" ></div>
					
					<script type="text/javascript" >
					function googleTranslateElementInit() {
						new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bn,en,gu,hi,kn,mr,ta,te'}, 'google_translate_element');
					}
					</script>
				
				</div>
				
			<span class="menu"><img src="images/nav.png" alt=""/></span>
				<div class="top-menu">
					<ul>
					<nav class="cl-effect-13">
						<li><a href="farmer_index.php">Home</a></li>
						<li><a href="php/logout.php">Logout</a></li>
					</nav>
					</ul>
				</div>
				<!-- script for menu -->
					<script> 
						$( "span.menu" ).click(function() {
						$( ".top-menu ul" ).slideToggle( 300, function() {
						 // Animation complete.
						});
						});
					</script>
				<!-- //script for menu -->

				<div class="clearfix"></div>
			</div>
			
			<div class="banner-info text-center">
				<h1><a href="crop_predict.php">Crop Predictor</a></h1>
			</div>
		</div>
	</div>
    <!-- header-section-ends -->

    <div class="services">
    <div class="row">
        <div class="container-fluid">
            <form action="process_prediction.php" method="post">
                <table class="table table-striped table-responsive-md btn-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Input Field Name</th>
                            <th>Enter Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Nitrogen (N)</td>
                            <td><input type="number" name="nitrogen" class="form-control" required value="<?php echo htmlspecialchars($form_data['nitrogen'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Phosphorous (P)</td>
                            <td><input type="number" name="phosphorous" class="form-control" required value="<?php echo htmlspecialchars($form_data['phosphorous'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Potassium (K)</td>
                            <td><input type="number" name="potassium" class="form-control" required value="<?php echo htmlspecialchars($form_data['potassium'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>pH Level</td>
                            <td><input type="number" step="0.01" name="ph" class="form-control" required value="<?php echo htmlspecialchars($form_data['ph'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Temperature (°C)</td>
                            <td><input type="number" step="0.01" name="temperature" class="form-control" required value="<?php echo htmlspecialchars($form_data['temperature'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Humidity (%)</td>
                            <td><input type="number" step="0.01" name="humidity" class="form-control" required value="<?php echo htmlspecialchars($form_data['humidity'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Rainfall (mm)</td>
                            <td><input type="number" step="0.01" name="rainfall" class="form-control" required value="<?php echo htmlspecialchars($form_data['rainfall'] ?? ''); ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-submit">Predict</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Prediction Result Display -->
<div class="services">
    <div class="row">
        <div class="container-fluid">
            <h3>
                <?php 
                if (!empty($prediction)) {
                    echo "Recommended Crop: " . htmlspecialchars($prediction);
                }
                ?>
            </h3>
        </div>
    </div>
</div>
<!-- Footer -->
<div class="footer" style="position:relative;width:100%; bottom:0;">
    <div class="container">
        <div class="copyright text-center">
            <p>&copy; 2024 Agriculture Portal. All rights reserved | Design by NHITM</p>
        </div>
    </div>
</div>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>


