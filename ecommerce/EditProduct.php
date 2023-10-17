<?php
session_start();
include 'connectDatabase.php';
include 'Product.php';
if(isset($_SESSION['adminEmail']) && $_GET['productId'])
{
    $productId= $_GET['productId'];
    $editProductQuery=$pdo->prepare('SELECT * FROM product WHERE productId=:productId');
    $editProductQuery->bindParam(':productId',$productId);
    $editProductQuery->execute();
    $editProductQuery->setFetchMode(PDO::FETCH_CLASS,'Product');
    $products=$editProductQuery->fetch();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    </head>

    <body>
    <div class="container">
        <div class="row">
            <form class="col g-3 needs-validation" action="UpdataProduct.php?productId=<?=$products->productId?>" method="post" enctype="multipart/form-data">
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">brand</label>
                    <input type="text" class="form-control" id="brand" value="<?=$products->brand?>" name="brand"/>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">productName</label>
                    <input type="text" class="form-control" id="productName" value="<?=$products->productName?>" name="productName" />
                </div>

                <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">price</label>
                    <input type="text" class="form-control" id="price"  value="<?=$products->price?>" name="price"/>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <br>
                <div class="col-md-4">

                    <label for="validationCustom02" class="form-label">product Image</label>
                    <input type="file" value="<?=$products->picture?>" class="form-control" id="validationCustom02"  name="userImage" / >
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" name="category">
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
                </div>
                <div class="col-12"><br>
                    <button class="btn btn-primary" type="submit">Submit form</button>
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
    <?php
}
else
{
    header('location:dashboardLogin.php');
}
?>
