<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['signupbt'])) {
    $farmername = $_POST['farmername'];
    $pass = SHA1($_POST['password1']);
    $email = $_POST['email'];
    $phone = $_POST['phoneno'];
    $aadhar = $_POST['aadharno'];
    
    $insertquery = "INSERT INTO `farmerlogin`(`farmer_name`, `password`, `email`, `phone_no`, `F_AadharNo`) 
                    VALUES ('$farmername', '$pass', '$email', '$phone', '$aadhar');";
    
    $result = mysqli_query($conn, $insertquery);
    header("location: ../index.php");
}
?>





<!DOCTYPE HTML>
<HTML lang="en">

<head>






    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Farmer Registration</title>


    <script src="../js/RFarmer.js"></script>
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
                <form onsubmit= "return newfarmer()" method="POST" class="text-center border border-light p-5" action="farmer_regist.php">

                    <p class="h4 mb-4">Farmer Sign up</p>

                    <div class="form-row mb-4">
                        <div class="col">
                            <!-- First name -->
                            <input type="text" id="FirstName" class="form-control"
                                placeholder="Farmer name" name="farmername">
                        </div>
                        
                    </div>


                    <!-- Password -->
                    <input type="password" id="Password" class="form-control" placeholder="Password"
                        aria-describedby="PasswordHelpBlock" name="password1" >
                    <small id="PasswordHelpBlock" class="form-text text-muted mb-4">
                    Password Length should be minimum 8 characters and maximum 20 characters.
                    </small>

                    <!-- Confirm Password -->
                    <input type="password" id="confirm_pass" class="form-control mb-4" placeholder="Confirm Password"
                        aria-describedby="PasswordHelpBlock" name="confirm_pass"  >
                    

                    <!-- E-mail -->
                    <input type="email" id="Email" class="form-control mb-4" name="email" placeholder="E-mail">

                    <!-- Phone number -->
                    <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number"
                        aria-describedby="PhoneHelpBlock" name="phoneno">
                    <small id="PhoneHelpBlock" class="form-text text-muted mb-4">
                    </small>

                    
                    <input type="text" id="Aadhar" class="form-control" placeholder="Aadhar Card No."
                        aria-describedby="PhoneHelpBlock" name="aadharno">
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