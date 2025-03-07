<?php
session_start();
ini_set('memory_limit', '-1');
$userlogin = $_SESSION['farmer_login_user'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";

// Create Connection 
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prediction_result = "";
$uploaded_image = "";

if (isset($_FILES['image'])) {
    $url = "http://127.0.0.1:5001/predict";  // Flask API URL

    $file = $_FILES['image']['tmp_name'];
    $cfile = new CURLFile($file, $_FILES['image']['type'], $_FILES['image']['name']);

    $postData = array('file' => $cfile);

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode and store response
    $result = json_decode($response, true);
    $prediction_result = "Prediction: " . $result['prediction'];

    // Store uploaded image path
    $uploaded_image = "uploads/" . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_image);
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
			<div class="container text-center" style="margin-top: 20px;">
                <h2>Upload Image for Prediction</h2>
                <form action="" method="POST" enctype="multipart/form-data" style="display: inline-block; text-align: center;">
                    <input type="file" name="image" accept="image/*" required onchange="previewImage(event)">
                    <br><br>
					<div id="image-preview" style="text-align: center; margin-top: 20px;"></div>
					<br>
                    <button type="submit" class="btn btn-success">Upload & Predict</button>
                </form>
                <br><br>
                <?php if ($uploaded_image) { ?>
                    <div>
                        <h3>Uploaded Image:</h3>
                        <img src="<?php echo $uploaded_image; ?>" alt="Uploaded Image" style="max-width: 300px; border: 1px solid #ddd; padding: 5px; margin-top: 10px;">
                    </div>
                <?php } ?>
                <br>
                <h3 style="color: white;"> <?php echo $prediction_result; ?> </h3>
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
	<script type="text/javascript">
		$(document).ready(function() {
				
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
   <script>
        function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        let imgContainer = document.getElementById("image-preview");

        // Clear previous image
        imgContainer.innerHTML = "";

        const imgElement = document.createElement("img");
        imgElement.src = reader.result;
        imgElement.style.maxWidth = "300px";
        imgElement.style.border = "1px solid #ddd";
        imgElement.style.padding = "5px";
        imgElement.style.marginTop = "10px";

        imgContainer.appendChild(imgElement);
    };
    reader.readAsDataURL(event.target.files[0]);
}
    </script>
<!--Google translate--> 
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>