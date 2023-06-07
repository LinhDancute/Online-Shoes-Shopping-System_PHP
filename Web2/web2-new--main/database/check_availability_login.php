<?php
require_once __DIR__ . "/connectDB.php";

if (!empty($_POST['email'])) {
    $query_users = "SELECT * FROM users WHERE email='" . $_POST['email'] . "'";
    $result_users = mysqli_query($conn, $query_users);
    $count_users = mysqli_num_rows($result_users);

    $query_clients = "SELECT * FROM clients WHERE email='" . $_POST['email'] . "'";
    $result_clients = mysqli_query($conn, $query_clients);
    $count_clients = mysqli_num_rows($result_clients);


    if ($count_users > 0 || $count_clients > 0) {
        echo "<span style='color:green'> User ready to log in.</span>";
        echo "<script>$('#check-email-exist').prop('disabled', false);</script>";
    } else {
        echo "<span style='color:red'> User does not exist, please register.</span>";
        echo "<script>$('#check-email-exist').prop('disabled', true);</script>";
    }

}
