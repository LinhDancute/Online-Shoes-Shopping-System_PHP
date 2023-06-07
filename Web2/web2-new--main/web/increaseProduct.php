<?php
    
    require_once('connectDB.php');
    $ID=$_GET['productId'];
    $Quantity=$_GET['Quantity'];
    $size = $_GET['productSize'];
    $query="SELECT Quantity From size_detail  WHERE Product_ID = $ID AND size = $size";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    
    if(intval($row['Quantity']) < intval($Quantity)){
        echo'1';
    }
    else{
    $query="UPDATE cart SET Quantity = $Quantity WHERE Product_ID = $ID AND size = $size ";
    mysqli_query($conn,$query);
    }




    
?>