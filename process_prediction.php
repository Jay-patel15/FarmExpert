<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['form_data'] = $_POST; // Store input values in session

    $data = [
        'nitrogen' => $_POST['nitrogen'],
        'phosphorous' => $_POST['phosphorous'],
        'potassium' => $_POST['potassium'],
        'ph' => $_POST['ph'],
        'temperature' => $_POST['temperature'],
        'humidity' => $_POST['humidity'],
        'rainfall' => $_POST['rainfall']
    ];

    $json_data = json_encode($data);
    $api_url = "http://127.0.0.1:5002/predict";

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    
    $_SESSION['prediction'] = $result['prediction']; // Store prediction in session
    
    header("Location: crop_predict.php");
    exit();
}
?>
