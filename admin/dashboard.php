

<?php
session_start();




if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();
}
$currentPage = "dashboard";

$pageTitle = "Dashboard";

$pageDescription = "Transport Booking Administration";

$searchPlaceholder = "Search dashboard...";

require "../config.php";

/*
|--------------------------------------------------------------------------
| USERS COUNT
|--------------------------------------------------------------------------
*/

$totalUsers = 0;

$userStatus = "Connected";

$userQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");

if($userQuery){

    $userData = mysqli_fetch_assoc($userQuery);

    $totalUsers = $userData['total'];

}else{

    $userStatus = "Database Error";

}

/*
|--------------------------------------------------------------------------
| TOTAL VEHICLES
|--------------------------------------------------------------------------
*/

$vehicleQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM vehicles_table");

$vehicleData = mysqli_fetch_assoc($vehicleQuery);

$totalVehicles = $vehicleData["total"];

/*
|--------------------------------------------------------------------------
| TOTAL BOOKINGS
|--------------------------------------------------------------------------
*/

$bookingQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings_table");


$bookingData = mysqli_fetch_assoc($bookingQuery);


$totalBookings = $bookingData["total"];

/*
|--------------------------------------------------------------------------
| RECENT BOOKINGS
|--------------------------------------------------------------------------
*/

$recentBookingsQuery = mysqli_query($conn, "

SELECT

bookings_table.*,

users.name AS customer_name,

vehicles_table.vehicle_name


FROM bookings_table


INNER JOIN users

ON bookings_table.user_id = users.id


INNER JOIN vehicles_table

ON bookings_table.vehicle_id = vehicles_table.id


ORDER BY bookings_table.created_at DESC

LIMIT 5

");

/*
|--------------------------------------------------------------------------
| FLEET OVERVIEW
|--------------------------------------------------------------------------
*/

$fleetQuery = mysqli_query($conn, "

SELECT *

FROM vehicles_table

ORDER BY id DESC

LIMIT 5

");


?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard | VIP Rental</title>

<link
rel="stylesheet"
href="admin.css">

<link
rel="stylesheet"
href="admin2.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>
    <?php include "includes/sidebar.php"; ?>

<div class="overlay"></div>



<main class="main-content">

<?php include "includes/topbar.php"; ?>

<section class="welcome">

<h1>

Welcome Back 👋

</h1>

<p>

Manage every aspect of your VIP Rental transport system from one dashboard.

</p>

</section>
<section class="dashboard-cards">

    <div class="card connected">

        <div class="card-icon">

            <i class="fa-solid fa-users"></i>

        </div>

        <div class="card-content">

            <h3>Total Users</h3>

            <h1><?php echo $totalUsers; ?></h1>

            <span class="badge success">

                <i class="fa-solid fa-circle-check"></i>

                <?php echo $userStatus; ?>

            </span>

        </div>

    </div>

    <div class="card pending">

        <div class="card-icon">

            <i class="fa-solid fa-calendar-check"></i>

        </div>

        <div class="card-content">

            <h3>Total Bookings</h3>

            <h1><?php echo $totalBookings; ?></h1>

                <span class="badge success">

                    <i class="fa-solid fa-circle-check"></i>

                    Live Database

                </span>

        </div>

    </div>

    <div class="card pending">

        <div class="card-icon">

            <i class="fa-solid fa-car"></i>

        </div>

        <div class="card-content">

    <h3>Total Vehicles</h3>

    <h1><?php echo $totalVehicles; ?></h1>

    <span class="badge success">

        <i class="fa-solid fa-car-side"></i>

        Live Database

    </span>

</div>

    </div>

    

        

    </div>

</section>
<section class="system-status">

    <div class="status-card">

        <h2>

            <i class="fa-solid fa-server"></i>

            System Status

        </h2>

        <table>

            <tr>

                <td>Users Module</td>

                <td>

                    <span class="badge success">

                        Connected

                    </span>

                </td>

            </tr>

            <tr>

    <td>Bookings Module</td>

    <td>

        <span class="badge success">

            <i class="fa-solid fa-circle-check"></i>

            Connected

        </span>

    </td>

</tr>

            <tr>

                <td>Vehicles Module</td>

                <td>

                    <!-- <span class="badge warning">

                        Database Pending

                    </span> -->
                    <div class="system-item">

    <div>

        <!-- <h4>Vehicle Module</h4> -->

        <!-- <small>Add • Edit • Delete • Fleet Display</small> -->

    </div>

    <span class="badge success">

        <i class="fa-solid fa-circle-check"></i>

        Connected

    </span>

</div>

                </td>

            </tr>

            

            <tr>

    <td>Payments Module</td>

    <td>

        <span class="badge success">

            <i class="fa-solid fa-circle-check"></i>

            Connected

        </span>

    </td>

</tr>

        </table>

    </div>

</section>
<section class="quick-actions">

    <div class="section-title">

        <h2>Quick Actions</h2>

    </div>

    <div class="action-grid">

        <a href="manage-users.php" class="action-card">

            <i class="fa-solid fa-users"></i>

            <h3>Manage Users</h3>

            <p>View, edit and manage all registered users.</p>

        </a>

        <a href="manage-reviews.php" class="action-card">

            <i class="fa-solid fa-star"></i>

            <h3>Reviews</h3>

            <p>View,cancel and reply users review</p>

        </a>
         <a href="profile.php" class="action-card">

            <i class="fa-solid fa-user"></i>

            <h3>Profile</h3>

            <p>View,and edit your Profile</p>

        </a>
         

        <a href="manage-bookings.php" class="action-card">

            <i class="fa-solid fa-calendar-check"></i>

            <h3>Bookings</h3>

            <p>Manage transport bookings.</p>

        </a>

        <a href="manage-vehicles.php" class="action-card">

            <i class="fa-solid fa-car"></i>

            <h3>Vehicles</h3>

            <p>Add, edit and manage vehicles.</p>

        </a>

        <a href="logout.php" class="action-card">

            <i class="fa-solid fa-completed"></i>

            <h3>Logout</h3>

            <p>Admin logout</p>

        </a>

        

    </div>

</section>
<!-- ========================================
RECENT BOOKINGS
======================================== -->

<section class="dashboard-table">

<div class="section-title">

<h2>

<i class="fa-solid fa-calendar-check"></i>

Recent Bookings

</h2>

</div>


<div class="booking-table-container">


<table class="booking-table">


<thead>

<tr>

<th>Customer</th>

<th>Vehicle</th>

<th>Date</th>

<th>Booking Status</th>

<th>Payment Status</th>

</tr>

</thead>



<tbody>


<?php

if(mysqli_num_rows($recentBookingsQuery) > 0){


while($booking = mysqli_fetch_assoc($recentBookingsQuery)){


?>


<tr>


<td>

<?php echo htmlspecialchars($booking["customer_name"]); ?>

</td>


<td>

<?php echo htmlspecialchars($booking["vehicle_name"]); ?>

</td>


<td>

<?php echo date("d M Y", strtotime($booking["created_at"])); ?>

</td>



<td>

<span class="badge <?php echo strtolower(str_replace(' ','-',$booking['booking_status'])); ?>">

<?php echo htmlspecialchars($booking["booking_status"]); ?>

</span>


</td>



<td>


<span class="badge <?php echo strtolower(str_replace(' ','-',$booking['payment_status'])); ?>">

<?php echo htmlspecialchars($booking["payment_status"]); ?>

</span>


</td>



</tr>


<?php

}

}else{

?>


<tr>

<td colspan="5" style="text-align:center;">

No bookings found.

</td>

</tr>


<?php

}

?>


</tbody>


</table>


</div>


</section>

<!-- ========================================
FLEET OVERVIEW
======================================== -->

<section class="dashboard-table">


<div class="section-title">

<h2>

<i class="fa-solid fa-car-side"></i>

Fleet Overview

</h2>

</div>



<div class="fleet-grid">


<?php


if(mysqli_num_rows($fleetQuery) > 0){


while($vehicle = mysqli_fetch_assoc($fleetQuery)){


?>


<div class="fleet-card">


<div class="fleet-image">


<img

src="../uploads/vehicles/<?php echo htmlspecialchars($vehicle["image"]); ?>"

alt="<?php echo htmlspecialchars($vehicle["vehicle_name"]); ?>"

>


</div>



<div class="fleet-details">


<h3>

<?php echo htmlspecialchars($vehicle["vehicle_name"]); ?>

</h3>


<p>

<strong>Category:</strong>

<?php echo htmlspecialchars($vehicle["category"]); ?>

</p>



<p>

<strong>Seats:</strong>

<?php echo htmlspecialchars($vehicle["seats"]); ?>

</p>



<p>

<strong>Price:</strong>

₦<?php echo number_format($vehicle["price_per_hour"]); ?>/hr

</p>



</div>



</div>


<?php

}

}else{


?>


<p class="empty-message">

No vehicles available.

</p>


<?php

}


?>


</div>


</section>

<!-- ========================================
DRIVERS
======================================== -->

<!-- <section class="dashboard-table">

    <div class="section-title">

        <h2>Drivers</h2>

    </div>

    <div class="placeholder-box">

        <i class="fa-solid fa-id-card"></i>

        <h3>Drivers Database Not Connected</h3>

        <p>

            Driver information will appear here once the
            <strong>drivers</strong> table has been created.

        </p>

    </div>

</section> -->

<?php include "includes/footer.php"; ?>