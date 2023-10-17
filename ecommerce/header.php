<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +20-128-5455-966</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Marawanx00@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Qena, Egypt</a></li>
            </ul>
            <ul class="header-links pull-right">
                <?php
                if(isset($_SESSION['userId']))
                {
                ?>
                    <li><a href="logout.php"><i class="fa fa-user-o"></i>Logout</a></li>
                <?php }
                else{
                ?>
                <li><a href="login.php"><i class="fa fa-user-o"></i>Login</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="index.php" class="logo">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <?php
                        if (isset($_SESSION['userId']))
                        {

                        ?>
                        <div>
                            <a href="checkout.php">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                        <!-- /Wishlist -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->