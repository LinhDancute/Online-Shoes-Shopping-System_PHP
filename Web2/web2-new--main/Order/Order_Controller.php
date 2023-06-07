<?php
if (!isset($_GET["action"]))
    echo "404";
else {
    $action = $_GET["action"];
    include_once("../dbconnect.php");
    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    if ($action == "delete") {
        $sql = "DELETE";
        $sql = "DELETE FROM orders WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);
    }
    else{
        $status =$_GET["Status"];
        $ID =$_GET["Order_ID"];
        $sql = "UPDATE orders set Status =?  WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss',$status,$ID);
        $dbcon->insert($stmt, $conn);
    }
}
