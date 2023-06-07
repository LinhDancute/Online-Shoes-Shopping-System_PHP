<?php
session_start();
require_once __DIR__ . "/connectDB.php";

if (isset($_POST['OTP'])) {
    $OTP = $_POST['OTP'];

    // Check if OTP exists
    $sql_select = "SELECT * FROM clients WHERE OTP='$OTP'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // The OTP exists, update status and created_at for the specific OTP
        $sql_update = "UPDATE clients SET status = 'active', created_at=NOW() WHERE OTP ='$OTP'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'incorrect_otp';
    }

    $conn->close();
}

