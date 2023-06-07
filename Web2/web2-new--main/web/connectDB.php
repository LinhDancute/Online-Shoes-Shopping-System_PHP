<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB="data_web2";

// Create connection
$conn = new mysqli($servername, $username, $password, $DB);

// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>