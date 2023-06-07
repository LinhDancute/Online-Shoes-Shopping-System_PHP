<?php
require_once __DIR__ . "/connectDB.php";

if (isset($_POST['Accept'])) {
    $otp = $_POST['OTP'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['repeat_password'];

    // Check if OTP is correct
    $sql = "SELECT * FROM clients WHERE OTP = '$otp'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // OTP is correct, update the password
        $sql_update = "UPDATE clients SET password='$password', created_at=NOW() WHERE OTP='$otp'";

        if ($conn->query($sql_update) === TRUE) {
            echo "success_password";
        } else {
            echo "error";
        }
    } else {
        echo "incorrect_otp";
    }

    $conn->close();
}
