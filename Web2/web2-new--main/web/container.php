<?php
   
   require_once('connectDB.php');
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $currPage = isset($_GET['page']) ? $_GET['page'] : null;
    $brand = isset($_GET['brand']) ? $_GET['brand'] : 'all';
    $searchText = isset($_GET['searchtext']) ? $_GET['searchtext'] : '';
    $orderby= isset($_GET['orderby']) ? $_GET['orderby'] : 'all';
    $min= isset($_GET['min']) ? $_GET['min'] : 'none';
    $max= isset($_GET['max']) ? $_GET['max'] : 'none';
    $ItemOnPage=8;
    $numpage=0;
    
   
   function renderListProducts($currPage,$conn){
    $query="SELECT * FROM product WHERE status=1 ";
    $category=$GLOBALS['category'];
    $brand=$GLOBALS['brand'];
    $text=$GLOBALS['searchText'];
    $ItemOnPage=$GLOBALS['ItemOnPage'];
     $min=$GLOBALS['min'];
      $max=$GLOBALS['max'];
    if($category!='all'){
         $query.="AND Category_ID = ".$category." ";
    }
    
    if($brand!='all'){
         $query.="AND Brand_ID = ".$brand." ";
    }
     if($text!=''){
         $query.="AND Name Like '%".$text."%' ";
    }
    if($min!='none'){
         $query.="AND Price >= $min ";
    }
     if($max!='none'){
         $query.="AND Price <= $max ";
    }
    // echo $query;
    $result=mysqli_query($conn,$query);
    $GLOBALS['numpage']=ceil(mysqli_num_rows($result)/$ItemOnPage);
    
    if($GLOBALS['orderby']!='all'){
        $query.="ORDER BY Price ".$GLOBALS['orderby']." ";
    }
    $numtop=($currPage-1)*$ItemOnPage;
    $query.="limit ".$numtop.",".$ItemOnPage." ";
    // echo $query;
    $list = mysqli_query($conn,$query);
    while($row =mysqli_fetch_assoc($list)){
         echo '<div class="product-item" onclick="itemClick('.$row["ID"]. ')">
                <div class="img-section">

                        <img src ="./image/'.$row["Img"].'"
                            alt="">
                        <div class="icon-show">
                            <li> <a href=""></a></li>
                            <li> <a href=""></a></li>
                            <li> <a href=""></a></li>
                        </div>
                    </div>

                    <div class="detail-product">

                        <div>
                            <a href="">'.$row["Name"].'</a>
                        </div>

                        <div>

                            <span> '.$row["Price"].' $</span>
                        </div>





                    </div>
                </div>';
    }


        
   }
   function renderPagination(){
            $currPage=$GLOBALS['currPage'];
            $pages=$GLOBALS['numpage'];
            if($pages==0){
                    echo"THERE ARE NO PRODUCTS ";
                }
                else{
                if($currPage+3<$pages){
                    echo'<nav aria-label="Page navigation example">
                     <ul class="pagination justify-content-end">';
                    if ($currPage > 1) {
                        
                        echo '<li class="page-item disabled"><a class="page-link"  onclick=changePage('.($currPage-1).')>Previous</a></li>';
                    }else{
                echo '<li class="page-item"><a class="page-link"  onclick=changePage(' . ($currPage - 1) . ')>Previous</a></li>';

                    }
                     
                    for($index=1;$index<=$currPage+2;$index++){
                        if($index==$currPage){
                            echo'<li class="page-item active"><a class="page-link" onclick=changePage('.$index.') >'.$index.'</a></li>';
                        }
                        else{
                        echo'<li class="page-item"><a class="page-link" onclick=changePage('.$index.') >'.$index.'</a></li>';
                        }
                    }
            if ($currPage == $pages) {
                echo '<li class="page-item disabled"><a class="page-link" onclick=changePage(' . ($currPage + 1) . ')>Next</a></li>
                            </ul>
                        </nav>          ';
            } else {
                echo '<li class="page-item"><a class="page-link" onclick=changePage(' . ($currPage + 1) . ')>Next</a></li>
                            </ul>
                        </nav>          ';
            }
                }
                else{
            echo '<nav aria-label="Page navigation example">
                     <ul class="pagination justify-content-end">';
            if ($currPage > 1) {

                echo '<li class="page-item "><a class="page-link"  onclick=changePage(' . ($currPage - 1) . ')>Previous</a></li>';
            } else {
                echo '<li class="page-item disabled"><a class="page-link"  >Previous</a></li>';
            }
                    for($index=1;$index<=$pages;$index++){
                        
                        if($index==$currPage){
                            echo'<li class="page-item active"><a class="page-link" onclick=changePage('.$index.') >'.$index.'</a></li>';
                        }
                        else{
                        echo'<li class="page-item"><a class="page-link" onclick=changePage('.$index.') >'.$index.'</a></li>';
                        }
                }
                if($currPage==$pages){
                echo '<li class="page-item disabled"><a class="page-link" onclick=changePage(' . ($currPage + 1) . ')>Next</a></li>
                            </ul>
                        </nav>          ';
                }
                else{
                echo '<li class="page-item"><a class="page-link" onclick=changePage(' . ($currPage + 1) . ')>Next</a></li>
                            </ul>
                        </nav>          ';
                }
            }
            
                 
                
        }
    


   }




            echo'
            <div class="products-section">';


            
            renderListProducts($currPage,$conn);    
        
             
             
             


   

           



            echo'</div>
        <div class="pagination-section">';
            
              
                renderPagination();
               

                
            
         echo'</div>';
         ?>

            
