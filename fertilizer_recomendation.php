<?php
session_start();
ini_set('memory_limit', '-1');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$prediction = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $moisture = $_POST['moisture'];
    $nitrogen = $_POST['nitrogen'];
    $potassium = $_POST['potassium'];
    $phosphorous = $_POST['phosphorous'];  // ✅ Ensure this key is used
    $soil_type = $_POST['soil_type'];
    $crop_type = $_POST['crop_type'];

    // Mapping soil and crop types to numbers
    $soil_map = ['Loamy' => 1, 'Sandy' => 2, 'Clayey' => 3, 'Black' => 4, 'Red' => 5];
    $crop_map = ['Sugarcane' => 1, 'Cotton' => 2, 'Millets' => 3, 'Paddy' => 4, 'Pulses' => 5, 
                 'Wheat' => 6, 'Tobacco' => 7, 'Barley' => 8, 'Oil seeds' => 9, 'Ground Nuts' => 10, 'Maize' => 11];

    $soil_num = $soil_map[$soil_type] ?? 0;
    $crop_num = $crop_map[$crop_type] ?? 0;

    // Prepare JSON payload for API
    $data = json_encode([
        "temperature" => floatval($temperature),
        "humidity" => floatval($humidity),
        "moisture" => floatval($moisture),
        "nitrogen" => floatval($nitrogen),
        "potassium" => floatval($potassium),
        "phosphorous" => floatval($phosphorous),  // ✅ Ensure correct key
        "soil_type" => intval($soil_num),
        "crop_type" => intval($crop_num)
    ]);

    // Call Flask API
    $url = "http://127.0.0.1:5000/predict";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($http_status != 200) {
        echo "Error: Unable to connect to API. HTTP Status: " . $http_status . "<br>";
        echo "Response: " . $response . "<br>";
    }

    if (isset($result["prediction"])) {
        $prediction = $result["prediction"];
    } else {
        $prediction = "Prediction failed. Please try again. API Response: " . json_encode($result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Farm Expert </title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>



<!--Notify-->
<link href="css/pnotify.css" rel="stylesheet">
<link href="css/pnotify.brighttheme.css" rel="stylesheet">
<script src="js/pnotify.js"></script>
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
	<div class="header-banner">
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
						<li><a href=" myprofile.php">My Profile</a></li>
						<li><a href="newsfeed.php">News</a></li>
						<li><a href="php/logout.php">Logout</a></li>
					</nav>
					</ul>
				</div>


				
				
				
				<div class="clearfix"></div>
			</div>
			
			<div class="banner-info text-center">
				<h1><a href="farmer_index.php">Agriculture</a></h1>
			</div>
			
			
			

					<!--Main Agriculture Components Starts-->
					
    <div class="container">
    <h2>Fertilizer Prediction Form</h2>
    <form method="POST">
        <label>Temperature:</label>
        <input type="number" name="temperature" required class="form-control" min="10" max="99" value="<?php echo isset($_POST['temperature']) ? $_POST['temperature'] : ''; ?>"><br>

        <label>Humidity:</label>
        <input type="number" name="humidity" required class="form-control" min="10" max="99" value="<?php echo isset($_POST['humidity']) ? $_POST['humidity'] : ''; ?>"><br>

        <label>Moisture:</label>
        <input type="number" name="moisture" required class="form-control" min="10" max="99" value="<?php echo isset($_POST['moisture']) ? $_POST['moisture'] : ''; ?>"><br>

        <label>Nitrogen:</label>
        <input type="number" name="nitrogen" required class="form-control" min="10" max="99" value="<?php echo isset($_POST['nitrogen']) ? $_POST['nitrogen'] : ''; ?>"><br>

        <label>Potassium:</label>
        <input type="number" name="potassium" required class="form-control" min="10" max="99" value="<?php echo isset($_POST['potassium']) ? $_POST['potassium'] : ''; ?>"><br>

        <label>Phosphorous:</label>
        <input type="number" name="phosphorous" required class="form-control" min="10" max="99" value="<?php echo isset($_POST['phosphorous']) ? $_POST['phosphorous'] : ''; ?>"><br>

        <label>Soil Type:</label>
        <select name="soil_type" class="form-control">
            <option <?php echo (isset($_POST['soil_type']) && $_POST['soil_type'] == 'Loamy') ? 'selected' : ''; ?>>Loamy</option>
            <option <?php echo (isset($_POST['soil_type']) && $_POST['soil_type'] == 'Sandy') ? 'selected' : ''; ?>>Sandy</option>
            <option <?php echo (isset($_POST['soil_type']) && $_POST['soil_type'] == 'Clayey') ? 'selected' : ''; ?>>Clayey</option>
            <option <?php echo (isset($_POST['soil_type']) && $_POST['soil_type'] == 'Black') ? 'selected' : ''; ?>>Black</option>
            <option <?php echo (isset($_POST['soil_type']) && $_POST['soil_type'] == 'Red') ? 'selected' : ''; ?>>Red</option>
        </select><br>

        <label>Crop Type:</label>
        <select name="crop_type" class="form-control">
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Sugarcane') ? 'selected' : ''; ?>>Sugarcane</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Cotton') ? 'selected' : ''; ?>>Cotton</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Millets') ? 'selected' : ''; ?>>Millets</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Paddy') ? 'selected' : ''; ?>>Paddy</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Pulses') ? 'selected' : ''; ?>>Pulses</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Wheat') ? 'selected' : ''; ?>>Wheat</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Tobacco') ? 'selected' : ''; ?>>Tobacco</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Barley') ? 'selected' : ''; ?>>Barley</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Oil seeds') ? 'selected' : ''; ?>>Oil seeds</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Ground Nuts') ? 'selected' : ''; ?>>Ground Nuts</option>
            <option <?php echo (isset($_POST['crop_type']) && $_POST['crop_type'] == 'Maize') ? 'selected' : ''; ?>>Maize</option>
        </select><br>

        <button type="submit" class="btn btn-success">Predict Fertilizer</button>
    </form>

    <?php if ($prediction): ?>
        <h3 style="color: white;">Recommended Fertilizer: <?php echo $prediction; ?></h3>
    <?php endif; ?>
</div>


					<!--Main Agriculture Components Ends-->
		

		</div>
	</div>

	<!-- header-section-ends -->
	
	
	
	<!-- footer-section -->
	<div class="footer">
		<div class="container">
			<div class="copyright text-center">
				<p>&copy; 2024 Agriculture Portal. All rights reserved | Design by NHITM  </a></p>
			</div>
		</div>
	</div>
	<!-- footer-section -->
	
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>



