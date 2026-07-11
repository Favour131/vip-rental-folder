<?php

$currentPage = "manage-vehicles";

$pageTitle = "Edit Vehicle";

$pageDescription = "Update vehicle information";

$searchPlaceholder = "Search vehicles...";

require "../config.php";

/*
|--------------------------------------------------------------------------
| GET VEHICLE ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET["id"])){

    header("Location: manage-vehicles.php");

    exit();

}

$id = (int)$_GET["id"];

/*
|--------------------------------------------------------------------------
| FETCH VEHICLE
|--------------------------------------------------------------------------
*/

$stmt = mysqli_prepare($conn,"SELECT * FROM vehicles_table WHERE id=?");

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0){

    die("Vehicle not found.");

}

$vehicle = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Vehicle</title>

<link rel="stylesheet" href="admin.css">

<link rel="stylesheet" href="add-vehicle.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="overlay"></div>

<?php include "includes/sidebar.php"; ?>

<main class="main-content">

<?php include "includes/topbar.php"; ?>

<section class="add-vehicle-container">

<div class="section-title">

<h2>

<i class="fa-solid fa-pen"></i>

Edit Vehicle

</h2>

<p>

Update the selected vehicle.

</p>

</div>
<form action="update_vehicle_process.php" method="POST" enctype="multipart/form-data" class="vehicle-form">

    <input type="hidden" name="id" value="<?php echo $vehicle['id']; ?>">

    <input type="hidden" name="old_image" value="<?php echo $vehicle['image']; ?>">

    <div class="form-group">

        <label>Vehicle Name</label>

        <input
        type="text"
        name="vehicle_name"
        value="<?php echo htmlspecialchars($vehicle['vehicle_name']); ?>"
        required>

    </div>

    <div class="form-group">

        <label>Category</label>

        <input
        type="text"
        name="category"
        value="<?php echo htmlspecialchars($vehicle['category']); ?>"
        required>

    </div>

    <div class="form-group">

        <label>Price Per Hour (₦)</label>

        <input
        type="number"
        name="price_per_hour"
        value="<?php echo $vehicle['price_per_hour']; ?>"
        required>

    </div>

    <div class="form-group">

        <label>Seats</label>

        <input
        type="number"
        name="seats"
        value="<?php echo $vehicle['seats']; ?>"
        required>

    </div>

    <div class="form-group">

        <label>Fuel Type</label>

        <select name="fuel_type" required>

            <option value="Petrol" <?php if($vehicle['fuel_type']=="Petrol") echo "selected"; ?>>Petrol</option>

            <option value="Diesel" <?php if($vehicle['fuel_type']=="Diesel") echo "selected"; ?>>Diesel</option>

            <option value="Electric" <?php if($vehicle['fuel_type']=="Electric") echo "selected"; ?>>Electric</option>

            <option value="Hybrid" <?php if($vehicle['fuel_type']=="Hybrid") echo "selected"; ?>>Hybrid</option>

        </select>

    </div>

    <div class="form-group">

        <label>Transmission</label>

        <select name="transmission" required>

            <option value="Automatic" <?php if($vehicle['transmission']=="Automatic") echo "selected"; ?>>Automatic</option>

            <option value="Manual" <?php if($vehicle['transmission']=="Manual") echo "selected"; ?>>Manual</option>

        </select>

    </div>

    <div class="form-group full-width">

        <label>Description</label>

        <textarea
        name="description"
        rows="5"
        required><?php echo htmlspecialchars($vehicle['description']); ?></textarea>

    </div>
        <div class="form-group">

        <label>Current Vehicle Image</label>

        <img
            src="../uploads/vehicles/<?php echo htmlspecialchars($vehicle['image']); ?>"
            alt="Vehicle Image"
            class="vehicle-image-preview">

    </div>

    <div class="form-group">

        <label>Replace Image (Optional)</label>

        <input
            type="file"
            name="image"
            accept="image/*">

        <small class="form-note">
            Leave this empty if you don't want to change the current image.
        </small>

    </div>

    <div class="form-group">

        <label>Availability</label>

        <select name="availability" required>

            <option value="Available" <?php if($vehicle['availability']=="Available") echo "selected"; ?>>
                Available
            </option>

            <option value="Booked" <?php if($vehicle['availability']=="Booked") echo "selected"; ?>>
                Booked
            </option>

            <option value="Maintenance" <?php if($vehicle['availability']=="Maintenance") echo "selected"; ?>>
                Maintenance
            </option>

        </select>

    </div>

    <div class="form-buttons">

        <button type="submit" class="submit-btn">

            <i class="fa-solid fa-floppy-disk"></i>

            Update Vehicle

        </button>

        <a href="manage-vehicles.php" class="cancel-btn">

            Cancel

        </a>

    </div>

</form>

</section>

<?php include "includes/footer.php"; ?>