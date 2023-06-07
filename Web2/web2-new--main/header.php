            <div class="header-top">
                <div class="container">
                    <div class="header-middle-wrap">

                        <div class="theme-logo">
                            <a href="">
                                <img src="image/logo.png">
                            </a>
                        </div>

                        <!-- <div class="search-bar">
                            <form action="/search" method="get" class="header-search" role="search" style="position: relative;">
                                <input class="input-field" type="search" name="q" value="" placeholder="Search our store" aria-label="Search our store" autocomplete="off">

                                <button class="btn btn-outline-whisper btn-primary-hover" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div> -->

                        <div class="header-right">
                            <ul>
                                <li>
                                    <i class="fa-solid fa-user-group"></i>
                                    <ul class="sub-menu">
                                        <li><a href="./page/showAccount.php">My Account</a></li>

                                        <?php

                                        if (!isset($_SESSION['id'])) {
                                            echo '<li><a href="./page/FormLogin.php">Login</a></li>
                                        <li><a href="./page/register/FormSignUp.php">Register</a></li>';
                                        } else {
                                            echo '<li><a href="./page/logout.php">Logout</a></li>
                                        <li><a href="./web/ordertracking.php">Your orders</a></li>';
                                        }

                                        ?>
                                        >
                                    </ul>
                                </li>
                                <li>
                                    <i class="fa-solid fa-bag-shopping" id="cart-icon"></i>

                                    <div class="cart">
                                        <h2 class="cart-title">Your Cart</h2>

                                        <!-- CONTENT -->
                                        <div class="cart-content">
                                            <!-- TEST BOX -->

                                            <?php
                                            require('web/cartload.php')
                                            ?>
                                        </div>

                                        <!-- TOTAL -->
                                        <div class="total">
                                            <div class="total-title">TOTAL</div>
                                            <div class="total-price">$0</div>
                                        </div>

                                        <!-- BUY BUTTON -->
                                        <button type="button" class="btn-buy">Buy Now</button>

                                        <!-- CART CLOSE -->
                                        <i class='bx bx-x' id="cart-close"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- MAIN HEADER -->
            <div class="header-main">
                <div id="toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="container">
                    <ul id="main-menu">
                        <li><a href="">Home</a>
                        </li>
                        
                    </ul>
                </div>
            </div>