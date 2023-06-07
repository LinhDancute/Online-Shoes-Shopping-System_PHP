   
<?php 
require_once('connectDB.php');
$id=$_GET['Id'];
$query="SELECT p.*, c.name AS category_name, b.name AS brand_name
FROM product p
JOIN category c ON p.category_id = c.id
JOIN brand b ON p.brand_id = b.id
WHERE p.id = $id";
// echo $query;


$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);

$sql='SELECT size FROM size_detail WHERE product_id= '.$id.'';
$result=mysqli_query($conn,$sql);

print <<<HERE
 <div class="content">
        <div class="detail" style="height: 90%;width: 90%;margin: 2% 5%; display: flex;flex-direction: row;">
            <div class="img-magnifier-container">
                <img id="myimage"
                     src ="./image/$row[Img]"
                            
                    style="width: 100%;height: 100%;">

            </div>



            <div class="product-detail-section" style="width: 90%; height: 100%px;margin-left: 2%;display: block;">
                <h2>$row[Name]</h2>
                <div style="display: inline-flex;">
                    <h4>Brand:</h4>
                    <h4 style="margin-left:5% ;">$row[brand_name]</h4>
                </div>
                <br>
                <div style="display: inline-flex;">
                    <h4>Category:</h4>
                    <h4 style="margin-left:5% ;">$row[category_name]</h4>
                </div>
                <p style="color:red">Price : $row[Price]$</p>
                <p>$row[Description]</p>
                <div>
                    <div>

                        <Span>Quantity:</Span>
                        <span id="insert-quantity"></span>
                    </div>


                    <form id="my-form" action="web/addcart-submit.php" method="POST">

                        <label for="a" style="font-size: 20px;color: #060606;font-weight: 350;">
                            size
                        </label>
                        <select id="select-size" name="size" style="padding:0.5% ; text-align: start;font-size: 110%;" onchange="changeSize(this.value,$row[ID])">
                        <option value="none">-</option>"
HERE;
             while($size=mysqli_fetch_assoc($result)){
                echo "<option value=".$size['size'].">".$size['size']."</option>";
             }
print <<<HERE
 </select>
                            <input id=" form1" name="id" value="$row[ID]"
                                type="hidden" class="form-control" />
                        <div class="quantity">
                            <span class="quantity-button"
                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                <i class="fas fa-minus"></i>
                            </span>
                        
                            <input style="width: 10%;text-align: center;" id="quantityValue" min="0" name="quantityValue" value="1"
                                type="number" />


                            <span class="quantity-button"
                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                <i class="fas fa-plus"></i>
                            </span>
                            <input type="submit" value="Add to cart" id="addtocart">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
HERE;
               
       
?>
<script>


</script>
