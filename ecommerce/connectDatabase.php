<?php
try
{
    $pdo =new PDO('mysql:host=localhost;dbname=e_commerce_website','root','' );
}
catch (PDOException $ex) {
    echo $ex->getMessage();
    header('Refresh: 3;URL=index.php');
}
