<?php
session_start();
include 'User.php';
include 'connectDatabase.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $formEmail=$_POST['email'];
    $formPassword=$_POST['password'];

    $selectLoginQuery = $pdo->prepare("SELECT * FROM `user` WHERE email = :formEmail");
    $selectLoginQuery->bindParam(':formEmail', $formEmail);
    //$selectLoginQuery->bindParam(':formPassword', $formPassword);

    $selectLoginQuery->execute();
    $selectLoginQuery->setFetchMode(PDO::FETCH_CLASS,'User');
    $user=$selectLoginQuery->fetch();
    //var_dump($user);

    if(isset($user) && password_verify($formPassword,$user->password)){
        $_SESSION['userId']=$user->userId;
        if(!isset($_SESSION['productId']))
        {
            header('Location: index.php');
        }
        else
        {
            header('Location: productPage.php?productId='.$_SESSION['productId']);
        }
    }
    else
    {
        $_SESSION['loginError']='your email or password is not right!';
        header('Location: login.php');
    }
}
else
{
    echo '<h1>'."Wrong request method!".'</h1>';
    header('Refresh: 3;URL=login.php');
}