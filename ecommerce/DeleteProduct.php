<?php
session_start();
include 'connectDatabase.php';
include 'Product.php';
if(isset($_SESSION['adminEmail']) && $_GET['productId'])
{
    $productId= $_GET['productId'];
    $deleteProductQuer=$pdo->prepare('DELETE FROM product WHERE productId=:productId');
    $deleteProductQuer->bindParam(':productId',$productId);
    $deleteProductQuer->execute();
//    $deleteProductQuer->setFetchMode(PDO::FETCH_CLASS,'Product');
//    $products=$deleteProductQuer->fetchAll(PDO::FETCH_OBJ);
    header('location:dashboard.php');
}
else{
    header('location:dashboardLogin.php');
}