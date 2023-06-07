<?php

require_once __DIR__ . "/connectDB.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql_select = "SELECT email FROM clients WHERE email='$email'";
    $sql_select_2 = "SELECT email FROM users WHERE email='$email'";

    $result = $conn->query($sql_select);
    $result_2 = $conn->query($sql_select_2);


    if ($result->num_rows > 0 || $result_2->num_rows > 0) {
        echo 'exists';
    } else {
        echo 'not_found';
    }

    $conn->close();
}
