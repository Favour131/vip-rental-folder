<?php

session_start();

require "../config.php";


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}



if(isset($_GET["id"]) && isset($_GET["status"])){

    $booking_id = intval($_GET["id"]);

    $status = $_GET["status"];


    if($status == "Paid"){


        $sql = "
        UPDATE bookings_table
        SET payment_status=?
        WHERE id=?
        ";


        $stmt = mysqli_prepare($conn,$sql);


        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $status,
            $booking_id
        );


        mysqli_stmt_execute($stmt);


        mysqli_stmt_close($stmt);

    }

}



header("Location: manage-bookings.php");

exit();


?>