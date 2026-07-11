<?php

session_start();

require "config.php";

/*
|--------------------------------------------------------------------------
| USER MUST BE LOGGED IN
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION["user_id"])){

    header("Location: login.php");

    exit();

}

/*
|--------------------------------------------------------------------------
| FORM MUST BE SUBMITTED
|--------------------------------------------------------------------------
*/

if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: fleet.php");

    exit();

}

/*
|--------------------------------------------------------------------------
| GET USER ID
|--------------------------------------------------------------------------
*/

$user_id = $_SESSION["user_id"];
$editing_booking_id = isset($_SESSION["editing_booking_id"]) ? intval($_SESSION["editing_booking_id"]) : 0;

/*
|--------------------------------------------------------------------------
| GET FORM DATA
|--------------------------------------------------------------------------
*/

$vehicle_id = intval($_POST["vehicle_id"]);

$pickup_location = trim($_POST["pickup_location"]);

$destination = trim($_POST["destination"]);

$pickup_date = $_POST["pickup_date"];

$pickup_time = $_POST["pickup_time"];

$return_date = $_POST["return_date"];

$return_time = $_POST["return_time"];

$special_request = trim($_POST["special_request"]);

/*
|--------------------------------------------------------------------------
| DEFAULT VALUES
|--------------------------------------------------------------------------
*/

$booking_status = "Pending";

$payment_status = "Pending Payment";

$quoted_amount = 0;

if($editing_booking_id > 0){
    $existing_sql = "SELECT booking_status, payment_status FROM bookings_table WHERE id=? AND user_id=? LIMIT 1";
    $existing_stmt = mysqli_prepare($conn, $existing_sql);
    mysqli_stmt_bind_param($existing_stmt, "ii", $editing_booking_id, $user_id);
    mysqli_stmt_execute($existing_stmt);
    $existing_result = mysqli_stmt_get_result($existing_stmt);
    $existing_booking = mysqli_fetch_assoc($existing_result);

    if($existing_booking){
        $booking_status = $existing_booking["booking_status"];
        $payment_status = $existing_booking["payment_status"];
    }
}

/*
|--------------------------------------------------------------------------
| INSERT BOOKING
|--------------------------------------------------------------------------
*/

if($editing_booking_id > 0){

    $sql = "UPDATE bookings_table
            SET vehicle_id=?, pickup_location=?, destination=?, pickup_date=?, pickup_time=?, return_date=?, return_time=?, special_request=?, quoted_amount=?, booking_status=?, payment_status=?
            WHERE id=? AND user_id=?";

    $stmt = mysqli_prepare($conn, $sql);

    if(!$stmt){
        die("Database Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "iissssssissii",
        $vehicle_id,
        $pickup_location,
        $destination,
        $pickup_date,
        $pickup_time,
        $return_date,
        $return_time,
        $special_request,
        $quoted_amount,
        $booking_status,
        $payment_status,
        $editing_booking_id,
        $user_id
    );

} else {

    $sql = "INSERT INTO bookings_table
    (
        user_id,
        vehicle_id,
        pickup_location,
        destination,
        pickup_date,
        pickup_time,
        return_date,
        return_time,
        special_request,
        quoted_amount,
        booking_status,
        payment_status
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
        "iisssssssiss",
        $user_id,
        $vehicle_id,
        $pickup_location,
        $destination,
        $pickup_date,
        $pickup_time,
        $return_date,
        $return_time,
        $special_request,
        $quoted_amount,
        $booking_status,
        $payment_status
    );
}

if(mysqli_stmt_execute($stmt)){
    unset($_SESSION["editing_booking_id"]);
    unset($_SESSION["editing_booking_data"]);
    $_SESSION["booking_message"] = $editing_booking_id > 0 ? "Booking updated successfully." : "Booking created successfully.";
    header("Location: user/user-dashboard.php");
    exit();
}else{
    die("Booking Failed: " . mysqli_error($conn));
}

mysqli_stmt_close($stmt);

mysqli_close($conn);

?>