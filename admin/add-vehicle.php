<?php

$currentPage = "manage-vehicles";

$pageTitle = "Add Vehicle";

$pageDescription = "Add a new vehicle to your fleet";

$searchPlaceholder = "Search vehicles...";

require "../config.php";

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Vehicle</title>

<link rel="stylesheet" href="admin.css">

<link rel="stylesheet" href="add-vehicle.css">

<link rel="stylesheet"
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

<i class="fa-solid fa-car-side"></i>

Add New Vehicle

</h2>

<p>

Complete the form below to add a new vehicle to your fleet.

</p>

</div>
<form action="add_vehicle_process.php" method="POST" enctype="multipart/form-data" class="vehicle-form">

    <div class="form-group">

        <label>Vehicle Name</label>

        <input
            type="text"
            name="vehicle_name"
            placeholder="Enter vehicle name"
            required>

    </div>

    <div class="form-group">

        <label>Category</label>

        <input
            type="text"
            name="category"
            placeholder="e.g Luxury Sedan"
            required>

    </div>

    <div class="form-group">

        <label>Price Per Hour (₦)</label>

        <input
            type="number"
            name="price_per_hour"
            placeholder="Enter hourly price"
            min="0"
            required>

    </div>

    <div class="form-group">

        <label>Seats</label>

        <input
            type="number"
            name="seats"
            placeholder="Number of seats"
            min="1"
            required>

    </div>

    <div class="form-group">

        <label>Fuel Type</label>

        <select name="fuel_type" required>

            <option value="">Select Fuel Type</option>

            <option>Petrol</option>

            <option>Diesel</option>

            <option>Electric</option>

            <option>Hybrid</option>

        </select>

    </div>

    <div class="form-group">

        <label>Transmission</label>

        <select name="transmission" required>

            <option value="">Select Transmission</option>

            <option>Automatic</option>

            <option>Manual</option>

        </select>

    </div>

    <div class="form-group full-width">

        <label>Description</label>

        <textarea
            name="description"
            rows="5"
            placeholder="Enter vehicle description"
            required></textarea>

    </div>

    <div class="form-group">

        <label>Vehicle Image</label>

        <input
            type="file"
            name="image"
            accept="image/*"
            required>

    </div>

    <div class="form-group">

        <label>Availability</label>

        <select name="availability" required>

            <option value="">Select Status</option>

            <option>Available</option>

            <option>Booked</option>

            <option>Maintenance</option>

        </select>

    </div>

    <div class="form-buttons">

        <button type="submit" class="submit-btn">

            <i class="fa-solid fa-plus"></i>

            Add Vehicle

        </button>

        <a href="manage-vehicles.php" class="cancel-btn">

            Cancel

        </a>

    </div>

</form>

</section>

<?php include "includes/footer.php"; ?>