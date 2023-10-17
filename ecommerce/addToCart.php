<?php
session_start();
include 'connectDatabase.php';
include 'Bill.php';

if(isset($_SESSION['userId']))
{
    if(isset($_GET['productId']))
    {
        $userId = $_SESSION['userId'];
        $productId = $_GET['productId'];
        $creatBill = $pdo->prepare("INSERT INTO bills (productId, userId) VALUES ($productId , $userId)");
        $updateAvailability = $pdo->prepare("UPDATE product SET available = 0 WHERE productId = $productId");
        $creatBill->execute();
        $updateAvailability->execute();
        header('Location: index.php');
    }
    else
    {
        header('Location: index.php');
    }
}
else
{
    $_SESSION['productId']=$_GET['productId'];
    header('Location: login.php?');
}