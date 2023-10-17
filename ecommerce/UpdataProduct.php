<?php
session_start();
include 'connectDatabase.php';

if($_SERVER['REQUEST_METHOD']=='POST'&& $_GET['productId']){
    //POST Content
    $productId= $_GET['productId'];
    $brand = $_POST['brand'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $categoryId = $_POST['category'];
    //$picture=$_POST['picture'];

    //FILE Content

    $imageName=$_FILES['userImage']['name'];
    $imgNameArr=explode('.',$imageName);
    $imageNameEncrypted=bin2hex(random_bytes(32));
    $imgExt=end($imgNameArr);
    $dbImageName='electro-'.$imageNameEncrypted.'.'.$imgExt;
    $allowedExt=['png','jpg','jpeg','gif'];
    $picture=$_FILES['userImage']['tmp_name'];


    if(in_array($imgExt,$allowedExt)){
        //here everything is ok
        $insertQuery = $pdo->prepare("UPDATE product SET brand=:brand, productName=:productName, price=:price, picture=:picture, categoryId=:categoryId WHERE productId=:productId");
        $insertQuery->bindParam(':brand',$brand);
        $insertQuery->bindParam(':productName',$productName);
        $insertQuery->bindParam(':price',$price);
        $insertQuery->bindParam(':picture',$dbImageName);
        $insertQuery->bindParam(':categoryId',$categoryId);
        $insertQuery->bindParam(':productId',$productId);


        $insertQuery->execute();

        move_uploaded_file($picture,"./img/$dbImageName");

        header('Location:dashboard.php');
    }else
    {
        echo 'invalid input!';
    }
}