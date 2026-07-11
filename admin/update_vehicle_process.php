<?php

require "../config.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: manage-vehicles.php");

    exit();

}

/*
|--------------------------------------------------------------------------
| GET FORM DATA
|--------------------------------------------------------------------------
*/

$id = (int)$_POST["id"];

$vehicle_name = trim($_POST["vehicle_name"]);

$category = trim($_POST["category"]);

$price_per_hour = trim($_POST["price_per_hour"]);

$seats = trim($_POST["seats"]);

$fuel_type = trim($_POST["fuel_type"]);

$transmission = trim($_POST["transmission"]);

$description = trim($_POST["description"]);

$availability = trim($_POST["availability"]);

$oldImage = $_POST["old_image"];

/*
|--------------------------------------------------------------------------
| DEFAULT IMAGE
|--------------------------------------------------------------------------
*/

$newImageName = $oldImage;
/*
|--------------------------------------------------------------------------
| CHECK IF A NEW IMAGE WAS UPLOADED
|--------------------------------------------------------------------------
*/

if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){

    $imageName = $_FILES["image"]["name"];

    $imageTmp = $_FILES["image"]["tmp_name"];

    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    $newImageName = uniqid("vehicle_", true) . "." . $imageExtension;

    $uploadDirectory = "../uploads/vehicles/";

    $destination = $uploadDirectory . $newImageName;

    if(move_uploaded_file($imageTmp, $destination)){

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */

        $oldImagePath = $uploadDirectory . $oldImage;

        if(file_exists($oldImagePath)){

            unlink($oldImagePath);

        }

    }else{

        die("Failed to upload new image.");

    }

}
/*
|--------------------------------------------------------------------------
| UPDATE VEHICLE
|--------------------------------------------------------------------------
*/

$sql = "UPDATE vehicles_table SET

vehicle_name=?,
category=?,
price_per_hour=?,
seats=?,
fuel_type=?,
transmission=?,
description=?,
image=?,
availability=?

WHERE id=?";

$stmt = mysqli_prepare($conn,$sql);

if(!$stmt){

    die("Database Error: " . mysqli_error($conn));

}

mysqli_stmt_bind_param(

    $stmt,

    "ssdisssssi",

    $vehicle_name,
    $category,
    $price_per_hour,
    $seats,
    $fuel_type,
    $transmission,
    $description,
    $newImageName,
    $availability,
    $id

);

if(mysqli_stmt_execute($stmt)){

    header("Location: manage-vehicles.php");

    exit();

}else{

    die("Failed to update vehicle.");

}

mysqli_stmt_close($stmt);

mysqli_close($conn);

?>