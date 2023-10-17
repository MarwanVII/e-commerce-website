<?php
session_start();
session_unset();
unset($_SESSION['userId']);
session_regenerate_id();
session_destroy();
header('Location: index.php');
?>