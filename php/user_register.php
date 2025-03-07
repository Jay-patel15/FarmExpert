<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signupbt'])) {
    $custname = $_POST['custname'];
    $pass = $_POST['password'];
    $pass = SHA1($pass); // Keeping password hashing for security
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $phone = $_POST['phoneno'];
    
    $insertquery = "INSERT INTO `custlogin`(`cust_name`, `password`, `email`, `address`, `city`, `pincode`, `state`, `phone_no`) 
                    VALUES ('$custname', '$pass', '$email', '$address', '$city', '$pincode', '$state', '$phone');";
    
    if (mysqli_query($conn, $insertquery)) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $insertquery . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>




<!DOCTYPE HTML>
<HTML lang="en">

<head>


    <script src="../js/RCustomer.js"></script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer Registration</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    





    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
        
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>

<body>

    <!-- Default form register -->
    <br><br>
    <div class=container mb-5 mt-5>
        <center>
            <div class="card-deck" style="width:600px">
                <form onsubmit= "return newcustomer()" method="POST" class="text-center border border-light p-5" action="user_register.php">

                    <p class="h4 mb-4">Customer Sign up</p>

                    <div class="form-row mb-4">
                        <div class="col">
                            <!-- Name -->
                            <input type="text" id="CustName" class="form-control"
                                placeholder="Name" name="custname">
                        </div>
                         
                    </div>

                    
                    

                    <!-- Password -->
                    <input type="password" id="password" class="form-control" placeholder="Password"
                        aria-describedby="PasswordHelpBlock" name="password" onkeyup='check();'>
                    <small id="PasswordHelpBlock" class="form-text text-muted mb-4">
                    Password Length should be minimum 8 characters and maximum 20 characters.
                    </small>

                    <!-- Confirm Password -->
                    <input type="password" id="confirm_pass" class="form-control mb-4" placeholder="Confirm Password"
                        aria-describedby="PasswordHelpBlock" name="confirm_pass" onkeyup='check();' >
                    

                    <!-- E-mail -->
                    <input type="email" id="Email" class="form-control mb-4" name="email" placeholder="E-mail">


                    <input type="text" id="Address" class="form-control" placeholder="Address"
                        aria-describedby="PhoneHelpBlock" name="address">
                    <small id="PhoneHelpBlock" class="form-text text-muted mb-4">
                    </small>

                    <input type="text" id="City" class="form-control" placeholder="City"
                        aria-describedby="PhoneHelpBlock" name="city">
                    <small id="PhoneHelpBlock" class="form-text text-muted mb-4">
                    </small>

                    <input type="number" id="PinCode" class="form-control" placeholder="Pin Code"
                        aria-describedby="PhoneHelpBlock" name="pincode">
                    <small id="PhoneHelpBlock" class="form-text text-muted mb-4">
                    </small>

                    <input type="text" id="State" class="form-control" placeholder="State"
                        aria-describedby="PhoneHelpBlock" name="state">
                    <small id="PhoneHelpBlock" class="form-text text-muted mb-4">
                    </small>

                    <!-- Phone number -->
                    <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number"
                        aria-describedby="PhoneHelpBlock" name="phoneno">
                    <small id="PhoneHelpBlock" class="form-text text-muted mb-4">
                    </small>
                   
                    <!-- Sign up button -->
                    <button class="btn btn-success my-4 btn-block btn " style="background-color:#AA9A6E!important;" type="submit" name="signupbt" value="signupbt">Sign up</button>

                    <hr>

        
                    <div id="google_translate_element"></div>
                <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bn,en,gu,hi,kn,mr,ta,te'}, 'google_translate_element');
}
</script>
                </form>
            </div>
        </center>
    </div>
    <!-- Default form register -->

</body>




</HTML>