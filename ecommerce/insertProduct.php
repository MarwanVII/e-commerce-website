<?php
session_start();
include 'connectDatabase.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    //POST Content

    $brand = $_POST['brand'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $categoryId = $_POST['category'];
    //$picture=$_POST['picture'];

    //Data validation
    // Validate Product brand
    if (empty($_POST["brand"]))
    {
        $_SESSION['brandError'] = "Please enter Product Brand.";
    }
    else
    {
        // Check if the brand format is valid
        if (!preg_match("/^[A-Za-z0-9\s]{3,}$/",$_POST["brand"]))
        {
            $_SESSION['brandError'] = "Invalid Brand Format.";
        }
        else
        {
            $_POST["brand"]=validate($_POST["brand"]);
        }
    }

    // Validate Product Name
    if (empty($_POST["productName"]))
    {
        $_SESSION['productNameError'] = "Please enter Product Name.";
    }
    else
    {
        // Check if the brand format is valid
        if (!preg_match('/^[A-Za-z0-9\s]{3,}$/',$_POST["productName"]))
        {
            $_SESSION['productNameError'] = "Invalid Product Name.";
        }
        else
        {
            $_POST["productName"]=validate($_POST["productName"]);
        }
    }
    // Validate Product Price
    if (empty($_POST["price"]))
    {
        $_SESSION['priceError'] = "Please enter a price.";
    }
    else
    {
        // Check if the name format is valid
        if (!preg_match('/^[0-9]{1,}$/',$_POST["price"]) ||$_POST["price"] <= 0 )
        {
            $_SESSION['priceError'] = "Invalid price Format.";
        }
        else
        {
            $_POST["price"]=validate($_POST["price"]);
        }
    }
    // Validate Product category
    if (empty($_POST["category"]))
    {
        $_SESSION['categoryError'] = "Please enter product category.";
    }
    else
    {
        // Check if the category format is valid
        if (!preg_match('/^[0-9]{1,2}$/',$_POST["category"]) || $_POST["category"] <= 0 )
        {
            $_SESSION['categoryError'] = "Invalid Category Format.";
        }
        else
        {
            $_POST["category"]=validate($_POST["category"]);
        }
    }
    //FILE Content
    $imageName=$_FILES['userImage']['name'];
    $imgNameArr=explode('.',$imageName);
    $imageNameEncrypted=bin2hex(random_bytes(32));
    $imgExt=end($imgNameArr);
    $dbImageName='electro-'.$imageNameEncrypted.'.'.$imgExt;
    $allowedExt=['png','jpg','jpeg','gif','webp'];
    $picture=$_FILES['userImage']['tmp_name'];
    // Validate Product image
    if(!in_array($imgExt,$allowedExt))
    {
        $_SESSION['userImageError']= 'Upload valid image';
    }

    if(empty($_SESSION['brandError']) && empty($_SESSION['productNameError']) &&empty($_SESSION['priceError']) &&empty($_SESSION['categoryError']) &&empty($_SESSION['userImageError'])){

        //here everything is ok
        $insertQuery=$pdo->prepare("INSERT INTO product (brand,productName,price,picture,categoryId ) VALUES (:brand,:productName,:price,:picture,:categoryId)");
        $insertQuery->bindParam(':brand',$brand);
        $insertQuery->bindParam(':productName',$productName);
        $insertQuery->bindParam(':price',$price);
        $insertQuery->bindParam(':picture',$dbImageName);
        $insertQuery->bindParam(':categoryId',$categoryId);

        $insertQuery->execute();

        move_uploaded_file($picture,"./img/$dbImageName");

        header('Location:dashboard.php');
    }
    else
    {
        header('Location:addProduct.php');
    }
}
else
{
    header('Location:login.php');
}
function validate($input){
    $input=trim($input);
    $input=strip_tags($input);
    $input=htmlspecialchars($input);
    return $input;
}