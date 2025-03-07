<?php 
session_start();
ini_set('memory_limit', '-1');

// Check if user is logged in
if (!isset($_SESSION['farmer_login_user'])) {
    die("Error: User not logged in.");
}

$userlogin = $_SESSION['farmer_login_user'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriculture_portal";

// Create Connection 
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['profile_submit'])) {

    // Form step 1:
    $f_gender = mysqli_real_escape_string($conn, $_POST['Gender']);
    $f_bday = mysqli_real_escape_string($conn, $_POST['bday']);
    $f_state = mysqli_real_escape_string($conn, $_POST['stt']);
    $f_district = mysqli_real_escape_string($conn, $_POST['district']);
    $f_location = mysqli_real_escape_string($conn, $_POST['Address_name']);

    // File Upload Handling
    $target_dir = "upload/";

    // Aadhar Card Upload
    $f_aadhar_name = $_FILES['aadhar_file']['name'];
    if (!empty($f_aadhar_name)) {
        $aadhar_target_file = $target_dir . basename($f_aadhar_name);
        if (move_uploaded_file($_FILES["aadhar_file"]["tmp_name"], $aadhar_target_file)) {
            $aadhar_uploadquery = "UPDATE farmerlogin SET F_AadharNo_file='$f_aadhar_name' WHERE email='$userlogin'"; 
            if (!mysqli_query($conn, $aadhar_uploadquery)) {
                die("Error updating Aadhar file: " . mysqli_error($conn));
            }
        } else {
            die("Error uploading Aadhar file.");
        }
    }

    // Photo ID Upload
    $f_photoid_name = $_FILES['photoid_file']['name'];
    if (!empty($f_photoid_name)) {
        $photoid_target_file = $target_dir . basename($f_photoid_name);
        if (move_uploaded_file($_FILES["photoid_file"]["tmp_name"], $photoid_target_file)) {
            $photoid_uploadquery = "UPDATE farmerlogin SET F_Photo_Id_file='$f_photoid_name' WHERE email='$userlogin'";
            if (!mysqli_query($conn, $photoid_uploadquery)) {
                die("Error updating Photo ID file: " . mysqli_error($conn));
            }
        } else {
            die("Error uploading Photo ID file.");
        }
    }

    // Query to update profile data
    $update_query = "UPDATE farmerlogin SET 
                    F_gender='$f_gender', 
                    F_birthday='$f_bday', 
                    F_State='$f_state', 
                    F_District='$f_district', 
                    F_Location='$f_location' 
                    WHERE email='$userlogin'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
                alert('Profile Submitted Successfully');
                window.location.href='../myprofile.php';
              </script>";
    } else {
        die("Error updating profile: " . mysqli_error($conn));
    }
}
?>
