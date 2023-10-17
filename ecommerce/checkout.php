<?php
session_start();
if(isset($_SESSION['userId']))
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include 'head.php'; ?>
    </head>
    <body>
    <?php include 'header.php'; ?>
    <?php include 'nav.php'; ?>
    <br>
    <div class="container">
            <!-- row -->
            <div class="row">
                <div style="" class="billing-details">

                    <!-- Order Details -->
                    <div class=" order-details">
                        <?php
                        include 'connectDatabase.php';
                        include 'Product.php';
                        include 'Bill.php';
                        $userId = $_SESSION['userId'];
                        $selectBillsQuery = $pdo->prepare("SELECT * FROM `bills` WHERE userId = $userId AND checkout = 0");
                        $selectBillsQuery->execute();
                        $selectBillsQuery->setFetchMode(PDO::FETCH_CLASS,'Bill');
                        $bills=$selectBillsQuery->fetchAll(PDO::FETCH_OBJ);
                        if (!empty($bills))
                        {
                            $counter = 0;
                            foreach ($bills as $bill)
                            {
                                $productIds[$counter++] = $bill->productId;
                            }
                            $selectProductQuery = "SELECT * FROM `product` WHERE productId = $productIds[0]";
                            for ($i=1,$size=count($productIds);$i < $size; ++$i)
                            {
                                $selectProductQuery = $selectProductQuery.' OR '.$productIds[$i];
                            }
                            $selectProductQuery = $pdo->prepare($selectProductQuery);
                            $selectProductQuery->execute();
                            $selectProductQuery->setFetchMode(PDO::FETCH_CLASS,'Product');
                            $products=$selectProductQuery->fetchAll(PDO::FETCH_OBJ);
                            ?>
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">

                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>

                            <div class="order-products">
                                <?php
                                $totalPrice = 0;
                                foreach ($products as $product)
                                {
                                ?>
                                <div class="order-col">
                                    <div><?=$product->brand.' '.$product->productName?></div>
                                    <div><?=$product->price?></div>
                                </div>
                                <?php
                                    $totalPrice+=$product->price;
                                    $_SESSION['productIds']= $productIds;
                                }
                                ?>
                            </div>
                            <div class="order-col">
                                <div>Shiping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">$<?=$totalPrice?></strong></div>
                            </div>
                        </div>

                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the terms & conditions
                            </label>
                        </div>
                        <a href="checkoutValidation.php" class="primary-btn order-submit">Place order</a>
                        <?php
                            }
                            else
                            {
                                if(isset($_SESSION['checkoutSuccess']))
                                {
                                    ?>
                                    <div class="section-title text-center alert-success">
                                        <h3 class="title"><?=$_SESSION['checkoutSuccess']?>
                                        </h3>
                                    </div>
                                    <?php
                                    unset($_SESSION['checkoutSuccess']);
                                }
                                else{
                                ?>
                                <div class="section-title text-center">
                                    <h3 class="title">YOU HAVE NO ORDERS <br><br>
                                        <a href="index.php">BUY NOW!</a>
                                    </h3>
                                </div>
                                <?php
                                }
                        }
                        ?>
                    </div>
                    <!-- /Order Details -->
                </div>
            </div>
    </div>

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
    <?php
}
else {
    header("Location: index.php");
    exit;
}
?>
