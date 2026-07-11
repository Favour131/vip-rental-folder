<?php

session_start();

require "../config.php";


if(!isset($_SESSION["user_id"])){

    header("Location: ../login.php");
    exit();

}


if(!isset($_GET["id"])){

    header("Location: user-dashboard.php");
    exit();

}


$user_id = $_SESSION["user_id"];

$booking_id = intval($_GET["id"]);



$sql = "

SELECT *

FROM bookings_table

WHERE id = ?

AND user_id = ?

AND booking_status = 'Pending'

LIMIT 1

";



$stmt = mysqli_prepare($conn,$sql);


mysqli_stmt_bind_param(

    $stmt,

    "ii",

    $booking_id,

    $user_id

);



mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$booking = mysqli_fetch_assoc($result);



if(!$booking){

    header("Location: user-dashboard.php");

    exit();

}



// store booking data temporarily

$_SESSION["editing_booking_id"] = $booking["id"];

$_SESSION["editing_booking_data"] = $booking;



header("Location: ../bookride.php?vehicle_id=".$booking["vehicle_id"]);

exit();


?>