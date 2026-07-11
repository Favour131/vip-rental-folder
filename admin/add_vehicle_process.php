<?php

require "../config.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: add-vehicle.php");

    exit();

}

/*
|--------------------------------------------------------------------------
| GET FORM DATA
|--------------------------------------------------------------------------
*/

$vehicle_name = trim($_POST["vehicle_name"]);

$category = trim($_POST["category"]);

$price_per_hour = trim($_POST["price_per_hour"]);

$seats = trim($_POST["seats"]);

$fuel_type = trim($_POST["fuel_type"]);

$transmission = trim($_POST["transmission"]);

$description = trim($_POST["description"]);

$availability = trim($_POST["availability"]);
/*
|--------------------------------------------------------------------------
| IMAGE UPLOAD
|--------------------------------------------------------------------------
*/

$imageName = $_FILES["image"]["name"];

$imageTmp = $_FILES["image"]["tmp_name"];

$imageError = $_FILES["image"]["error"];

/*
|--------------------------------------------------------------------------
| GENERATE UNIQUE IMAGE NAME
|--------------------------------------------------------------------------
*/

$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

$newImageName = uniqid("vehicle_", true) . "." . $imageExtension;

/*
|--------------------------------------------------------------------------
| UPLOAD LOCATION
|--------------------------------------------------------------------------
*/

$uploadDirectory = "../uploads/vehicles/";
if(!is_dir($uploadDirectory)){

    die("Upload folder not found: " . $uploadDirectory);

}

$destination = $uploadDirectory . $newImageName;

/*
|--------------------------------------------------------------------------
| MOVE IMAGE
|--------------------------------------------------------------------------
*/

if($imageError === 0){

    if(!move_uploaded_file($imageTmp, $destination)){

        die("Failed to upload vehicle image.");

    }

}else{

    die("Please select a vehicle image.");

}
/*
|--------------------------------------------------------------------------
| INSERT VEHICLE INTO DATABASE
|--------------------------------------------------------------------------
*/

$sql = "INSERT INTO vehicles_table
(
    vehicle_name,
    category,
    price_per_hour,
    seats,
    fuel_type,
    transmission,
    description,
    image,
    availability
)
VALUES
(
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?
)";

$stmt = mysqli_prepare($conn, $sql);

if(!$stmt){

    die("Database Error: " . mysqli_error($conn));

}

mysqli_stmt_bind_param(

    $stmt,

    "ssdisssss",

    $vehicle_name,
    $category,
    $price_per_hour,
    $seats,
    $fuel_type,
    $transmission,
    $description,
    $newImageName,
    $availability

);

if(mysqli_stmt_execute($stmt)){

    header("Location: manage-vehicles.php");

    exit();

}else{

    die("Failed to save vehicle.");

}

mysqli_stmt_close($stmt);

mysqli_close($conn);

?>