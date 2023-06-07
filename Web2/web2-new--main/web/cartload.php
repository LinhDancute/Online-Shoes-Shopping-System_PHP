
<?php
                    require_once('connectDB.php');
                    if(!isset($_SESSION['id'])){
                            $user_id=0; 
                    }else {
                    $user_id = $_SESSION['id'];

                    }
                    $query="SELECT p.Name,p.Price,p.ID,c.Quantity,p.Img,c.size
                            FROM cart c JOIN product p on c.Product_ID = p.ID
                            WHERE c.User_ID = $user_id";
                    $result=mysqli_query($conn,$query);
                    while($row= mysqli_fetch_assoc($result)){
                        echo '
                        <div class="cart-box">
                                            <img src="./image/'.$row["Img"].'" alt="" class="cart-img">
                                            <div class="detail-box">
                                                <input  type="hidden" value="'.$row["ID"].'" id="product-id">
                                                <input  type="hidden" value="'.$row["size"].'" id="product-size">
                                                <div class="cart-product-title">'.$row["Name"].'</div>
                                                <div class="cart-product-title">Size : '.$row["size"].'</div>
                                                <div class="cart-price">$'.$row["Price"].'</div>
                                                <input type="number" value="'.$row["Quantity"].'" class="cart-quantity">
                                            </div>

                                            <!-- REMOVE CART -->
                                            <i class="bx bxs-trash-alt cart-remove"></i>
                                        </div>
                        
                        ';
                    }
            
?>