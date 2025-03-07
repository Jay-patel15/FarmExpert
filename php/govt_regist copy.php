<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";

// Database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signupbt'])) {
    $admin_name = mysqli_real_escape_string($conn, $_POST['adminname']);
    $pass = password_hash($_POST['password1'], PASSWORD_DEFAULT); // Secure password hashing

    $insertquery = "INSERT INTO `governmentlogin`(`Admin_name`, `Admin_password`) 
                    VALUES ('$admin_name', '$pass')";

    if (mysqli_query($conn, $insertquery)) {
        header("location: ../index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Government Admin Registration</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    
    <!-- JQuery and Bootstrap JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <center>
            <div class="card-deck" style="width:600px">
                <form method="POST" class="text-center border border-light p-5" action="govt_regist copy.php">
                    <p class="h4 mb-4">Government Admin Sign-up</p>

                    <!-- Admin Name -->
                    <input type="text" id="adminName" class="form-control mb-4" placeholder="Admin Name" name="adminname" required>

                    <!-- Password -->
                    <input type="password" id="password" class="form-control mb-4" placeholder="Password (8-20 characters)" name="password1" required minlength="8" maxlength="20">

                    <!-- Confirm Password -->
                    <input type="password" id="confirm_pass" class="form-control mb-4" placeholder="Confirm Password" name="confirm_pass" required>

                    <!-- Sign-up Button -->
                    <button class="btn btn-success btn-block" type="submit" name="signupbt">Sign up</button>
                </form>
            </div>
        </center>
    </div>

    <script>
        // Validate password match
        document.querySelector("form").addEventListener("submit", function(event) {
            var pass = document.getElementById("password").value;
            var confirmPass = document.getElementById("confirm_pass").value;
            if (pass !== confirmPass) {
                alert("Passwords do not match!");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
