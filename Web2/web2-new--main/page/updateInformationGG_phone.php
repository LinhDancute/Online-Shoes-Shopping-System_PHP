<?php
require_once __DIR__ . "/../database/connectDB.php";
session_start();

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_token']) ) {
    header("Location: ../index.php");
    die();
}

// get the address data from the POST request
$new_phone = $_POST['new-phone'];
$edit_phone=$_POST['phone'];
// sanitize the address data to prevent SQL injection attacks
$new_phone = htmlspecialchars($new_phone);
$new_phone = $conn->real_escape_string($new_phone);

if (isset($_SESSION['user_token'])) {
    // user logged in via Google, update user info in session
    $userinfo = $_SESSION['userinfo'];
    $email = $userinfo['email'];
    $username = $userinfo['username'];

    // insert the user's address into the googleuser table
    if ($new_address == '') {
        $sql = "UPDATE clients SET phone = '$edit_phone' WHERE email = '$email'";
    } else {
        $sql = "UPDATE clients SET phone = '$new_phone' WHERE email = '$email'";
    }
    if ($conn->query($sql) === TRUE) {
        // update the address in the session
        $_SESSION['userinfo']['phone'] = $new_address;
        echo "Address added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
