<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user'])){
    header ('location:contact.php?du kan inte besöka sidan');
}else{
    echo "";
$user =$_SESSION['user'];
}

$query3 = "SELECT * FROM accounts where username = '$user'";
$result2 = mysqli_query($conn,$query3);
if (!$result2) exit("The query did not succeded");
else {
    while ($row2 = mysqli_fetch_array($result2)) {
    $kvarande = $row2['kvar'];
	    $_SESSION["kvar"] = $kvarande;
	    $_SESSION["username"] = $row2['username'];
    }

}
 

?>
<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="po.png" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boka Tid!</title>
   <link rel="stylesheet" href="styles.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>  
  </head>
  <body onload="startTime()">
    <center><div class="storimg"><center><h2 class="h2main">Boka tider snabbt och enkelt!</h2><h3 style="font-weight:bold;">Regler</h3><div class="regler"><span>- Max 3 bokningar per månad<br>- Endast 1 pass på samma dag<br>Ifall du ångrar dig, boka av passet 1 dygn innan tiden börjar</span></div></center></div></center>
 <center><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='test2.php'"><i class="fa fa-home"></i></button><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='index.php'">BOKA</button>
     <button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='view.php'">VISA</button><button onclick="window.location.href='logout.php?logout'" class="btn btn-lg" style="margin:5px;" href="logout.php?logout">LOGGA UT</button></center>
  
<script type="text/javascript">
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

function quote(){
    var quote= document.getElementById('modal-area').style.display="block";
}
function closebtn(){
    var quote= document.getElementById('modal-area').style.display="none";
     if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
    window.location.href='test2.php?d';
}

function ask(){
    return confirm("Vill du verkligen avboka passet?");
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
</body>

</html>
