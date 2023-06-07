<?php
require_once __DIR__ . "/connectDB.php";

if (isset($_POST['btn-reg'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $repeat_password = $_POST['password'];
    $user_type = $_POST['user_type'];
    //$status = $_POST['Status'];

    if (!empty($username) && !empty($fullname) && !empty($birthday) && !empty($gender) && !empty($email) && !empty($phone) && !empty($password) && !empty($repeat_password)) {
        $sql = "INSERT INTO users (username, fullname, birthday, gender, email, phone, address, password, user_type, Status) 
        VALUES ('$username', '$fullname', '$birthday', '$gender', '$email', '$phone', '$address','$password', '$user_type','active')";
        if ($conn->query($sql) === TRUE) {
            // after successful login
            $_SESSION['message'] = "Login successful";
            //header("Location: ../index.php");
            return "verification_code";
        } else {
            echo "Lỗi: " . $conn-> error;
        }
    } else {
        echo "Hãy nhập đầy đủ thông tin";
    }
    
    $conn->close();
}
