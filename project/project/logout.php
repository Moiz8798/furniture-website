<?php
session_start();
$_SESSION['cart'] = [];
session_unset();
session_destroy();
header("Location: ../HtmlFiles/HomePage.php");
exit();
?>