<?php
include_once './header.php';
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}
header("location: index.php?id=$ID_COM")
?>