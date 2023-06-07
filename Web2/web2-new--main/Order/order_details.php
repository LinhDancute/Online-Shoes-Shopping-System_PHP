<?php
print <<<HERE
     <thead>
     <tr>
         <th>Product_ID</th>
         <th>Product_Name</th>
         <th>Quantity</th>
         <th>Size</th>
     </tr>
 </thead>
 HERE;
 $ID = $_GET["ID"];
 require_once("../dbconnect.php");
 $dbcon = new dbconnect();
 $conn = $dbcon->connect();
 $query = "SELECT p.ID,p.Name,od.Quantity,od.size
 FROM product p JOIN order_detail od on p.ID = od.Product_ID
 WHERE od.Order_ID=$ID";
 $result = $dbcon->select($query,$conn);
 while ($row=mysqli_fetch_assoc($result)) {
     print <<<HERE
     <tr>
         <td>$row[ID]</td>
         <td>$row[Name]</td>
         <td>$row[Quantity]</td>
         <td>$row[size]</td>
     </tr>
     HERE;
 }
?>