<?php
session_start();
require_once "../model/config.php";
require_once "../model/database.php";

if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
}

if(isset($_SESSION['owner'])){
    unset($_SESSION['owner']);
}
header("location: ./login.php");