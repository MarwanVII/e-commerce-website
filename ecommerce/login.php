<?php
session_start();
if(!isset($_SESSION['userId']))
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

<div class="container">
    <form action="loginValidation.php?productId=<?php if(isset($_GET['productId'])) echo $_GET['productId'];?>" method="post" class="container">
        <!-- row -->
        <div class="row">
            <div style="text-align: center;" class="billing-details">
                <div class="section-title">
                    <h3 class="title">Sign in</h3>
                </div>


                <div class="form-group">
                    <input class="input" type="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input class="input" type="password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                    <?php if(isset($_SESSION['loginError']))
                    {
                        ?>
                        <p class="alert-danger">
                        <?php
                        echo $_SESSION['loginError'];
                        unset($_SESSION['loginError']);
                        ?>
                        </p>
                        <?php }?>
                </div>
                <div class ="form-group">
                    <button class="primary-btn order-submit" type="submit">login</button>
                </div>
                <div class ="form-group">
                    <a href="register.php">You don't have an account?</a>
                </div>
            </div>
        </div>
    </form>
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