<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user'])){
    header ('location:contact.php?du kan inte besöka sidan');
}else{
    echo "";
$user =$_SESSION['user'];
}

if(isset($_GET['avboka'])&&isset($_SESSION['kvar'])&&$_SESSION['kvar']!=""){
    
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
<?php
    $result = $conn->query("SELECT * FROM hours WHERE booker_name = '$user'");
    if ($result->num_rows > 0) {
        echo "<div class='container'><div class='card mt-5'><div class='card-body'><table class='table table-bordered'>";
        echo "<thead><tr><th>Datum</th><th>Tid</th><th>Åtgärd</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            $date_time = $row["itemid"];
            $date = date("j M Y", strtotime(substr($date_time, 0, 9)));
            $time = date("H:i", strtotime(substr($date_time, 9)));
            echo "<tr><td>".$date."</td><td>".$time."</td><td><button onclick='showModal();'>Avboka</button></td></tr>";
        }
        echo "</tbody></table></div></div></div>";
    } else {
        echo "<div class='container'><div class='card mt-5'><div class='card-body'>";
        echo "<p>Du har inga bokade tider.</p>";
        echo "</div></div></div>";
    }
?>

<div id='modal-area' style='display:none;'>
    <div class='modal-content text-center' style='width:600px;'>
        <form action='' method='POST' autocomplete='off' class='form-class'>
            <h3>Avboka tid</h3>
            <p>Är du säker på att du vill avboka den här tiden?</p>
            <button type='submit' class='btn btn-danger'>Ja</button>
            <button type='button' class='btn btn-secondary' onclick='hideModal();'>Nej</button>
        </form>
    </div>
</div>
	  
 <center><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='test2.php'"><i class="fa fa-home"></i></button><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='home.php'">BOKA</button>
     <button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='view.php'">VISA</button><button onclick="window.location.href='logout.php?logout'" class="btn btn-lg" style="margin:5px;" href="logout.php?logout">LOGGA UT</button></center>
  
<script type="text/javascript">
 function showModal() {
        document.getElementById('modal-area').style.display = 'block';
    }
    
    function hideModal() {
        document.getElementById('modal-area').style.display = 'none';
    }
</script>
</body>

</html>

