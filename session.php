<?php 
session_start();
if(isset($_SESSION['email'])){
    header('location: home.php');
}else{
    if (isset($_GET['ses'])) {
        $_SESSION['email'] = $_GET['ses'];
        header('location: home.php');
    }else{
         header('location: login.php');
    }
   
}





?>