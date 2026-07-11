<?php

$currentPage = "manage-vehicles";

$pageTitle = "Manage Vehicles";

$pageDescription = "View and manage all vehicles";

$searchPlaceholder = "Search vehicles...";

require "../config.php";

/*
|--------------------------------------------------------------------------
| TOTAL VEHICLES
|--------------------------------------------------------------------------
*/

$totalVehicles = 0;

$query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicles_table");

if($query){

    $row = mysqli_fetch_assoc($query);

    $totalVehicles = $row['total'];

}

/*
|--------------------------------------------------------------------------
| FETCH VEHICLES
|--------------------------------------------------------------------------
*/

$sql = "SELECT * FROM vehicles_table ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage Vehicles</title>

<link
rel="stylesheet"
href="admin.css">

<link
rel="stylesheet"
href="manage-vehicles.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="overlay"></div>

<?php include "includes/sidebar.php"; ?>

<main class="main-content">

<?php include "includes/topbar.php"; ?>

<section class="vehicles-container">
    <div class="vehicles-header">

    <div class="vehicle-card">

        <div class="vehicle-icon">

            <i class="fa-solid fa-car-side"></i>

        </div>

        <div class="vehicle-info">

            <h2><?php echo $totalVehicles; ?></h2>

            <p>Total Vehicles</p>

        </div>

    </div>

    <a href="add-vehicle.php" class="add-vehicle-btn">

        <i class="fa-solid fa-plus"></i>

        Add Vehicle

    </a>

</div>
<?php

if ($result) {

    if (mysqli_num_rows($result) > 0) {

?>

<div class="table-container">

    <table class="vehicles-table">

        <thead>

            <tr>

                <th>Image</th>

                <th>Vehicle Name</th>

                <th>Category</th>

                <th>Price / Hour</th>

                <th>Seats</th>

                <th>Availability</th>

                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <tr>

                <td>

                    <img
                    src="../uploads/vehicles/<?php echo htmlspecialchars($row['image']); ?>"
                    class="vehicle-image"
                    alt="Vehicle">

                </td>

                <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>

                <td><?php echo htmlspecialchars($row['category']); ?></td>

                <td>₦<?php echo number_format($row['price_per_hour']); ?>/hr</td>

                <td><?php echo htmlspecialchars($row['seats']); ?></td>

                <td>

                    <?php if($row['availability'] == "Available"){ ?>

                        <span class="status available">

                            Available

                        </span>

                    <?php }else{ ?>

                        <span class="status unavailable">

                            <?php echo htmlspecialchars($row['availability']); ?>

                        </span>

                    <?php } ?>

                </td>

                <td>

                    <a href="edit-vehicle.php?id=<?php echo $row['id']; ?>" class="edit-btn">

                        <i class="fa-solid fa-pen"></i>

                    </a>

                    <!-- <a href="delete-vehicle.php?id=<?php echo $row['id']; ?>" class="delete-btn">

                        <i class="fa-solid fa-trash"></i>

                    </a> -->
                    <a
                href="delete-vehicle.php?id=<?php echo $row['id']; ?>"
                class="delete-btn"
                 onclick="return confirm('Are you sure you want to delete this vehicle?');">

                 <i class="fa-solid fa-trash"></i>

</a>

                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

<?php

    } else {

?>

<div class="message-box warning">

    <i class="fa-solid fa-circle-info"></i>

    <h3>No Vehicles Found</h3>

    <p>No vehicles have been added yet.</p>

</div>

<?php

    }

} else {

?>

<div class="message-box error">

    <i class="fa-solid fa-triangle-exclamation"></i>

    <h3>Database Error</h3>

    <p><?php echo htmlspecialchars(mysqli_error($conn)); ?></p>

</div>

<?php

}

?>

</section>

<?php include "includes/footer.php"; ?>