<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['farmer_login_user'])) {
    die("Access denied. Please log in.");
}

$userlogin = $_SESSION['farmer_login_user'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get Farmer's Location (District and State) from Database
$query = "SELECT F_District, F_State FROM farmerlogin WHERE email=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $userlogin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $District_name_farmer = $row['F_District'];
    $State_name_farmer = $row['F_State'];
} else {
    die("Error: Could not fetch location.");
}

// Weatherstack API Integration
$apiKey = "264055e25393c1afc6891e955f427523";  // Replace with your Weatherstack API key
$city = urlencode($District_name_farmer);
$weatherUrl = "http://api.weatherstack.com/current?access_key=$apiKey&query=$city&units=m";

// Fetch Weather Data
$response = @file_get_contents($weatherUrl);
$data = json_decode($response, true);

// Check API Response
if ($data && isset($data['current'])) {
    $weatherDescription = $data['current']['weather_descriptions'][0] ?? "N/A";
    $temperature = $data['current']['temperature'] ?? "N/A";
    $humidity = $data['current']['humidity'] ?? "N/A";
    $windSpeed = $data['current']['wind_speed'] ?? "N/A";
    $weatherIcon = $data['current']['weather_icons'][0] ?? "";
    $locationName = $data['location']['name']; // Output only the district
} else {
    die("Error: Unable to fetch weather data.");
}

// Close Database Connection
mysqli_close($conn);
?>


<!doctype html>
<html>
<head>
<title>Forecast Weather using OpenWeatherMap with PHP</title>

<style>
body {
    font-family: Arial;
    font-size: 0.95em;
    color: #929292;
}

.report-container {
    border: #E0E0E0 1px solid;
    padding: 20px 40px 40px 40px;
    border-radius: 2px;
    width: 550px;
    margin: 0 auto;
}

.weather-icon {
    vertical-align: middle;
    margin-right: 20px;
}

.weather-forecast {
    color: #212121;
    font-size: 1.2em;
    font-weight: bold;
    margin: 20px 0px;
}

span.min-temperature {
    margin-left: 15px;
    color: #929292;
}

.time {
    line-height: 25px;
}
</style>

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>



<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
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






</head>
<body>

<!-- header-section-starts -->
<div class="header-banner" style="min-height:210px">
		<div class="container">
			
			<div class="header-top">
				<div class="social-icons">
                <div id="google_translate_element"></div>
					
					<script type="text/javascript" >
					function googleTranslateElementInit() {
						new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages: 'bn,en,gu,hi,kn,mr,ta,te'}, 'google_translate_element');
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
				

				<div class="clearfix"></div>
			</div>
			
			<div class="banner-info text-center">
				<h1><a href="upcomimg.php">Weather Prediction</a></h1>
			</div>

			

		</div>
	</div>
	<!-- header-section-ends -->


    <div class="report-container">
    <h2><?php echo $locationName; ?> Weather Status</h2>
    <div class="weather-forecast">
        <img src="<?php echo $weatherIcon; ?>" class="weather-icon" />
        <p>Temperature: <?php echo $temperature; ?>&deg;C</p>
        <p>Description: <?php echo $weatherDescription; ?></p>
        <p>Humidity: <?php echo $humidity; ?>%</p>
        <p>Wind Speed: <?php echo $windSpeed; ?> km/h</p>
    </div>
</div>


<!-- footer-section -->
<div class="footer">
		<div class="container">
			<div class="copyright text-center">
				<p>&copy; 2020 Agricutlure Portal. All rights reserved | Design by NHZP  </a></p>
			</div>
		</div>
	</div>
	<!-- footer-section -->
	
<!--Google translate--> 
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>





