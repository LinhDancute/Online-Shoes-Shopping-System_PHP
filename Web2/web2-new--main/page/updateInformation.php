<?php
require_once __DIR__ . "/../database/connectDB.php";
session_start();

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    die();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address'])) {
    $address = $_POST['address'];
    $email = $_SESSION['email'];

    $sql = "UPDATE clients SET address='$address' WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        header("Location: ./../index.php");
        die();
    } else {
        echo "Error updating record: " . $conn-> error;
        die();
    }
}



$conn->close();
