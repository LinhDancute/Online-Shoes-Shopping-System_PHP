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
            $email = $_GET['Email'];
            $FirstName = $_GET['FirstName'];
            $LastName = $_GET['LastName'];
            $FullName = $_GET['FullName'];
            $Gender = $_GET['Gender'];
            $img = $_GET['img_file'];
            $sql = "Update googleuser set email=?, FirstName=?, LastName=?, Gender=?,FullName=?,picture=? Where ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $email,$FirstName, $LastName, $Gender,$FullName,$img, $ID);
        $dbcon->insert($stmt, $conn);
    } else { //delete
        $sql = "DELETE FROM googleuser WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);
    }
}
