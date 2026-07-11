<?php

session_start();

require "../config.php";

/*
|--------------------------------------------------------------------------
| CHECK LOGIN
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION["user_id"])) {

    // header("Location: ../login.php");
    header("Location: ../login.php?redirect=dashboard");
    exit();

}

$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

/*
|--------------------------------------------------------------------------
| GET USER BOOKINGS
|--------------------------------------------------------------------------
*/

// $sql = "SELECT
//             bookings.*,
//             vehicles_table.vehicle_name,
//             vehicles_table.category,
//             vehicles_table.image,
//             vehicles_table.price_per_hour
//         FROM bookings
//         INNER JOIN vehicles_table
//         ON bookings.vehicle_id = vehicles_table.id
//         WHERE bookings.user_id = ?
//         ORDER BY bookings.created_at DESC";
$sql = "SELECT
            bookings_table.*,
            vehicles_table.vehicle_name,
            vehicles_table.category,
            vehicles_table.image,
            vehicles_table.price_per_hour
        FROM bookings_table
        INNER JOIN vehicles_table
        ON bookings_table.vehicle_id = vehicles_table.id
        WHERE bookings_table.user_id = ?
        ORDER BY bookings_table.created_at DESC";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Dashboard</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="dashboard-container">

    <?php include "includes/sidebar.php"; ?>

    <div class="main-content">

        <?php include "includes/topbar.php"; ?>

        <section class="dashboard-content">

            <div class="welcome-box">

                <h1>User Dashboard</h1>

                <p>

                    Here is a recorded history of all your bookings,

                    <strong>

                        <?php echo htmlspecialchars(explode(" ", $user_name)[0]); ?>

                    </strong>.

                </p>

            </div>
            <?php

if(mysqli_num_rows($result) > 0){

while($booking = mysqli_fetch_assoc($result)){

?>

<div class="booking-card">

    <div class="vehicle-image">

        <img
        src="../uploads/vehicles/<?php echo htmlspecialchars($booking["image"]); ?>"
        alt="<?php echo htmlspecialchars($booking["vehicle_name"]); ?>">

    </div>

    <div class="booking-details">

        <h2>

            <?php echo htmlspecialchars($booking["vehicle_name"]); ?>

        </h2>

        <span class="vehicle-category">

            <?php echo htmlspecialchars($booking["category"]); ?>

        </span>

        <div class="booking-grid">

            <div>

                <strong>Pickup Location</strong>

                <p><?php echo htmlspecialchars($booking["pickup_location"]); ?></p>

            </div>

            <div>

                <strong>Destination</strong>

                <p><?php echo htmlspecialchars($booking["destination"]); ?></p>

            </div>

            <div>

                <strong>Pickup Date</strong>

                <p><?php echo htmlspecialchars($booking["pickup_date"]); ?></p>

            </div>

            <div>

                <strong>Pickup Time</strong>

                <p><?php echo htmlspecialchars($booking["pickup_time"]); ?></p>

            </div>

            <div>

                <strong>Return Date</strong>

                <p><?php echo htmlspecialchars($booking["return_date"]); ?></p>

            </div>

            <div>

                <strong>Return Time</strong>

                <p><?php echo htmlspecialchars($booking["return_time"]); ?></p>

            </div>

            <div>

                <strong>Quoted Amount</strong>

                <p>₦<?php echo number_format($booking["quoted_amount"],2); ?></p>

            </div>

            <div>

                <strong>Price Per Hour</strong>

                <p>₦<?php echo number_format($booking["price_per_hour"],2); ?>/hr</p>

            </div>

            <div>

                <strong>Booking Status</strong>

                <p class="booking-status">

                    <?php echo htmlspecialchars($booking["booking_status"]); ?>

                </p>

            </div>

            <div>

    <strong>Payment Status</strong>

    <p class="payment-status">

        <?php echo htmlspecialchars($booking["payment_status"]); ?>

    </p>


    <?php if($booking["payment_status"] == "Paid"){ ?>

        <p class="payment-message">

            You will be messaged shortly.

        </p>

    <?php } ?>

</div>

        </div>

        <?php if(!empty($booking["special_request"])){ ?>

        <div class="special-request">

            <strong>Special Request</strong>

            <p>

                <?php echo nl2br(htmlspecialchars($booking["special_request"])); ?>

            </p>

        </div>

        <?php } ?>

        <div class="booking-footer">

            <span>

                Booked on

                <?php echo date("d M Y",strtotime($booking["created_at"])); ?>

            </span>

            <?php
            $booking_status_value = strtolower(trim($booking["booking_status"]));
            $payment_status_value = strtolower(trim($booking["payment_status"]));
            ?>

            <?php if(in_array($booking_status_value, ["pending", "pending review"], true)){ ?>

            <div class="booking-actions">

                <a
                href="modify-booking.php?id=<?php echo $booking["id"]; ?>"
                class="modify-btn">

                Modify Booking

                </a>

                <button
                type="button"
                class="cancel-btn"
                onclick="openCancelModal(<?php echo $booking["id"]; ?>)">

                Cancel Booking

                </button>

            </div>

            <?php } ?>
            <?php if(
$booking_status_value === "approved" &&
in_array($payment_status_value, ["pending", "pending payment"], true)
){ ?>

<div class="booking-actions">

    <button
type="button"
class="modify-btn"
onclick="openPaymentModal(<?php echo $booking["id"]; ?>)">

Make Payment

</button>
</div>

<?php } ?>

        </div>

    </div>

</div>

<?php

}

}else{

?>

<div class="empty-bookings">

    <i class="fa-solid fa-car-side"></i>

    <h2>No Bookings Yet</h2>

    <p>

        You haven't made any bookings yet.

    </p>

    <a href="../fleet.php" class="browse-btn">

        Browse Fleet

    </a>

</div>

<?php

}

?>
        </section>

        <?php include "includes/footer.php"; ?>

    </div>
    

</div>

</div>

<div class="cancel-modal" id="paymentModal">

    <div class="cancel-modal-box">

        <h3>Proceed to Payment?</h3>

        <p>
            Are you ready to upload your payment receipt for this booking?
        </p>


        <div class="modal-actions">

            <button 
            type="button" 
            onclick="closePaymentModal()" 
            class="keep-btn">

                No, Go Back

            </button>


            <button
            type="button"
            id="confirmPaymentBtn"
            class="confirm-cancel-btn">

                Continue

            </button>

        </div>

    </div>

</div>


<div class="cancel-modal" id="cancelModal">

    <div class="cancel-modal-box">

        <h3>Cancel Booking?</h3>

        <p>
            Are you sure you want to cancel this booking?
        </p>


        <div class="modal-actions">

            <button type="button" onclick="closeCancelModal()" class="keep-btn">
                No, Keep Booking
            </button>

            <input type="hidden" id="cancelBookingId" value="">


            <button type="button" id="confirmCancelBtn" class="confirm-cancel-btn" onclick="confirmCancelBooking()">
                Yes, Cancel
            </button>

        </div>

    </div>

</div>


<script src="dashboard.js"></script>


<!-- <div class="cancel-modal" id="cancelModal">

    <div class="cancel-modal-box">

        <h3>Cancel Booking?</h3>

        <p>
            Are you sure you want to cancel this booking?
        </p>


        <div class="modal-actions">

            <button type="button" onclick="closeCancelModal()" class="keep-btn">
                No, Keep Booking
            </button>

            <input type="hidden" id="cancelBookingId" value="">

            <button type="button" id="confirmCancelBtn" class="confirm-cancel-btn" onclick="confirmCancelBooking()">
                Yes, Cancel
            </button>

        </div>
        

    </div> -->
</body>

</html>

<?php

mysqli_stmt_close($stmt);

mysqli_close($conn);

?>