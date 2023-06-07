<?php
    if(!isset($_GET["Quantity"]) || !isset($_GET["Size"]) || !isset($_GET["ID"])){
        echo "404 variable not set!";
    }
    else{
        include_once("../dbconnect.php");
        $dbcon = new dbconnect();
        $conn = $dbcon->connect();
        $Product_ID = $_GET["ID"];
        $Size = $_GET["Size"];
        $Quantity = $_GET["Quantity"];
        $check = "Select 1 From size_detail Where size=$Size AND product_id=$Product_ID";
        $result = $dbcon->select($check, $conn);
        if(empty($row=mysqli_fetch_assoc($result))){
            echo("run ok");
            $sql = "INSERT INTO size_detail(size,product_id,quantity) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $Size,$Product_ID,$Quantity);
        }
        else{
            $sql = "UPDATE size_detail set quantity=? WHERE size=? AND product_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $Quantity,$Size,$Product_ID);
        }
        $dbcon->insert($stmt, $conn);
    }
?>