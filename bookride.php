<?php

session_start();

require "config.php";

$editing_booking = null;
if (isset($_SESSION["editing_booking_data"]) && is_array($_SESSION["editing_booking_data"])) {
    $editing_booking = $_SESSION["editing_booking_data"];
}

if(!isset($_GET["vehicle_id"])){

    header("Location: fleet.php");

    exit();

}

$vehicle_id = intval($_GET["vehicle_id"]);

$sql = "SELECT * FROM vehicles_table WHERE id=? LIMIT 1";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$vehicle_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$vehicle = mysqli_fetch_assoc($result);

if(!$vehicle){

    die("Vehicle not found.");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book a Ride | VIP Rental</title>

    <link rel="stylesheet" href="bookride.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

    <header class="booking-header">

        <a class="logo" href="index.html">RK</a>

        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span>
        </button>

    </header>
    <!-- HERO SECTION -->

    <section class="hero">

        <div class="overlay"></div>

        <div class="hero-content">

            <h1>Book Your Luxury Ride</h1>

            <p>
                Experience comfort, elegance and premium chauffeur services.
            </p>

        </div>

    </section>


    <!-- BOOKING FORM -->

    <section class="booking-section">

        <div class="booking-container">

            <div class="title">

                <h2>Reserve Your Vehicle</h2>

                <p>
                    Complete the form below and we'll confirm your booking shortly. 

                </p>

            </div>
            <!-- SELECTED VEHICLE -->

<div class="selected-vehicle">

<h3>Selected Vehicle</h3>

<div class="selected-vehicle-card">

<div class="vehicle-image">

<img
src="uploads/vehicles/<?php echo htmlspecialchars($vehicle["image"]); ?>"
alt="<?php echo htmlspecialchars($vehicle["vehicle_name"]); ?>">

</div>

<div class="vehicle-details">

<h2>

<?php echo htmlspecialchars($vehicle["vehicle_name"]); ?>

</h2>

<p>

<strong>Category:</strong>

<?php echo htmlspecialchars($vehicle["category"]); ?>

</p>

<p>

<strong>Seats:</strong>

<?php echo htmlspecialchars($vehicle["seats"]); ?>

</p>

<p>

<strong>Fuel:</strong>

<?php echo htmlspecialchars($vehicle["fuel_type"]); ?>

</p>

<p>

<strong>Transmission:</strong>

<?php echo htmlspecialchars($vehicle["transmission"]); ?>

</p>

<h4>

₦<?php echo number_format($vehicle["price_per_hour"]); ?>/Hour

</h4>

<a href="fleet.php" class="change-vehicle">

Change Vehicle

</a>

</div>

</div>

</div>


            <!-- <form id="bookingForm"> -->
                <form id="bookingForm" method="POST" action="booking_process.php">

<input
type="hidden"
name="vehicle_id"
value="<?php echo $vehicle["id"]; ?>">

<?php if($editing_booking){ ?>
<input type="hidden" name="editing_booking_id" value="<?php echo htmlspecialchars($editing_booking["id"]); ?>">
<?php } ?>

                <!-- PERSONAL DETAILS -->

                <div class="row">
                    

                    <!-- <div class="input-box">

                        <i class="fa-solid fa-user"></i>

                        <input
                        type="text"
                        name="fullname"
                        placeholder="Full Name"
                        required>

                    </div> -->

                    <!-- <div class="input-box">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required>

                    </div> -->

                </div>


                <div class="row">

                    <!-- <div class="input-box">

                        <i class="fa-solid fa-phone"></i>

                        <input
                        type="tel"
                        name="phone"
                        placeholder="Phone Number"
                        required>

                    </div> -->

                    <div class="input-box">

                        <!-- <i class="fa-solid fa-car"></i> -->

                        <!-- <select name="vehicle" required> -->

                            <!-- <option value="">
                                Select Vehicle
                            </option> -->

                            <!-- <option>Toyota Camry</option>

                            <option>Lexus ES350</option>

                            <option>Mercedes C300</option>

                            <option>BMW X5</option>

                            <option>Range Rover Velar</option>

                            <option>Toyota Prado</option> -->

                        <!-- </select> -->

                    </div>

                </div>


                <!-- LOCATION -->

                <div class="row">

                    <div class="input-box">

                        <i class="fa-solid fa-location-dot"></i>

                        <input
                        type="text"
                        name="pickup_location"
                        placeholder="Pickup Location"
                        value="<?php echo htmlspecialchars($editing_booking["pickup_location"] ?? ""); ?>"
                        required>

                    </div>

                    <div class="input-box">

                        <i class="fa-solid fa-map-location-dot"></i>

                        <input
                        type="text"
                        name="destination"
                        placeholder="Destination"
                        value="<?php echo htmlspecialchars($editing_booking["destination"] ?? ""); ?>"
                        required>

                    </div>

                </div>


                <!-- DATE -->

                <div class="row">

                    <div class="input-box">

                        <i class="fa-solid fa-calendar-days"></i>

                        <input
                        type="date"
                        name="pickup_date"
                        placeholder="Pickup Date (YYYY-MM-DD)"
                        value="<?php echo htmlspecialchars($editing_booking["pickup_date"] ?? ""); ?>"
                        required>

                    </div>

                    <div class="input-box">

                        <i class="fa-solid fa-clock"></i>

                        <input
                        type="time"
                        name="pickup_time"
                        placeholder="Pickup Time (HH:MM)"
                        value="<?php echo htmlspecialchars($editing_booking["pickup_time"] ?? ""); ?>"
                        required>

                    </div>

                </div>

<h1>Return Date & Time</h1>
                <!-- RETURN DATE -->

                <!-- RETURN DATE & TIME -->

<div class="row">

    <div class="input-box">

        <i class="fa-solid fa-calendar-check"></i>

        <input
        type="date"
        name="return_date"
        value="<?php echo htmlspecialchars($editing_booking["return_date"] ?? ""); ?>"
        required>

    </div>

    <div class="input-box">

        <i class="fa-solid fa-clock"></i>

        <input
        type="time"
        name="return_time"
        value="<?php echo htmlspecialchars($editing_booking["return_time"] ?? ""); ?>"
        required>

    </div>

</div>

                <!-- <div class="row"> -->

                    <!-- <div class="input-box full">

                        <i class="fa-solid fa-calendar-check"></i>

                        <input
                        type="date"
                        name="returndate">

                    </div> -->

                <!-- </div> -->


                <!-- SPECIAL REQUEST -->

                <div class="row">

                    <div class="textarea-box">

                        <textarea

                        name="special_request"

                        placeholder="Special Requests (Optional) Special requests can include child seats, additional luggage space, or any other specific requirements you may have. Please provide as much detail as possible to ensure we can accommodate your needs."

                        rows="6"><?php echo htmlspecialchars($editing_booking["special_request"] ?? ""); ?></textarea>

                    </div>

                </div>


                <button
                type="submit"
                class="book-btn">

                <?php echo $editing_booking ? 'Update Booking' : 'Book Ride'; ?>

                <i class="fa-solid fa-arrow-right"></i>

                </button>


            </form>

        </div>

    </section>


<script src="bookride.js"></script>

</body>
</html>