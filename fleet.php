<?php

require "config.php";

$sql = "SELECT * FROM vehicles_table
        WHERE availability='Available'
        ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>VIP Fleet | Raymond Kadri</title>

<link rel="stylesheet" href="styles.css">

<link rel="stylesheet" href="fleet.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
rel="stylesheet">
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
<a class="book-btn" href="fleet.php">Book Ride</a>
</div>
</nav>

<section class="fleet-hero">

<div class="overlay"></div>

<div class="hero-content">

<h1>Luxury Fleet</h1>

<p>
Experience comfort, prestige and elegance.
Choose from our exclusive collection
of premium vehicles.
</p>

</div>

</section>

<section class="fleet-controls">

<input
type="text"
id="searchInput"
placeholder="Search vehicle...">

<select id="categoryFilter">
<option value="all">All Vehicles</option>
<option value="SUV">SUV</option>
<option value="Sedan">Sedan</option>
<option value="Luxury">Luxury</option>
<option value="Sports">Sports</option>
</select>

</section>

<!-- <section class="fleet-grid" id="fleetGrid">

<div class="car-card" data-category="Luxury">
<img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70">

<div class="car-info">

<h3>Mercedes S-Class</h3>

<span>Luxury</span>

<div class="specs">
<p><i class="fas fa-users"></i> 4 Seats</p>
<p><i class="fas fa-gas-pump"></i> Petrol</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$450/day</h4>
<button> <a href="login.php">Book Now</a> </button>
</div>

</div>
</div>

<div class="car-card" data-category="SUV">
<img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b">

<div class="car-info">

<h3>Range Rover Vogue</h3>

<span>SUV</span>

<div class="specs">
<p><i class="fas fa-users"></i> 7 Seats</p>
<p><i class="fas fa-gas-pump"></i> Petrol</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$500/day</h4>
<button> <a href="login.php">Book Now</a> </button>
</div>

</div>
</div>

<div class="car-card" data-category="Sports">
<img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7">

<div class="car-info">

<h3>Lamborghini Huracan</h3>

<span>Sports</span>

<div class="specs">
<p><i class="fas fa-users"></i> 2 Seats</p>
<p><i class="fas fa-gas-pump"></i> Petrol</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$1200/day</h4>
<button> <a href="login.php">Book Now</a> </button>
</div>

</div>
</div>

<div class="car-card" data-category="Sedan">
<img src="https://images.unsplash.com/photo-1502877338535-766e1452684a">

<div class="car-info">

<h3>BMW 7 Series</h3>

<span>Sedan</span>

<div class="specs">
<p><i class="fas fa-users"></i> 5 Seats</p>
<p><i class="fas fa-gas-pump"></i> Hybrid</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$400/day</h4>
<button> <a href="login.php">Book Now</a> </button>
</div>

</div>
</div>

<div class="car-card" data-category="Sedan">
<img src="https://images.unsplash.com/photo-1502877338535-766e1452684a">

<div class="car-info">

<h3>BMW 7 Series</h3>

<span>Sedan</span>

<div class="specs">
<p><i class="fas fa-users"></i> 5 Seats</p>
<p><i class="fas fa-gas-pump"></i> Hybrid</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$400/day</h4>
<button> <a href="login.php">Book Now</a> </button>
</div>

</div>
</div>

<div class="car-card" data-category="Sedan">
<img src="https://images.unsplash.com/photo-1502877338535-766e1452684a">

<div class="car-info">

<h3>BMW 7 Series</h3>

<span>Sedan</span>

<div class="specs">
<p><i class="fas fa-users"></i> 5 Seats</p>
<p><i class="fas fa-gas-pump"></i> Hybrid</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$400/day</h4>
<button> <a href="login.php">Book Now</a> </button>
</div>

</div>
</div>

<div class="car-card" data-category="Sedan">
<img src="https://images.unsplash.com/photo-1502877338535-766e1452684a">

<div class="car-info">

<h3>BMW 7 Series</h3>

<span>Sedan</span>

<div class="specs">
<p><i class="fas fa-users"></i> 5 Seats</p>
<p><i class="fas fa-gas-pump"></i> Hybrid</p>
<p><i class="fas fa-cog"></i> Automatic</p>
</div>

<div class="card-footer">
<h4>$400/hr</h4>
<button> <a href="fleet.html">Book Now</a> </button>
</div>

</div>
</div>

</section> -->

<section class="fleet-grid" id="fleetGrid">

<?php

if($result && mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

?>

<div
class="car-card"
data-category="<?php echo htmlspecialchars($row['category']); ?>">

<img
src="uploads/vehicles/<?php echo htmlspecialchars($row['image']); ?>"
alt="<?php echo htmlspecialchars($row['vehicle_name']); ?>">

<div class="car-info">

<h3>

<?php echo htmlspecialchars($row['vehicle_name']); ?>

</h3>

<span>

<?php echo htmlspecialchars($row['category']); ?>

</span>

<div class="specs">

<p>

<i class="fas fa-users"></i>

<?php echo htmlspecialchars($row['seats']); ?> Seats

</p>

<p>

<i class="fas fa-gas-pump"></i>

<?php echo htmlspecialchars($row['fuel_type']); ?>

</p>

<p>

<i class="fas fa-cog"></i>

<?php echo htmlspecialchars($row['transmission']); ?>

</p>

</div>

<div class="card-footer">

<h4>

₦<?php echo number_format($row['price_per_hour']); ?>/hr

</h4>

<!-- <button>

<a href="login.php">

Book Now

</a>

</button> -->

<button>

<a href="login.php?vehicle_id=<?php echo $row['id']; ?>">

Book Now

</a>

</button>

</div>

</div>

</div>

<?php

}

}else{

?>

<h2 style="color:white;text-align:center;grid-column:1/-1;">

No vehicles available.

</h2>

<?php

}

?>

</section>
<!-- <p id="noResults" class="no-results">
    Car not found.
</p> -->

<footer class="footer">

    <div class="footer-container">

        <!-- COMPANY -->

        <div class="footer-column">

            <h2>Raymond Kadri VIP Rentals</h2>

            <p>
                Delivering luxury transportation experiences
                with elegance, comfort and professionalism.
            </p>

        </div>

        <!-- QUICK LINKS -->

        <div class="footer-column quick-links">

            <h3>Quick Links</h3>

            <ul>

                <li><a href="index.html">Home</a></li>

                <li><a href="about.html">About</a></li>

                <li><a href="fleet.html">Fleet</a></li>

                <li><a href="services.html">Services</a></li>

                <li><a href="contact.html">Contact</a></li>      
                <li><a href="faqs.html">FAQs</a></li> 
                <li><a href="fleet.php">Book Now</a></li>
                <li><a href="privacy.html">Privacy Policy</a></li>
                <li><a href="termsofservice.html">Terms of Service</a></li>  
                <li><a href="reviews.php">Reviews&Ratings</a></li>   

            </ul>

        </div>

        <!-- SERVICES -->

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

        <!-- CONTACT -->

        <div class="footer-column">

            <h3>Contact</h3>

            <p>
                <i class="fa-solid fa-phone"></i>
                +234 7037952489
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

    <!-- SOCIALS -->
    <div class="footer-socials">

        <a href="https://www.linkedin.com/in/raymond-kadri-1b0b3b1b2/" target="_blank">
            <img src="download__4_-removebg-preview (1).png" alt="">
        </a>

        <a href="https://twitter.com/RaymondKadri" target="_blank">
            <img src="download__3_-removebg-preview (1).png" alt=""> 
        </a>

        <a href="https://wa.me/2347037952489" target="_blank">
            <img src="download__1_-removebg-preview (2).png" alt="">
        </a>

        <a href="https://www.facebook.com/raymond-kadri-1b0b3b1b2/" target="_blank">
             <img src="download__2_-removebg-preview (3).png" alt="">
        </a>

    </div>
    
    <!-- COPYRIGHT -->

    <div class="footer-bottom">

        <p>
            © 2026 Raymond Kadri VIP Rentals.
            All Rights Reserved.
        </p>

    </div>

</footer>

<script src="fleet.js"></script>

</body>
</html>