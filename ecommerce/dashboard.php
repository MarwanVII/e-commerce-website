<?php
session_start();
if(isset($_SESSION['adminEmail']))
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <?php
        include 'head.php';
        ?>
    </head>
    <body>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-envelope-o"></i> <?= $_SESSION['adminEmail']?></a></li>
            </ul>
            <ul class="header-links pull-right">
                <!--                -->
                <?php
                if(isset($_SESSION['adminEmail']))
                {
                    ?>
                    <li><a href="dashboardLogout.php"><i class="fa"></i>Logout</a></li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->
        <a href="addProduct.php"><button type="button" class="btn btn-success">Add</button></a>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Product Id</th>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                include 'Product.php';
                include 'connectDatabase.php';
                $selectProductQuery = $pdo->prepare("SELECT * FROM `product` WHERE available = 1");
                $selectProductQuery->execute();
                $selectProductQuery->setFetchMode(PDO::FETCH_CLASS,'Product');
                $products=$selectProductQuery->fetchAll(PDO::FETCH_OBJ);
                if(isset($products)){
                foreach ($products as $product)
                {

                ?>
                <th scope="row"><?= $product->productId?></th>
                <td><?= $product->productName?></td>
                <td><?= $product->brand?></td>
                <td><?= $product->price?></td>
                <td><?= $product->categoryId?></td>
                <td>
                    <a href="DeleteProduct.php?productId=<?= $product->productId?>"><button type="button" class="btn btn-danger">Delete</button></a>
                    <a href="EditProduct.php?productId=<?= $product->productId?>"><button type="button" class="btn btn-info">Edit</button></a>
                </td>

            </tr>
            <?php }}?>
            </tbody>
        </table>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"
        ></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </body>
    </html>
    <?php
}
else {
    header("Location: dashboardLogin.php");
    exit;
}
?>
