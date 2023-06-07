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
        $Description= $_GET['Description'];
        $Name = $_GET['Name'];
        $Price = $_GET['Price'];
        $Category = $_GET['Category'];
        $Brand = $_GET['Brand'];
        $img = $_GET['img_file'];
        if(isset($_GET['status'])) {
            $status = $_GET['status'];

        }else {
            $status = 1;
        }
        if ($action == "insert") { //insert
            $sql = "INSERT INTO product (Price, `Name` , Category_ID, Brand_ID, `Description`,Img, status) VALUES (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $Price, $Name, $Category, $Brand,$Description, $img, $status);
        } else { //update
            if ($_GET['img_file'] != "")//img file
                $img = $_GET['img_file'];
            else
                $img = $_GET['default_img'];
            $sql = "Update product set Price=?, Name=?,Category_ID=?, Brand_ID=?, Description=? ,Img=?, status = ? Where ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssss', $Price, $Name, $Category, $Brand, $Description,$img,$status , $ID);
        }
        $dbcon->insert($stmt, $conn);
        //echo $Price;
    } else { //delete
        $sql = "UPDATE product set status = 0 WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);
    }
}
