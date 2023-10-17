<?php
session_start();
session_unset();
unset($_SESSION['adminEmail']);
session_regenerate_id();
session_destroy();
header('Location: dashboardLogin.php');
?>