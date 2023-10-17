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
    <!-- row -->
    <div class="row">

        <form style="text-align: center;" class="billing-details" action="registerValidation.php" method="post">
            <div class="section-title">
                <h3 class="title">Register</h3>
            </div>
            <div class="form-group">
                <input class="input" type="text" name="fullName" placeholder="Full Name">
                <?php if(isset($_SESSION['fullNameError']))
                {
                    ?>
                    <p class="alert-danger">
                        <?php
                        echo $_SESSION['fullNameError'];
                        ?>
                    </p>
                <?php }?>
            </div>

            <div class="form-group">
                <input class="input" type="email" name="email" placeholder="Email">
                <?php if(isset($_SESSION['emailError']))
                {
                    ?>
                    <p class="alert-danger">
                        <?php
                        echo $_SESSION['emailError'];
                        ?>
                    </p>
                <?php }?>
            </div>
            <div class="form-group">
                <input class="input" type="password" name="password" placeholder="Password">
                <?php if(isset($_SESSION['passwordError']))
                {
                    ?>
                    <p class="alert-danger">
                        <?php
                        echo $_SESSION['passwordError'];
                        ?>
                    </p>
                <?php }?>
            </div>
            <div class="form-group">
                <input class="input" type="text" name="city" placeholder="City">
                <?php if(isset($_SESSION['cityError']))
                {
                    ?>
                    <p class="alert-danger">
                        <?php
                        echo $_SESSION['cityError'];
                        ?>
                    </p>
                <?php }?>
            </div>
            <div class="form-group">
                <input class="input" type="text" name="street" placeholder="Street">
                <?php if(isset($_SESSION['streetError']))
                {
                    ?>
                    <p class="alert-danger">
                        <?php
                        echo $_SESSION['streetError'];
                        ?>
                    </p>
                <?php }?>
            </div>
            <div class="form-group">
                <input class="input" type="tel" name="tel" placeholder="Telephone">
                <?php if(isset($_SESSION['telError']))
                {
                    ?>
                    <p class="alert-danger">
                        <?php
                        echo $_SESSION['telError'];
                        ?>
                    </p>
                <?php }
                unset($_SESSION['fullNameError']);
                unset($_SESSION['emailError']);
                unset($_SESSION['passwordError']);
                unset($_SESSION['cityError']);
                unset($_SESSION['streetError']);
                unset($_SESSION['telError']);
                ?>
            </div>
            <div class ="form-group ">
                <input type="submit" value="create account" class="primary-btn order-submit">
            </div>
        </form>
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


