<?php
if (!isset($_GET["action"]))
    echo "404";
else {
    $action = $_GET["action"];
    include_once("../dbconnect.php");
    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    if ($action == "insert" || $action == "update") {
        if (isset($_GET["ID"]))
            $ID = $_GET["ID"];
        $Username = $_GET['Username'];
        $Name = $_GET['Name'];
        $Phone = $_GET['Phone'];
        $Address = $_GET['Address'];
        $Password = $_GET['Password'];
        $Type = $_GET['Type'];
        $gender = $_GET['Gender'];
        $birthday = $_GET['Birthday'];
        $email = $_GET['Email'];
        if ($action == "insert") {
            $sql = "INSERT INTO `users` ( `username`, `fullname`, `phone`, `address`, `password`, `user_type`, `gender`, `birthday`, `email`, `created_at`) VALUES(?,?,?,?,?,?,?,?,?,current_timestamp())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssssss', $Username, $Name, $Phone, $Address, $Password, $Type, $gender, $birthday, $email);
        } else {
            $sql = "Update users set username=?, fullname=?, phone=?, address=?, password=?, user_type=?,gender=?,birthday=?,email=? Where ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssss', $Username, $Name, $Phone, $Address, $Password, $Type, $gender, $birthday, $email, $ID);
        }
        $dbcon->insert($stmt, $conn);
    } else { //delete
        $sql = "DELETE FROM users WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);
    }
}
