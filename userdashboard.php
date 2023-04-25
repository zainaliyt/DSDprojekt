<?php 
include 'db.php';


if(isset($_GET['submit'])){
    $username = $_POST['dates'];  
    $usernameExists = "SELECT * FROM bookeddates WHERE dates = '".$username."'";;

if (mysql_num_rows($result)!=0) {
    echo "not Exists";
} else{
    echo "Exists";
}
}

?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="po.png" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boka Tid!</title>
   <link rel="stylesheet" href="styles.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
   <script src="mmm.js"></script>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>  
  </head>
  <body>
  <div class="grid-container">
  <div class="Topbar"><?php
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");
?></div>
  <div class="menubar">
    <div class="Bokab"><li><a href="#">Boka</a></li></div>
    <div class="Visab"><li><a href="#">Visa</a></li></div>
    <div class="lutb"><li><a href="#">Logga Ut</a></li></div>
  </div>
  <div class="ItemBox"> 
            <div class="container">
		<div class="row">
			<h2>Boka Tvättstuga!</h2>
		</div>
		<div class="row">
	        <div class='col-sm-6'>
	        	<form action="" method="POST" enctype="multipart/form-data">
		            <div class="form-group">
		                <div class='input-group date' id='datepicker'>
		                    <input type='text' class="form-control" name="dates" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    
		                </div>
		            </div>
		              <input type="submit" name="submit">
		        </form>
	        </div>
	    </div>
	</div>
  
  </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script >
	    $(function () {
	        $('#datepicker').datepicker({
	            format: "yyyy-mm-dd",
	            autoclose: true,
	            todayHighlight: true,
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        autoclose: true,
		        changeMonth: true,
		        changeYear: true,
		        orientation: "button"
	        });
	    });
	</script>
</body>

</html>
