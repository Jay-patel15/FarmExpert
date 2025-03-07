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

// Farmer Login
if(isset($_POST['farmerlogin'])) {
    $farmer_email = mysqli_real_escape_string($conn, $_POST['farmer_email']);
    $farmer_password = SHA1(mysqli_real_escape_string($conn, $_POST['farmer_password']));

    $farmerquery = "SELECT * FROM `farmerlogin` WHERE email='$farmer_email' AND password='$farmer_password'";
    $result = mysqli_query($conn, $farmerquery);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['farmer_login_user'] = $farmer_email;
        header("Location: ../farmer_index.php"); // Redirect to farmer dashboard
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location.href='../index.php';</script>";
        exit();
    }
}

// Customer Login
if(isset($_POST['customerlogin'])) {
    $customer_email = mysqli_real_escape_string($conn, $_POST['cust_email']);
    $customer_password = SHA1(mysqli_real_escape_string($conn, $_POST['cust_password']));

    $checkquery = "SELECT * FROM `custlogin` WHERE email='$customer_email' AND password='$customer_password'";
    $result = mysqli_query($conn, $checkquery);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['customer_login_user'] = $customer_email;

        $deletequery = "DELETE FROM cart";
        mysqli_query($conn, $deletequery);

        header("Location: ../customer_index.php"); // Redirect to customer dashboard
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location.href='../index.php';</script>";
        exit();
    }
}

// Government Login
if (isset($_POST['Govlogin'])) {
    $gov_username = mysqli_real_escape_string($conn, $_POST['gov_username']);
    $gov_password = $_POST['gov_password']; // User input password

    // Fetch stored password
    $checkquery = "SELECT * FROM `governmentlogin` WHERE Admin_name='$gov_username'";
    $result = mysqli_query($conn, $checkquery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['Admin_password']; // Hashed password from DB

        // Verify password
        if (password_verify($gov_password, $stored_password)) {
            $_SESSION['Gov_user'] = $gov_username;
            header("Location: ../government_index.php"); // Redirect to government dashboard
            exit();
        } else {
            echo "<script>alert('Invalid Username or Password'); window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid Username or Password'); window.location.href='../index.php';</script>";
    }
}
mysqli_close($conn);
?>

