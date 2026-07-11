<?php

session_start();

require "config.php";


$reviewSuccess = false;


if(isset($_SESSION["review_success"])){

    $reviewSuccess = true;

    unset($_SESSION["review_success"]);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reviews & Ratings | Raymond Kadri VIP Rentals</title>

<link rel="stylesheet" href="styles.css">

<link rel="stylesheet" href="reviews.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <nav>

<div class="logo">
RK
</div>

<button class="nav-toggle" aria-label="Open navigation">
    <span></span>
</button>
<div class="nav-menu">
<div class="nav-menu-sub">
    <ul>

        <li><a href="index.html">Home</a></li>
        <li><a href="fleet.php">Fleet</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="user/user-dashboard.php">Dashboard</a></li>

    </ul>
</div>
<a class="book-btn" href="fleet.php">
    Book Ride
    </a>
    </div>
</nav>


<!-- HERO -->

<section class="hero">

<div class="overlay"></div>

<div class="hero-content">

<h1>Customer Reviews</h1>

<p>
See what our valued clients have to say about
their luxury rental experience.
</p>

</div>

</section>

<!-- RATING SUMMARY -->

<section class="rating-summary">

<div class="overall-rating">

<h2>23.7k</h2>

<div class="stars">

<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star-half-stroke"></i>

</div>

<p>Based on Users Reviews</p>

</div>

<div class="rating-bars">

<div class="bar">
<span>5 ★</span>
<div class="progress">
<div style="width:90%"></div>
</div>
</div>

<div class="bar">
<span>4 ★</span>
<div class="progress">
<div style="width:7%"></div>
</div>
</div>

<div class="bar">
<span>3 ★</span>
<div class="progress">
<div style="width:2%"></div>
</div>
</div>

<div class="bar">
<span>2 ★</span>
<div class="progress">
<div style="width:1%"></div>
</div>
</div>

<div class="bar">
<span>1 ★</span>
<div class="progress">
<div style="width:0%"></div>
</div>
</div>

</div>

</section>

<!-- REVIEW CARDS -->

<section class="reviews-grid">

<?php

$reviewQuery = mysqli_query(
    $conn,
    "SELECT 
        reviews_table.*,
        users.name
    FROM reviews_table
    INNER JOIN users
    ON reviews_table.user_id = users.id
    WHERE reviews_table.status='Approved'
    ORDER BY reviews_table.created_at DESC
    LIMIT 3"
);


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


<p class="reviewer-name">

<?php echo htmlspecialchars($review["review"]); ?>

</p>


<?php if(!empty($review["admin_reply"])){ ?>


<div class="admin-reply">

<strong>
Admin Reply:
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


<p style="text-align:center;">

No reviews available yet.

</p>


<?php

}


?>

</section>

<div class="view-more-reviews">

    <a href="viewreviews.php">
        View More Reviews
    </a>

</div>

<!-- REVIEW FORM -->

<section class="review-form">

<h2>Leave a Review</h2>

<form id="reviewForm" action="submit_review.php" method="POST">

<input
type="text"
placeholder="Your Name"
required>

<!-- <select required>

<option value="">
Select Rating
</option>

<option>★★★★★</option>

<option>★★★★☆</option>

<option>★★★☆☆</option>

<option>★★☆☆☆</option>

<option>★☆☆☆☆</option>

</select> -->

<select name="rating" required>

<option value="">
Select Rating
</option>

<option value="5">
★★★★★
</option>

<option value="4">
★★★★☆
</option>

<option value="3">
★★★☆☆
</option>

<option value="2">
★★☆☆☆
</option>

<option value="1">
★☆☆☆☆
</option>

</select>


<textarea
name="review"
rows="6"
placeholder="Write your review..."
required>
</textarea>

<button type="submit">
Submit Review
</button>

</form>

<p id="successMessage">
Thank you for your review!
</p>



<div class="review-modal" id="reviewModal">

    <div class="review-modal-box">

        <i class="fa-solid fa-circle-check"></i>

        <h2>Review Submitted</h2>

        <p>
            Thank you for your review.
            It is awaiting approval.
        </p>

        <button onclick="closeReviewModal()">
            Continue
        </button>

    </div>

</div>
</section>

<?php if($reviewSuccess){ ?>

<script>

document.getElementById("reviewModal").style.display = "flex";

</script>

<?php } ?>

<footer class="footer">

        <div class="footer-container">

            <div class="footer-column">

                <h2>Raymond Kadri VIP Rentals</h2>

                <p>
                    Delivering luxury transportation experiences
                    with elegance, comfort and professionalism.
                </p>

            </div>

            <div class="footer-column quick-links">

                <h3>Quick Links</h3>

                <ul>

                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="fleet.php">Fleet</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="privacy.html">Privacy Policy</a></li>
                    <li><a href="termsofservice.html">Terms of Service</a></li>
                    <li><a href="reviews.html">Reviews&Ratings</a></li>

                </ul>

            </div>

            <div class="footer-column">

                <h3>Services</h3>
                <div class="footer-column-services">
                <ul>

                    <li>Airport Transfers</li>
                    <li>Wedding Rentals</li>
                    <li>Corporate Rentals</li>
                    <li>Chauffeur Service</li>
                    <li>VIP Transportation</li>

                </ul>
                </div>
            </div>

            <div class="footer-column">

                <h3>Contact</h3>

                <p>
                    <i class="fa-solid fa-phone"></i>
                    +234 XXX XXX XXXX
                </p>

                <p>
                    <i class="fa-solid fa-envelope"></i>
                    info@raymondkadri.com
                </p>

                <p>
                    <i class="fa-solid fa-location-dot"></i>
                    Lagos, Nigeria
                </p>

            </div>

        </div>

        <div class="footer-socials">

            <a href="https://www.linkedin.com/in/raymond-kadri-1b0b3b1b2/" target="_blank">
                <i class="fa-brands fa-facebook-f"><img src="download__4_-removebg-preview (1).png" alt=""></i>
            </a>

            <a href="https://www.twitter.com/raymondkadri/" target="_blank">
                <i class="fa-brands fa-twitter"> <img src="download__3_-removebg-preview (1).png" alt=""> </i>
            </a>

            <a href="https://whatsapp.com/RaymondKadri" target="_blank">
                <i class="fa-brands fa-whatsapp"><img src="download__1_-removebg-preview (2).png" alt=""></i>
            </a>

            <a href="https://www.facebook.com/raymond.kadri.7" target="_blank">
                <i class="fa-brands fa-facebook-f"> <img src="download__2_-removebg-preview (3).png" alt=""> </i>
            </a>

        </div>
        
        <div class="footer-bottom">

            <p>
                © 2026 Raymond Kadri VIP Rentals.
                All Rights Reserved.
            </p>

        </div>

    </footer>

<script src="reviews.js"></script>

</body>
</html>