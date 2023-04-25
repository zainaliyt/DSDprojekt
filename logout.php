<?php 
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    header("location:contact.php");
}else{
header("location: contact.php");
}



?>