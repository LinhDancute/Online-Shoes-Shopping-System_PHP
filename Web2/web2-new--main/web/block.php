   <?php

    require_once('connectDB.php');

    ?>
   <div class="block">
       <div class="top-section">
           <div class="Search-section" style="width: 70%;">

               <input type="text" class="Search-context" placeholder=" Search our store" accept-charset="UTF-8">
           </div>
           <div class="icon-section">

               <i class="fa fa-search" aria-hidden="true"></i>
           </div>
       </div>
       <div class="list-section">
           <p class="title">Categories</p>
           <ul class="template-list">
               <?php
                $query = "SELECT c.Name,c.ID,COUNT(p.ID) AS 'sum'
                             FROM category c LEFT JOIN product p ON p.Category_ID = c.ID
                                GROUP BY p.Category_ID,c.Name";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    if (!$row['sum']) {
                        echo '<li>
                    
                        <a href="#" value="' . $row["ID"] . '" class="category">' . $row["Name"] . '<span id="child">0</span> </a>
                        </li>';
                    } else {

                        echo '<li>
                    
                        <a href="#" value="' . $row["ID"] . '" class="category">' . $row["Name"] . '<span>' . $row['sum'] . '</span> </a>
                        </li>';
                    }
                }


                ?>

           </ul>

       </div>

       <div class="list-section">
           <p class="title">Brands</p>
           <ul class="template-list">
               <?php
                $query = "SELECT * FROM brand";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li>
                        <a  href="#" value="' . $row["ID"] . '" class="brand">' . $row["Name"] . ' </a>
                        </li>';
                }


                ?>

           </ul>

       </div>

   </div>