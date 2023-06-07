<?php
    
    require_once('connectDB.php');
    session_start();
    $ID=$_GET['productId'];
    $UserID=$_SESSION['id'];
    $size=$_GET['productSize'];
    echo $query;
    $query="DELETE FROM cart WHERE Product_ID = $ID AND User_ID=$UserID AND size=$size ";
    mysqli_query($conn,$query);
?>