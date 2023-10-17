<?php
session_start();

if(isset($_SESSION['userId']) && isset($_SESSION['productIds']))
{
    include 'connectDatabase.php';
    include 'Bill.php';
    $checkoutQuery = "UPDATE bills SET checkout = 1 WHERE productId = ".$_SESSION['productIds'][0];
    for ($i=1,$size=count($_SESSION['productIds']);$i < $size; ++$i)
    {
        $checkoutQuery = $checkoutQuery.' OR '.$_SESSION['productIds'][$i];
    }
    var_dump($checkoutQuery);
    $checkoutQuery = $pdo->prepare($checkoutQuery);
    $checkoutQuery->execute();
    $_SESSION['checkoutSuccess']='YOUR ORDER IS ON THE WAY!';
    header("Location: checkout.php");
}
else {
    header("Location: index.php");
    exit;
}
?>