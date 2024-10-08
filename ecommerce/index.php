<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
include 'head.php';
?>
</head>
<body>
<?php include 'header.php';
include 'nav.php'; ?>

<!-- SECTION -->

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <a href="categoryStore.php?categoryId=<?=$categories[0]->categoryId ?>">
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./img/shop01.png" width="50px" height="250px" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptop<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            </a>
            <!-- /shop -->

            <!-- shop -->
            <a href="categoryStore.php?categoryId=<?=$categories[1]->categoryId ?>">
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img" >
                            <img width="50px" height="250px" src="./img/phone.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Phone<br>Collection</h3>
                            <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </a>
            <!-- /shop -->

            <!-- shop -->
            <a href="categoryStore.php?categoryId=<?=$categories[2]->categoryId ?>">
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./img/shop03.png" width="50px" height="250px" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Accessories<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            </a>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->


<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
<!--                        <li>-->
<!--                            <div>-->
<!--                                <h3>34</h3>-->
<!--                                <span>Mins</span>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div>-->
<!--                                <h3>60</h3>-->
<!--                                <span>Secs</span>-->
<!--                            </div>-->
<!--                        </li>-->
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
<!--                    <div class="section-nav">-->
<!--                        <ul class="section-tab-nav tab-nav">-->
<!--                            <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>-->
<!--                            <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>-->
<!--                            <li><a data-toggle="tab" href="#tab1">Cameras</a></li>-->
<!--                            <li><a data-toggle="tab" href="#tab1">Accessories</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                <?php
                                include 'connectDatabase.php';
                                include 'Product.php';
                                $selectProductQuery = $pdo->prepare("SELECT * FROM `product` WHERE available = 1");
                                $selectProductQuery->execute();
                                $selectProductQuery->setFetchMode(PDO::FETCH_CLASS,'Product');
                                $products=$selectProductQuery->fetchAll(PDO::FETCH_OBJ);
                                $counter=0;
                                foreach ($products as $product)
                                {
                                    if($counter > 6)
                                    {
                                        break;
                                    }
                                    $counter++;
                                ?>
                                <div class="product">

                                    <a href="productPage.php?productId=<?= $product->productId;?>">
                                        <div class="product-img">
                                        <img src="./img/<?=$product->picture?>" width="50px" height="250px" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                            <span class="new">NEW</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">
                                            <?php
                                            $categoryId = $product->categoryId;
                                            $selectCategoryNameQuery = $pdo->prepare("SELECT categoryName FROM `category` WHERE categoryId = $categoryId");
                                            $selectCategoryNameQuery->execute();
                                            //$selectCategoryQuery->setFetchMode(PDO::FETCH_CLASS,'Category');
                                            $category=$selectCategoryNameQuery->fetch();
                                            echo $category['categoryName'];
                                            ?>
                                        </p>
                                        <h3 class="product-name"><a href="#"><?=$product->productName ?></a></h3>
                                        <h4 class="product-price"><?=$product->price ?> LE
<!--                                            <del class="product-old-price">$990.00</del>-->
                                        </h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </a>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                </div>
                                <div class="add-to-cart">
                                    <a href="addToCart.php?productId=<?= $product->productId;?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button></a>
                                </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->


<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Enter Your Email">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->

<?php include 'footer.php'; ?>

<!--scripts-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>
<!--scripts-->
</body>
</html>