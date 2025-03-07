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
    $url = "http://127.0.0.1:5000/predict";  // Flask API URL

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
    <title>Farm Expert</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery.min.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <div class="header-banner">
        <div class="container">
            <div class="header-top">
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
            <div class="container text-center" style="margin-top: 20px;">
                <h2>Upload Image for Prediction</h2>
                <form action="" method="POST" enctype="multipart/form-data" style="display: inline-block; text-align: center;">
                    <input type="file" name="image" accept="image/*" required onchange="previewImage(event)">
                    <br><br>
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
                <h3 style="color: green;"> <?php echo $prediction_result; ?> </h3>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const imgElement = document.createElement("img");
                imgElement.src = reader.result;
                imgElement.style.maxWidth = "300px";
                imgElement.style.border = "1px solid #ddd";
                imgElement.style.padding = "5px";
                imgElement.style.marginTop = "10px";
                document.querySelector(".container").appendChild(imgElement);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
