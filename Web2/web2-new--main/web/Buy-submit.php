
<?php
                    require_once('connectDB.php');
                    session_start();
                    $user_id = $_SESSION['id'];
                    $Date=$_GET['Date'];
                if(isset($_SESSION['id'])){
                    $SelectCartsql = "Select * From cart Where User_ID=$user_id ";
                    $resultSelectCart = mysqli_query($conn,$SelectCartsql);
                    if(mysqli_num_rows($resultSelectCart) > 0){
                    $sql = "INSERT INTO `orders` (`ID`, `Customer_ID`, `BuyDate`,`Status`) VALUES (NULL, $user_id  , '$Date','No');";
                    mysqli_query($conn,$sql);

                    $order_id = mysqli_insert_id($conn);
  
                    while($row=mysqli_fetch_assoc($resultSelectCart)){
                    $querySubtract = "UPDATE size_detail SET quantity = quantity - ".$row['Quantity']." WHERE product_id=".$row['Product_ID']." AND size= ".$row['size']."" ;
                    mysqli_query($conn,$querySubtract);
                    $queryAddDetail = "INSERT INTO order_detail VALUES($order_id,".$row['Product_ID'].",".$row['Quantity'].",".$row['size'].")" ;
                    mysqli_query($conn,$queryAddDetail);
                    }
                    $deleteSQL = "DELETE From cart Where User_ID=$user_id ";
                    mysqli_query($conn,$deleteSQL);
                    echo '1';  }
                    else{
                        echo '2';
                    }

                }
                else{
                    echo '0';
                }

                    

?>
