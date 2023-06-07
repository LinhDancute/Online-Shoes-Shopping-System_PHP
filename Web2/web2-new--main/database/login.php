<?php
session_start();
require_once __DIR__ . "/connectDB.php";

// Check if connection to database is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['btn-log'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database
    $sql_users = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result_users = $conn->query($sql_users);

    $sql_clients = "SELECT * FROM clients WHERE email='$email' AND password='$password'";
    $result_clients = $conn->query($sql_clients);

    // Check if query was successful
    if ($result_users) {
        if ($result_users->num_rows > 0) {
            $row_users = $result_users->fetch_assoc();

            if ($row_users['user_type'] == '1') {
                $user_group = 1;
                $_SESSION['user_group'] = $user_group;
                if ($user_group !== null) {
                    // Save user data in session variables
                    $_SESSION['username'] = $row_users['username'];
                    $_SESSION['user_type'] = $row_users['user_type'];
                    $_SESSION['email'] = $row_users['email'];
                    $_SESSION['password'] = $row_users['password'];
                    echo "Admin";
                } else {
                    echo "Error: Could not determine user type.";
                }
            } else if ($row_users['user_type'] == '2') {
                $user_group = 2;
                $_SESSION['user_group'] = $user_group;
                if ($user_group !== null) {
                    // Save user data in session variables
                    $_SESSION['username'] = $row_users['username'];
                    $_SESSION['user_type'] = $row_users['user_type'];
                    $_SESSION['email'] = $row_users['email'];
                    $_SESSION['password'] = $row_users['password'];
                    echo "NhanVien";
                } else {
                    echo "Error: Could not determine user type.";
                }
            } else {
                // Save user data in session variables
                $_SESSION['user_type'] = $row_users['user_type'];
                $_SESSION['email'] = $row_users['email'];
                $_SESSION['password'] = $row_users['password'];
                $_SESSION['message'] = 'Login successful';
                $_SESSION['id'] = $row_users['id'];
                echo "clients"; 
            }

        } else if ($result_clients) { // moved this line to check for clients separately
            if ($result_clients->num_rows > 0) {
                $row_clients = $result_clients->fetch_assoc();
                if ($row_clients && $row_clients['status'] == 'active') { // add an additional check for null value
                    $_SESSION['email'] = $row_clients['email'];
                    $_SESSION['password'] = $row_clients['password'];
                    $_SESSION['id'] = $row_clients['id'];
                    // $_SESSION['user_group'] = $row_clients['user_group'];
                    $_SESSION['message'] = 'Login successful';
                    echo "clients";
                } else {
                    echo "The account is inactive";
                }
            } else {
                echo 'Email or password is wrong, please re-enter'; // Add this line
            }
        } else {
            echo "Error: Login failed. The account may be inactive or the login credentials may be incorrect. Please try again.";
        }

        // Free result set
        $result_users->free_result();
        $result_clients->free_result();
    } else {
        echo "Error: Login failed. The account may be inactive or the login credentials may be incorrect. Please try again.";
    }

    // Close database connection
    $conn->close();

    exit();
}
