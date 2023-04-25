<?php 
session_start();
if(array_key_exists('checked',$_SESSION) && !empty($_SESSION['checked'])) {
    if($_SESSION['checked']=='true'){
        echo "<center><p class='checkp'>Du är nu checkad in!</p></center>";
        session_destroy();
    }elseif($_SESSION['checked']=='false'){
        echo "<center><p style='background-color:red; color:white;'>Gick inte att checka in!</p></center>";
        session_destroy();
    }
}

?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<title>Bokify</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body onload="startTime()">
    <div class="container">
<form method="POST" action="loginprocess.php">
Username : <input type="text" name="username"><br> !för test: admin<br>
Password : <input type="password" name="password"><br> !för test: admin123<br>
<input type="submit" value="Logga in" name="submit"><br><br>
</form>
<form class="checkinform" method="POST" action="checkinprocess.php">
   Check in code : <input type="text" name="checkvalue" value="ex. 0119P1[Password]" id="myInput">
    <input type="submit" value="Check In" name="check">
</form>
</div>
<center class="bottombox">
<h4 id="timeNow"></h4><?php

setlocale(LC_TIME, "sv_SE");
echo date("j F, Y");

?></center>
<style>
 .container { 
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  text-align: center;

 }
 .checkinform{
     margin:0;
 }
 
 .checkp{
     color:white;
     background-color:green;
 }
 h4{
     margin-bottom:0;
     margin-top:30px;
 }
 
 .bottombox{
     width:100%;
     font-family:"Courier New", Courier, monospace;
     font-size:100px;
     transform:uppercase;
 }
 
 form{
     margin: 50px;
     margin-bottom:30px;
 }
 
 input[type=post], password, text {
  width: 100%;
  height: auto;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
  
}
 
 input[type=submit]{
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #45a049;
}

  
</style>

<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('timeNow').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}

var cc =document.getElementById('now');
cc.addEventListener('keyup',function(){
var t=  cc.value.length;
console.log(t);

if(!t){
   var s= document.getElementById('now').value;
   
}

if(document.getElementById('now').value==6){
    document.getElementById('now').type='password';

}
})
</script>

</body>
</html>
