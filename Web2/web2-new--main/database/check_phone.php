<?php

require_once __DIR__ . "/connectDB.php";

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    $sql_select = "SELECT phone FROM clients WHERE phone='$phone'";
    $sql_select_2 = "SELECT phone FROM users WHERE phone='$phone'";

    $result = $conn->query($sql_select);
    $result_2 = $conn->query($sql_select_2);


    if ($result->num_rows > 0 || $result_2->num_rows > 0) {
        echo 'exists';
    } else {
        echo 'not_found';
    }

    $conn->close();
}
