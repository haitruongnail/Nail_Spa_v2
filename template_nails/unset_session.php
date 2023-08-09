<?php
session_start();
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}
if(isset($_SESSION['user-book'])){
    unset($_SESSION['user-book']);
}

if(isset($_GET['id'])){
    $ID_COM = $_GET['id'];
    header("location: index.php?id=$ID_COM");
}else{
    header("location: 404.php");
}
?>