<?php

session_start();

require "../config.php";


if(!isset($_SESSION["user_id"])){

    header("Location: ../login.php");
    exit();

}


if(!isset($_GET["id"])){

    header("Location: user-dashboard.php");
    exit();

}


$user_id = $_SESSION["user_id"];

$booking_id = intval($_GET["id"]);



$sql = "

SELECT 

bookings_table.*,

vehicles_table.vehicle_name

FROM bookings_table


INNER JOIN vehicles_table

ON bookings_table.vehicle_id = vehicles_table.id


WHERE bookings_table.id = ?

AND bookings_table.user_id = ?

AND bookings_table.booking_status = 'Approved'


LIMIT 1

";



$stmt = mysqli_prepare($conn,$sql);


mysqli_stmt_bind_param(

    $stmt,

    "ii",

    $booking_id,

    $user_id

);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$booking = mysqli_fetch_assoc($result);



if(!$booking){

    header("Location: user-dashboard.php");

    exit();

}


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Make Payment</title>

<link rel="stylesheet" href="dashboard.css">

</head>


<body>


<div class="payment-container">





<div class="payment-card">

<h1>Make Payment</h1>


<h2>

<?php echo htmlspecialchars($booking["vehicle_name"]); ?>

</h2>


<p>

<strong>Amount Due:</strong>

₦<?php echo number_format($booking["quoted_amount"],2); ?>

</p>



<div class="payment-info">


<h3>Payment Instructions</h3>


<p>

Bank Name: Your Bank Name

</p>


<p>

Account Name: Raymond Kadri VIP Rentals

</p>


<p>

Account Number: 0000000000

</p>


</div>



<form action="upload-payment.php" method="POST" enctype="multipart/form-data">


<input 
type="hidden"
name="booking_id"
value="<?php echo $booking["id"]; ?>">



<label>

Upload Payment Receipt

</label>


<input 
type="file"
name="receipt"
accept=".jpg,.jpeg,.png,.pdf"
required>



<button type="submit">

Submit Payment

</button>


</form>


</div>


</div>


</body>

</html>