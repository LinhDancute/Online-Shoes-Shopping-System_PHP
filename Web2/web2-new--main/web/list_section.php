<?php
   
   require_once('connectDB.php');
   
   ?>
   <div class="top-section">
                <div class="Search-section" style="width: 70%;">

                    <input type="text" placeholder=" Search our store" class="Search-context">
                </div>
                <div class="icon-section">

                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
<div class="list-section">
                <p class="title">Categories</p>
                <ul class="template-list">
                     <?php
                    $query="SELECT * FROM category";
                    $result=mysqli_query($conn,$query);
                    while($row= mysqli_fetch_assoc($result)){
                        echo '<li>
                        <a value="'.$row["ID"].'" class="category">'.$row["Name"].'<span>12</span> </a>
                        </li>';
                    }
                    
                    
                    ?>
                    
                </ul>

            </div>

            <div class="list-section">
                <p class="title">Brand</p>
                <ul class="template-list">
                    <?php
                    $query="SELECT * FROM brand";
                    $result=mysqli_query($conn,$query);
                    while($row= mysqli_fetch_assoc($result)){
                        echo '<li>
                        <a href="'.$row["ID"].'">'.$row["Name"].' </a>
                        </li>';
                    }
                    
                    
                    ?>
                    
                </ul>

            </div>
