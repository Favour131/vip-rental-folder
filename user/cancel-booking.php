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
UPDATE bookings_table

SET booking_status = 'Cancelled'

WHERE id = ?

AND user_id = ?

AND booking_status = 'Pending'
";



$stmt = mysqli_prepare($conn,$sql);


mysqli_stmt_bind_param(

    $stmt,

    "ii",

    $booking_id,

    $user_id

);



mysqli_stmt_execute($stmt);



mysqli_stmt_close($stmt);

mysqli_close($conn);



header("Location: user-dashboard.php");

exit();


?>