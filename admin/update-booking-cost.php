<?php

session_start();

require "../config.php";


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}


if(isset($_POST["booking_id"]) && isset($_POST["quoted_amount"])){


    $booking_id = $_POST["booking_id"];

    $quoted_amount = $_POST["quoted_amount"];



    $sql = "

    UPDATE bookings_table

    SET quoted_amount=?

    WHERE id=?

    ";



    $stmt = mysqli_prepare($conn,$sql);



    mysqli_stmt_bind_param(

        $stmt,

        "di",

        $quoted_amount,

        $booking_id

    );



    mysqli_stmt_execute($stmt);



    mysqli_stmt_close($stmt);


}



header("Location: manage-bookings.php");

exit();


?>