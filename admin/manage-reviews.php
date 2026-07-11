<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


$currentPage = "manage-reviews";

$pageTitle = "Manage Reviews";

$pageDescription = "View and manage customer reviews";

$searchPlaceholder = "Search reviews...";


require "../config.php";



/*
|-------------------------------------------------------------------------- 
| GET REVIEWS
|-------------------------------------------------------------------------- 
*/


$sql = "

SELECT

reviews_table.*,

users.name AS customer_name,

users.email


FROM reviews_table


INNER JOIN users

ON reviews_table.user_id = users.id


ORDER BY reviews_table.created_at DESC

";



$result = mysqli_query($conn,$sql);



?>

<!DOCTYPE html>

<html lang="en">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Manage Reviews | VIP Rental</title>


<link rel="stylesheet" href="admin.css">

<link rel="stylesheet" href="manage-reviews.css">


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

<i class="fa-solid fa-star"></i>

Manage Reviews

</h2>


</div>



<div class="review-table-container">


<table class="review-table">


<thead>

<tr>

<th>Customer</th>

<th>Rating</th>

<th>Review</th>

<th>Status</th>

<th>Reply</th>

<th>Action</th>


</tr>


</thead>



<tbody>
    <?php


if(mysqli_num_rows($result) > 0){


while($review = mysqli_fetch_assoc($result)){


?>

<tr>


<td>

<strong>

<?php echo htmlspecialchars($review["customer_name"]); ?>

</strong>


<br>

<small>

<?php echo htmlspecialchars($review["email"]); ?>

</small>


</td>




<td>


<?php echo htmlspecialchars($review["rating"]); ?>


</td>




<td>


<?php echo htmlspecialchars($review["review"]); ?>


</td>




<td>


<span class="badge <?php echo strtolower($review["status"]); ?>">


<?php echo htmlspecialchars($review["status"]); ?>


</span>


</td>




<td>


<?php


if(!empty($review["admin_reply"])){

echo htmlspecialchars($review["admin_reply"]);

}else{

echo "No reply yet";

}


?>


</td>




<!-- <td>


<a href="update-review-status.php?id=<?php echo $review['id']; ?>&status=Approved"

class="modify-btn">

Confirm

</a>



<a href="delete-review.php?id=<?php echo $review['id']; ?>"

class="cancel-btn">

Delete

</a>



</td> -->
<td>


<?php if($review["status"] != "Approved"){ ?>


<a href="update-review-status.php?id=<?php echo $review['id']; ?>&status=Approved"

class="modify-btn">

Confirm

</a>


<?php }else{ ?>


<form action="reply-review.php" method="POST">


<input 
type="hidden" 
name="review_id" 
value="<?php echo $review['id']; ?>">



<textarea 
name="admin_reply"
placeholder="Write reply..."
required></textarea>



<button type="submit" class="modify-btn">

Reply

</button>


</form>


<?php } ?>



<a href="delete-review.php?id=<?php echo $review['id']; ?>"

class="cancel-btn">

Delete

</a>



</td>


</tr>



<?php


}


}else{


?>

<tr>

<td colspan="6" style="text-align:center;">

No reviews found.

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