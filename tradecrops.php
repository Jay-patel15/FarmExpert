<?php 
session_start();
ini_set('memory_limit', '-1');

// Read crop prices from file and store in an associative array
$cropPrices = [];
$file = fopen("crops prices.txt", "r");
if ($file) {
    while (($line = fgets($file)) !== false) {
        list($crop, $price) = explode(":", trim($line));
        $cropPrices[$crop] = (int)$price;
    }
    fclose($file);
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Farm Expert </title>

<!--Myprofile Css-->
<link rel="stylesheet" href="css/myprofilecss.css">

<!--MyProfile Checkbox CSS-->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/build.css">

<!--Myprofile Photo upload Css-->
<link rel="stylesheet" href="css/myprofileupload.css">

<!--Bootstrap-->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>

<!--Js for Progress form for Profile-->
<script src="js/myprofilejs.js"></script>
  
<!--Js for File upload for Profile-->
<script scr="js/myprofileupload.js"></script>

<!--Js for Validation of form -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

<!--Js for signupform-->
<script src="js/validateform.js"></script>

<!--Notify-->
<link href="misc/pnotify.css" rel="stylesheet">
<link href="misc/pnotify.brighttheme.css" rel="stylesheet">



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

<!-- Auto-fill MSP based on selected crop -->
<script>
    $(document).ready(function(){
        var cropPrices = <?php echo json_encode($cropPrices); ?>;
        $("#crops").change(function(){
            var selectedCrop = $(this).val();
            $("#msp").val(cropPrices[selectedCrop] || "N/A");
        });
    });
</script>

<!--Notify-->
<link href="css/pnotify.css" rel="stylesheet">
<link href="css/pnotify.brighttheme.css" rel="stylesheet">
<script src="js/pnotify.js"></script>
<script src="js/TradeCrops.js"></script>


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
				

				<div class="clearfix"></div>
			</div>
			
			<div class="banner-info text-center">
				<h1><a href="tradecrops.php">Trade Crops</a></h1>
			</div>

			

		</div>
	</div>
	<!-- header-section-ends -->    


            
				<!-- Form Wizard -->
				<form role="form" onsubmit="return tradecrops()" id="sellcrops" action="php/farmer_trade_crop.php" method="POST" enctype="multipart/form-data">                                            

                <table class="table table-striped table-bordered table-responsive-md btn-table">

				<thead>
            <tr>
                <th>#</th>
                <th>Crop Name</th>
                <th>Quantity (in KG)</th>
                <th>MSP (Rs/KG)</th>
                <th>Cost borne per KG (Rs.)</th>
                <th>Upload Crop</th>
            </tr>
        </thead>
		<tbody>
            <tr>
                <th scope="row">1</th>
                <td>
                    <select id="crops" name="crops">
                        <?php foreach ($cropPrices as $crop => $price) { ?>
                            <option value="<?= $crop ?>"><?= ucfirst($crop) ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="number" name="trade_farmer_cropquantity" class="form-control required"></td>
                <td><input type="text" id="msp" class="form-control" readonly></td>
                <td><input type="number" name="trade_farmer_cost" class="form-control required"></td>
                <td>
                    <button type="submit" name="Crop_submit" class="btn btn-submit">Submit</button>
                </td>
            </tr>
        </tbody>

                    </table> 
                </form>
				
             
	
	<!-- footer-section -->
	<div class="footer"  style="position:absolute;width:100%; bottom:0;">
		<div class="container">
			<div class="copyright text-center">
				<p>&copy; 2024 Agriculture Portal. All rights reserved | Design by NHITM </a></p>
			</div>
		</div>
	</div>
	<!-- footer-section -->
	

<!--Google translate--> 
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>