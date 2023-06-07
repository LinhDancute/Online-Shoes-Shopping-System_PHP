<?php
$ID = $_GET["ID"];
require_once("../dbconnect.php");
$dbcon = new dbconnect();
$conn = $dbcon->connect();
$query = "SELECT * FROM size_detail where product_id=$ID";
$result = $dbcon->select($query, $conn);
$result2 = $dbcon->select($query, $conn);
print <<<HERE
    <input type="hidden" name="ID" id="Quantity_Product_ID" value=$ID>
    <label for="Size" class="form-label">Size</label>
    <input type="text" name="Size" id="Size" class="form-control">
    <label for="Quantity" class="form-label">Quantity</label>
    <input type="text" name="Quantity" id="Quantity" class="form-control">
    <table class="table" id="size_details_tbl">
     <thead>
     <tr>
         <th>Size</th>
         <th>Quantity</th>
     </tr>
 </thead>
 HERE;
while ($row2 = mysqli_fetch_assoc($result2)) {
    print <<<HERE
     <tr>
         <td>$row2[size]</td>
        <td>$row2[quantity]</td>
     </tr>
     HERE;
}
echo "</table>";
print <<<HERE
    <div class="modal-footer">
    <input type="submit" class="btn btn-primary" value="Add Quantity">
    <a class="btn btn-danger" onclick="del('Product')">Delete</a>
    </div>
HERE;
