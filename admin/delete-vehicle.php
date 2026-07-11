<?php

require "../config.php";

/*
|--------------------------------------------------------------------------
| CHECK VEHICLE ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET["id"])){

    header("Location: manage-vehicles.php");

    exit();

}

$id = (int)$_GET["id"];

/*
|--------------------------------------------------------------------------
| GET VEHICLE IMAGE
|--------------------------------------------------------------------------
*/

$stmt = mysqli_prepare(

    $conn,

    "SELECT image FROM vehicles_table WHERE id=?"

);

mysqli_stmt_bind_param(

    $stmt,

    "i",

    $id

);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0){

    die("Vehicle not found.");

}

$vehicle = mysqli_fetch_assoc($result);

$image = $vehicle["image"];
/*
|--------------------------------------------------------------------------
| DELETE VEHICLE FROM DATABASE
|--------------------------------------------------------------------------
*/

$stmt = mysqli_prepare(

    $conn,

    "DELETE FROM vehicles_table WHERE id=?"

);

mysqli_stmt_bind_param(

    $stmt,

    "i",

    $id

);

if(mysqli_stmt_execute($stmt)){

    /*
    |--------------------------------------------------------------------------
    | DELETE IMAGE FROM FOLDER
    |--------------------------------------------------------------------------
    */

    $imagePath = "../uploads/vehicles/" . $image;

    if(file_exists($imagePath)){

        unlink($imagePath);

    }

    header("Location: manage-vehicles.php");

    exit();

}else{

    die("Failed to delete vehicle.");

}

mysqli_close($conn);

?>