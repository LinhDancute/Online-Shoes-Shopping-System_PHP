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
            $Phone = $_GET['Phone'];
            $Address = $_GET['Address'];
            $Password = $_GET['Password'];
            $email = $_GET['Email'];
            $sql = "Update clients set username=?, phone=?, address=?, password=?,email=? Where ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssss', $Username,$Phone, $Address, $Password,$email, $ID);
        $dbcon->insert($stmt, $conn);
    } else { //delete
        $sql = "DELETE FROM clients WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);
    }
}
