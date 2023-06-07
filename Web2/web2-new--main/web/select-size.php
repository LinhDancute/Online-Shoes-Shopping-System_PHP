<?php
require_once('connectDB.php');
$id=$_GET['ID'];
$size=$_GET['size'];
$query="SELECT quantity FROM size_detail WHERE size=$size AND product_id=$id";
if($size!='none'){
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
if($row){
echo $row['quantity'];
}
else{
    echo "0";
}}
else{
    echo "";
}



?>