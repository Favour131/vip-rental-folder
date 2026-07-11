<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


$currentPage = "manage-bookings";

$pageTitle = "Manage Bookings";

$pageDescription = "View and manage customer bookings";

$searchPlaceholder = "Search bookings...";


require "../config.php";



/*
|--------------------------------------------------------------------------
| GET BOOKINGS
|--------------------------------------------------------------------------
*/


$sql = "

SELECT 

bookings_table.*,

users.name AS customer_name,

users.email,

users.phone_number,

vehicles_table.vehicle_name,

vehicles_table.category


FROM bookings_table


INNER JOIN users

ON bookings_table.user_id = users.id


INNER JOIN vehicles_table

ON bookings_table.vehicle_id = vehicles_table.id


ORDER BY bookings_table.created_at DESC

";



$result = mysqli_query($conn,$sql);



?>


<!DOCTYPE html>

<html lang="en">


<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Manage Bookings | VIP Rental</title>


<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="manage-bookings.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


</head>



<body>



<div class="overlay"></div>



<?php include "includes/sidebar.php"; ?>



<main class="main-content">



<?php include "includes/topbar.php"; ?>





<section class="dashboard-table">



<div class="section-title">

<h2>

<i class="fa-solid fa-calendar-check"></i>

Manage Bookings

</h2>


</div>





<div class="booking-table-container">



<table class="booking-table">



<thead>


<tr>

<th>Customer</th>

<th>Vehicle</th>

<th>Pickup</th>

<th>Destination</th>

<th>Date</th>

<th>Status</th>

<th>Payment Status</th>

<th>Receipt</th>

<th>Booking Cost</th>

<th>Action</th>


</tr>


</thead>




<tbody>



<?php



if(mysqli_num_rows($result)>0){



while($booking=mysqli_fetch_assoc($result)){



?>



<tr>



<td>


<strong>

<?php echo htmlspecialchars($booking["customer_name"]); ?>

</strong>


<br>


<small>

<?php echo htmlspecialchars($booking["phone_number"]); ?>

</small>


</td>




<td>


<?php echo htmlspecialchars($booking["vehicle_name"]); ?>


<br>


<small>

<?php echo htmlspecialchars($booking["category"]); ?>

</small>


</td>




<td>


<?php echo htmlspecialchars($booking["pickup_location"]); ?>


</td>



<td>


<?php echo htmlspecialchars($booking["destination"]); ?>


</td>



<td>


<?php echo date("d M Y",strtotime($booking["pickup_date"])); ?>


<br>


<?php echo $booking["pickup_time"]; ?>


</td>




<td>


<span class="badge <?php echo strtolower(str_replace(' ', '-', $booking['booking_status'])); ?>">


<?php echo htmlspecialchars($booking["booking_status"]); ?>


</span>



</td>

<td>

<span class="badge <?php echo strtolower(str_replace(' ', '-', $booking['payment_status'])); ?>">

<?php echo htmlspecialchars($booking["payment_status"]); ?>

</span>

</td>

<td>

<?php if(!empty($booking["payment_receipt"])){ ?>

<a
href="../uploads/payment_receipts/<?php echo htmlspecialchars($booking["payment_receipt"]); ?>"
target="_blank"
class="receipt-link modify-btn">

View Receipt

</a>
<?php }else{ ?>

<span class=" no-receipt">

No Receipt

</span>

<?php } ?>

</td>

<td>

<form action="update-booking-cost.php" method="POST">

<input 
type="hidden" 
name="booking_id" 
value="<?php echo $booking['id']; ?>">


<input 
type="number"
name="quoted_amount"
placeholder="Enter cost"
value="<?php echo htmlspecialchars($booking['quoted_amount']); ?>"
required>


<button type="submit">

Save

</button>


</form>


</td>




<td>


<a 
href="update-booking-status.php?id=<?php echo $booking['id']; ?>&status=Approved"
class="modify-btn">

Approve

</a>



<a 
href="update-booking-status.php?id=<?php echo $booking['id']; ?>&status=Denied"
class="cancel-btn">

Deny

</a>




<?php if(
$booking["payment_status"] == "Awaiting Confirmation" 
&& 
!empty($booking["payment_receipt"])
){ ?>

<a 
href="update-payment-status.php?id=<?php echo $booking['id']; ?>&status=Paid"
class="modify-btn">

Confirm Payment

</a>

<?php } ?>







</td>






</tr>




<?php


}


}else{


?>


<tr>

<td colspan="10" style="text-align:center;">


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




<?php include "includes/footer.php"; ?>



</main>



</body>


</html>