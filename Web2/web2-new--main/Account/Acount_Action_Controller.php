<?php

if (!isset($_GET["action_group_ID"]) || !isset($_GET["action_ID"]))
    echo "variable not set";
else {
    $action = $_GET["action"];
    include_once("../dbconnect.php");
    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    $action_ID = $_GET['action_ID'];
    $action_group_ID = $_GET['action_group_ID'];
    $status = $_GET['status'];
    $sql = "Update action_table set Status=? Where action_ID =? AND action_group_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $status,$action_ID,$action_group_ID);
    $dbcon->insert($stmt, $conn);
}
