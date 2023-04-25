<?php
session_start();
include 'db.php';

if(isset($_POST['submit'])){
 if(empty($_POST['username']) || empty($_POST['password'])){
 header('location: contact.php?skriv in nått');
 }
 else
 {
     if($_POST['username']=='dj'){
         $_SESSION['accesstoken'] = $user;
      header("Location: sistadagen.php?$user");
     }
     
 //Define $user and $pass
 $user=$_POST['username'];
 $pass=$_POST['password'];
 $query = mysqli_query($conn, "SELECT * FROM accounts WHERE userpassword='$pass' AND username='$user'");
 

 
 $rows = mysqli_num_rows($query);
 if($rows == 1){
   $_SESSION['user'] = $user;
 header("Location: test2.php?$user");

 }
 else
 {
  header('location: contact.php?fel');

 }
 mysqli_close($conn); // Closing connection
 }
}
 
?>
