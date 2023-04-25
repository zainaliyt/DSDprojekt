<?php
date_default_timezone_set('Europe/Stockholm');
session_start();
include 'db.php';

$hours = array("07:00","10:00","13:00","16:00","19:00"); 

// Set the current date to the first day of the current week
if(isset($_SESSION['date']) && !empty($_SESSION['date'])){
    $cdate = $_SESSION['date'];
} else {
    $cdate = date('Y-m-d');
    $dayOfWeek = date('N', strtotime($cdate));
    $cdate = date('Y-m-d', strtotime("-" . ($dayOfWeek - 1) . " days", strtotime($cdate)));
}

echo "<div class='container'><div class='row'><div class='col-12 text-center mb-3'>";
echo "<a href='?date=".date('Y-m-d', strtotime('-1 week', strtotime($cdate)))."' class='btn btn-lg'>Föregående vecka</a>";
echo "<a href='?date=".date('Y-m-d')."' class='btn btn-lg mx-2'>Nuvarande vecka</a>";
echo "<a href='?date=".date('Y-m-d', strtotime('+1 week', strtotime($cdate)))."' class='btn btn-lg'>Nästa vecka</a>";
echo "</div></div>";

for($i = 0; $i < 7; $i++){
    $dt = new DateTime($cdate);
    $current_date = $dt->format('Y-m-d');
    $dayname = $dt->format('dMY');
    echo "<div class='col-md-2'><div class='card'><div class='card-header text-center'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</div><div class='card-body text-center'>";
    foreach($hours as $yi){
        $passid= $dayname.$yi;
        $result0 = $conn->query("SELECT * FROM hours WHERE itemid = '$passid'");
        if($result0->num_rows == 0) {
            if($current_date.' '.$yi==date('Y-m-d H:i', strtotime('+2 hour'))||$current_date.' '.$yi<date('Y-m-d H:i', strtotime('+2 hour'))) {
                echo "<a class='btn btn-danger disabled' style='font-size:12px;margin:2px;color:white;text-decoration: line-through;font-weight:bold;'>$yi</a>"; 
            } else {
                echo "<a class='btn btn-outline-success' href='?pd=$current_date&pt=$yi&passid=$passid' style='font-size:12px;margin:2px;border:1.5px solid green;color:black;font-weight:bold;'>$yi</a>"; 
            }
        } else {
            echo "<a class='btn btn-danger disabled' style='font-size:12px;margin:2px;color:white;text-decoration: line-through;font-weight:bold;'>$yi</a>"; 
        }
    }
    echo "</div></div></div>";
    $dt->modify('+1 day');
    $cdate = $dt->format('Y-m-d');
}
echo "</div></div>";
?> 
