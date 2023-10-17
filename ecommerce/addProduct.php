<?php
session_start();
if(isset($_SESSION['adminEmail']))
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'head.php';
    ?>
</head>

<body>
<div class="container">

        <form class="col g-3 needs-validation container" action="insertProduct.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div style="text-align: center;" class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Add Product</h3>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom01" class="form-label">brand</label>
                        <input type="text" class="input" id="brand" name="brand"/>
                        <?php if(isset($_SESSION['brandError']))
                        {
                            ?>
                            <p class="alert-danger">
                                <?php
                                echo $_SESSION['brandError'];
                                ?>
                            </p>
                        <?php }?>
                    </div>

                    <div class="form-group">
                        <label for="validationCustom02" class="form-label">productName</label>
                        <input type="text" class="input" id="productName" name="productName"/>
                        <?php if(isset($_SESSION['productNameError']))
                        {
                            ?>
                            <p class="alert-danger">
                                <?php
                                echo $_SESSION['productNameError'];
                                ?>
                            </p>
                        <?php }?>
                    </div>

                    <div class="form-group">
                        <label for="validationCustom02" class="form-label">price</label>
                        <input type="text" class="input" id="price" name="price"/>
                        <?php if(isset($_SESSION['priceError']))
                        {
                            ?>
                            <p class="alert-danger">
                                <?php
                                echo $_SESSION['priceError'];
                                ?>
                            </p>
                        <?php }?>
                    </div>

                    <div class="form-group">
                        <label for="validationCustom02" class="form-label">product Image</label>
                        <input type="file" value="" class="input" id="validationCustom02" name="userImage"  >
                        <?php if(isset($_SESSION['userImageError']))
                        {
                            ?>
                            <p class="alert-danger">
                                <?php
                                echo $_SESSION['userImageError'];
                                ?>
                            </p>
                        <?php }?>
                    </div>

                    <div class="form-group">
                        <label for="category" class="form-label">Category</label>
                        <select class="input" name="category">
                            <?php
                            include 'Category.php';
                            include 'connectDatabase.php';
                            $selectCategoryQuery = $pdo->prepare("SELECT * FROM `category`");
                            $selectCategoryQuery->execute();
                            $selectCategoryQuery->setFetchMode(PDO::FETCH_CLASS,'Category');
                            $categories=$selectCategoryQuery->fetchAll(PDO::FETCH_OBJ);
                            foreach ($categories as $category)
                            {
                            ?>
                            <option value="<?= $category->categoryId?>"><?= $category->categoryName?></option>
                            <?php } ?>
                        </select>
                        <?php if(isset($_SESSION['categoryError']))
                        {
                            ?>
                            <p class="alert-danger">
                                <?php
                                echo $_SESSION['categoryError'];
                                ?>
                            </p>
                        <?php }
                        unset($_SESSION['brandError']);
                        unset($_SESSION['productNameError']);
                        unset($_SESSION['priceError']);
                        unset($_SESSION['categoryError']);
                        unset($_SESSION['userImageError']);
                        ?>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                "use strict";

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll(".needs-validation");

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        "submit",
                        (event) => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            })();
        </script>
    </div>
</div>
</body>

</html>
<!--    --><?php
}
else {
    header("Location: dashboardLogin.php");
    exit;
}
?>