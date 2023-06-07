<?php

require_once __DIR__ . "/connectDB.php";
require_once __DIR__ . '/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php';


// SMTP configuration
$smtpHost = 'smtp.gmail.com';
$smtpUsername = 'linhdan11003@gmail.com';
$smtpPassword = 'bywklbywpmswgkqh';
$smtpPort = 587;


if (isset($_POST['verify-email'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $repeat_password = $_POST['password'];
    $otp = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($repeat_password)) {
        echo 'Please fill out the information completely';
        exit();
    }

    $sql_insert = "INSERT INTO clients (username, email, phone, address, password, user_type, status, OTP) 
                   VALUES ('$username', '$email', '$phone', '$address', '$password', '0', 'pending', '$otp')";

    if ($conn->query($sql_insert) !== TRUE) {
        echo "Lỗi: " . $conn->error;
        exit();
    }

    //send OTP to email
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $smtpPort;
    $mail->setFrom($smtpUsername);
    $mail->addAddress($email);
    $mail->WordWrap = 50;
    $mail->Subject = 'OTP Verification Code';
    $mail->Body = 'Your OTP verification code is: ' . $otp;
    $mail->isHTML(true);


    if (!$mail->send()) {
        echo "Lỗi khi gửi email: " . $mail->ErrorInfo;
        exit();
    }

    $sql_update_email = "UPDATE clients SET status='pending' WHERE email='$email'";

    if ($conn->query($sql_update_email) === TRUE) {
        // echo "verification_code";
        return "verification_code";
        // header("Location: ../page/register/OTP_email_register.php");
        // exit();
    } else {
        echo "Lỗi: " . $conn->error;
        exit();
    }


    $conn->close();
}
