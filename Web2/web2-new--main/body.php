 <div class="background">
      </div>
      
      <div class="cart-section">
            <div class="overlay">
            </div>
      </div>
      <div class="filter-overlay">

            <div class="overlay">
               <?php
                   require('web/list_section.php')
               ?>
               
      
      
            </div>
      </div>
   <div class="content">
    
    <?php
    require('web/block.php');
    echo'<div class="container-product">
    <div class="top-section">
                <div class="left-section">

                    <span>Sort by:</span>
                    <form action="">
                    <select id="priceSort" onchange="orderByChange(this.value)" >
                        <option value="all">Price</option>
                        <option value="DESC">Price, low to high</option>
                        <option value="ASC">Price, high to low</option>

                    </select>
                    </form>
                </div>
                <div class="right-section">
                    <div class="filter" onclick="filterClick()"><span><i class="fa-sharp fa-solid fa-bars"></i></span>Filtter</div>
                    <div class="price-filter" style="">

                        <span>Search by the prices : from</span>
                            <select id="minPrice" onchange="minPriceChange(this.value)" >
                                <option value="none">none</option>
                                <option value="100">100$</option>
                                <option value="1000">1000$, low to high</option>
                                <option value="2000">2000$, high to low</option>
        
                            </select>
                            <span> to </span>
                            <select id="maxPrice" onchange="maxPriceChange(this.value)" >
                                <option value="none">none</option>
                                <option value="5000">5000$</option>
                                <option value="10000">10000$</option>
                                <option value="20000">20000$</option>
        
                            </select>
                    </div>
                  

                </div>
            </div>
            <div class="center-section">
            </div>
    </div>';
    ?>

   </div>