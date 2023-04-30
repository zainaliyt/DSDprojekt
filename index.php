<?php
session_start();
include 'db.php';
$msg ="";
if(!isset($_SESSION['user'])){
    header ('location:contact.php?du kan inte besöka sidan');
}else{
    echo "";
    $user =$_SESSION['user'];
}

if(isset($_SESSION['lyckad'])&&$_SESSION['lyckad']!=""){
    $msg =$_SESSION['lyckad'];
}else if(isset($_SESSION['misslyckad'])&&$_SESSION['misslyckad']!=""){
	$msg =$_SESSION['misslyckad'];
}

unset($_SESSION['lyckad']);
unset($_SESSION['misslyckad']);
$query3 = "SELECT * FROM accounts where username = '$user'";
$result2 = mysqli_query($conn,$query3);
if (!$result2) exit("The query did not succeded");
else {
    while ($row2 = mysqli_fetch_array($result2)) {
    $kvarande = $row2['kvar'];
	    $_SESSION["kvar"] = $kvarande;
	    $_SESSION["username"] = $row2['username'];
	    if($kvarande>=1){
		    $stylebtn = "bg-info";
		    }else{
		    $msg = "Du har nått max antal bokningar denna månad!!";
		    $stylebtn = "bg-danger";
	    }
	    
    }

}

if (isset($_POST['submit'])) {
    $passid = $_SESSION['passid'];
    $username = $_SESSION['username'];
    $datetime = date('Y-m-d H:i:s');
    
    // Check if the record already exists
    $check_query = "SELECT * FROM hours WHERE itemid = '$passid'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Record already exists
        $msg = "Bokning misslyckades! Tiden är redan bokad.";
	unset($_SESSION['passid']);
        $_SESSION['misslyckad'] = $msg;
        header("Location: ?msg=".urlencode($msg));
        exit();
    } else {
        // Record does not exist, insert new record
        $boka = "INSERT INTO hours (itemid, booker_name, createdtime, completed) VALUES ('$passid', '$username', '$datetime', 0)";
        $res = mysqli_query($conn, $boka);
        
        if (!$res){
            $msg = "Bokning misslyckades! Gick inte boka tid!!";
	    unset($_SESSION['passid']);
            $_SESSION['misslyckad'] = $msg;
            header("Location: ?msg=".urlencode($msg));
            exit();
        } else {
            // Update the remaining count of bookings
            $newKvar = $_SESSION["kvar"];
            if ($newKvar == 0) {
                $reg = "UPDATE accounts SET kvar=0 WHERE username='$username'";
                $res1 = mysqli_query($conn, $reg);
            } else {
                $newKvar = $newKvar-1;
                $reg = "UPDATE accounts SET kvar='$newKvar' WHERE username='$username'";
                $res1 = mysqli_query($conn, $reg);
            }
            $msg = "Bokning Lyckad!!";
            unset($_SESSION['passid']);
            $_SESSION['lyckad'] = $msg;
            header("Location: ?msg=".urlencode($msg));
            exit();
        }
    }
}


if(isset($_GET['pt'])&&isset($_GET['pd'])&&isset($_GET['passid']))
	
{
	$p = $_GET['pt'];
	$d =$_GET['pd'];
	$k = $_SESSION['kvar'];
	$passid = $_GET['passid'];
	$_SESSION['passid'] = $passid;
	if(isset($k)&&$k!=""){
		if($k<=0){
			echo "<div id='modal-area' >
	    <div class='modal-content text-center' style='width:600px;'>
		<form action='' method='POST' autocomplete='off' class='form-class'>
		<h3>Fel meddelande!</h3>
		<h4>$msg</h4>
		<button class='bbtns' onclick='closebtn();'>Stäng</button>
		</form>
	    </div>
	</div> ";
		}else{
			echo "<div id='modal-area' >
	    <div class='modal-content text-center' style='width:600px;'>
		<form action='' method='POST' autocomplete='off' class='form-class'>
			<a>$msg</a>
		<h3>Boka</h3>
		<h4>Vill du verkligen boka $p, $d</h4>
		<button class='bbtns' onclick='closebtn();'>Stäng</button>
		<button id='subbtn' class='bbtns' type='submit' name='submit'>Boka</button>
		</form>
	    </div>
	</div> ";
		}
	}
}	
?>
</script>
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
  <body>
      <center class="<?php global $stylebtn;
 echo $stylebtn; ?>">Du har <?php echo $kvarande;?>st bokningar kvar!<h2 class="<?php echo isset($_SESSION['misslyckad'])?'bg-danger':''; ?>"><?php echo isset($msg)?$msg:''; ?></h2></center>
                    <div class="container">
    <?php     if(isset($_GET['date'])){
        $date = $_GET['date'];
        $_SESSION['date'] = $date;
        $cdate = $_SESSION['date'];
    }else{
        $cdate = date('Y-m-d');
    }
$prev_date = date('Y-m-d', strtotime($cdate .' -1 day'));
$today_date = date('Y-m-d');
$next_date = date('Y-m-d', strtotime($cdate .' +1 day'));
?>
        <div class="row" id="updatethis">
            
        </div>
</div>
                    
    <center><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='test2.php'"><i class="fa fa-home"></i></button><button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='index.php'">BOKA</button>
     <button class="btn btn-lg" style="margin:5px;" onclick="window.location.href='view.php'">VISA</button><button onclick="window.location.href='logout.php?logout'" class="btn btn-lg" style="margin:5px;" href="logout.php?logout">LOGGA UT</button></center>
    
<script type="text/javascript">
/*function noref(){
    var dayto = new Date();
    var hours = dayto.getHours();
      var daytoday = dayto.getDate();
  console.log(`${daytoday}+a`);
  if(hours > 11){
      document.getElementById(`${daytoday}+a`).className += "btn-danger disabled btn-xs";
  }
}*/
function quote(){
    var quote= document.getElementById('modal-area').style.display="block";
}

function opend(){
    var e = confirm('Viktigt!\nDu kan endast boka 3 pass per månad! \nTryck \'Visa\' för att kunna se dina bokningar!');
        
}


function closebtn(){
    var quote= document.getElementById('modal-area').style.display="none";
     if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
    window.location.href='test2.php?d';
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
	
</script>
	  <script>

    $(document).ready(function(){
        $("#updatethis").load("load.php");
        setInterval(function(){
            $("#updatethis").load("load.php");
        },1000);
        
});
</script>
</body>

</html>
