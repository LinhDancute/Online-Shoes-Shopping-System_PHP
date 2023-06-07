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
$new_address = $_POST['new-address'];
$edit_address=$_POST['address'];
// sanitize the address data to prevent SQL injection attacks
$new_address = htmlspecialchars($new_address);
$new_address = $conn->real_escape_string($new_address);

if (isset($_SESSION['user_token'])) {
    // user logged in via Google, update user info in session
    $userinfo = $_SESSION['userinfo'];
    $email = $userinfo['email'];
    $username = $userinfo['username'];

    // insert the user's address into the googleuser table
    if ($new_address == '') {
        $sql = "UPDATE clients SET address = '$edit_address' WHERE email = '$email'";
    } else {
        $sql = "UPDATE clients SET address = '$new_address' WHERE email = '$email'";
    }
    if ($conn->query($sql) === TRUE) {
        // update the address in the session
        $_SESSION['userinfo']['address'] = $new_address;
        echo "Address added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
