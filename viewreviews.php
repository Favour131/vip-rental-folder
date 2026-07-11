<?php

require "config.php";


$reviewQuery = mysqli_query(

    $conn,

    "SELECT 
        reviews_table.*,
        users.name

    FROM reviews_table

    INNER JOIN users

    ON reviews_table.user_id = users.id

    WHERE reviews_table.status='Approved'

    ORDER BY reviews_table.created_at DESC"

);


?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>All Reviews | Raymond Kadri VIP Rentals</title>


<link rel="stylesheet" href="reviews.css">

<link rel="stylesheet" href="viewreviews.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


</head>


<body>



<section class="reviews-page-hero">


<div class="overlay"></div>


<div class="hero-content">


<h1>All Customer Reviews</h1>


<p>
Read experiences from our valued VIP clients.
</p>


</div>


</section>



<section class="all-reviews-section">


<h2>

Customer Experiences

</h2>



<div class="all-reviews-grid">
    <?php


if(mysqli_num_rows($reviewQuery) > 0){


while($review = mysqli_fetch_assoc($reviewQuery)){


?>


<div class="review-card">


<h3 class="reviewer-name">

<?php echo htmlspecialchars($review["name"]); ?>

</h3>



<div class="stars">


<?php

for($i = 1; $i <= 5; $i++){


if($i <= $review["rating"]){


echo '<i class="fa-solid fa-star"></i>';


}else{


echo '<i class="fa-regular fa-star"></i>';


}


}


?>


</div>




<p>


<?php echo htmlspecialchars($review["review"]); ?>


</p>





<?php if(!empty($review["admin_reply"])){ ?>


<div class="admin-reply">


<strong>

Admin Reply

</strong>



<p>

<?php echo htmlspecialchars($review["admin_reply"]); ?>

</p>


</div>



<?php } ?>



</div>



<?php


}


}else{


?>


<p class="no-reviews">

No reviews available yet.

</p>


<?php

}


?>
</div>


</section>



<div class="back-reviews">

<a href="reviews.php">

← Back to Reviews

</a>

</div>



</body>

</html>