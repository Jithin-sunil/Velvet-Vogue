<?php
session_start();
if($_SESSION['cid']==""){
    header('location:../Guest/login.php');
}
?>