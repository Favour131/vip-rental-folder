<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    
</body>
</html>
<?php

session_start();

require "../config.php";


if(!isset($_SESSION["user_id"])){

    header("Location: ../login.php");
    exit();

}


if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: user-dashboard.php");
    exit();

}


$user_id = $_SESSION["user_id"];

$booking_id = intval($_POST["booking_id"]);



/*
|--------------------------------------------------------------------------
| CHECK FILE
|--------------------------------------------------------------------------
*/


if(!isset($_FILES["receipt"]) || $_FILES["receipt"]["error"] != 0){

    die("Please upload a valid receipt.");

}



$file = $_FILES["receipt"];



$allowed_types = [

    "image/jpeg",
    "image/png",
    "application/pdf"

];



if(!in_array($file["type"], $allowed_types)){

    die("Invalid file type.");

}



/*
|--------------------------------------------------------------------------
| CREATE UPLOAD FOLDER
|--------------------------------------------------------------------------
*/


$upload_dir = "../uploads/payment_receipts/";


if(!is_dir($upload_dir)){

    mkdir($upload_dir,0777,true);

}




/*
|--------------------------------------------------------------------------
| CREATE FILE NAME
|--------------------------------------------------------------------------
*/


$file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);


$new_filename = "receipt_" . time() . "_" . $user_id . "." . $file_extension;



$destination = $upload_dir . $new_filename;



move_uploaded_file(

    $file["tmp_name"],

    $destination

);



/*
|--------------------------------------------------------------------------
| UPDATE BOOKING
|--------------------------------------------------------------------------
*/


$sql = "

UPDATE bookings_table

SET 

payment_receipt = ?,

payment_status = 'Awaiting Confirmation'

WHERE id = ?

AND user_id = ?

";



$stmt = mysqli_prepare($conn,$sql);



mysqli_stmt_bind_param(

    $stmt,

    "sii",

    $new_filename,

    $booking_id,

    $user_id

);



mysqli_stmt_execute($stmt);



mysqli_stmt_close($stmt);

mysqli_close($conn);



header("Location: user-dashboard.php");

exit();


?>