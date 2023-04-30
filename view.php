<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user'])){
    header ('location:contact.php?du kan inte besöka sidan');
}else{
    echo "";
$user =$_SESSION['user'];
}

if(isset($_GET['avboka'])){
    $pass = $_GET['pass'];
    $dag = $_GET['dag'];
    if($pass=='pass1'){
        $avb='firstpass';
        $s="status1";
        $avp='P1';
    }elseif($pass=='pass2'){
        $avb='secondpass';
        $avp='P2';
        $s="status2";
    }
    elseif($pass=='pass3'){
        $avb='thirdpass';
        $avp='P3';
        $s="status3";
    }
    
     $mont = date('m',strtotime($dag));
     $day = date('d',strtotime($dag));
    $passid = $mont.$day.$avp;
    
     $sql = "UPDATE Time SET $pass='', kund$pass='' WHERE kund$pass='$user' AND dag='$dag' ";
     $query5= $conn->prepare("UPDATE account SET kvar=kvar+1 WHERE username = '$user'");
     $query5->execute();
     $querynew = $conn->prepare("UPDATE account SET $avb='' WHERE username = '$user' AND $avb='$passid'");
     $querynew->execute();
    $result = mysqli_query($conn,$sql);
    if(!$result){
        echo 'gick inte att avboka passet!';
    }else{
          header('location: view.php?avbokat');
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
     
    <center><h2>Dina bokningar!</h2></center> 

	  
 <center><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='test2.php'"><i class="fa fa-home"></i></button><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='home.php'">BOKA</button>
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

