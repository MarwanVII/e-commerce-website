<?php
session_start();
include 'Admin.php';
include 'connectDatabase.php';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $formEmail=$_POST['adminEmail'];
    $formPassword=$_POST['adminPassword'];

    $selectLoginQuery = $pdo->prepare("SELECT * FROM `admin` WHERE adminEmail = :formEmail");
    $selectLoginQuery->bindParam(':formEmail', $formEmail);


    $selectLoginQuery->execute();
    $selectLoginQuery->setFetchMode(PDO::FETCH_CLASS,'Admin');
    $admin=$selectLoginQuery->fetch();
    //var_dump($user);

    if(isset($admin) && $formPassword == $admin->adminPassword){
        $_SESSION['adminEmail']=$admin->adminEmail;
        header('Location: dashboard.php');
    }
    else
    {
        $_SESSION['adminLoginError']='your email or password is not right!';
        header('Location: dashboardLogin.php');
    }
}
else
{
    echo '<h1>'."Wrong request method!".'</h1>';
    header('Refresh: 3;URL=dashboardLogin.php');
}
