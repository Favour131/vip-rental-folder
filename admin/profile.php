<?php

session_start();

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}


require "../config.php";


$currentPage = "profile";

$pageTitle = "Admin Profile";

$pageDescription = "Manage your admin account";

$searchPlaceholder = "Search...";


$admin_id = $_SESSION["admin_id"];



$sql = "SELECT id, name, email, created_at 
        FROM admins 
        WHERE id=? 
        LIMIT 1";


$stmt = mysqli_prepare($conn,$sql);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $admin_id
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$admin = mysqli_fetch_assoc($result);



?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Admin Profile</title>


<link rel="stylesheet" href="admin.css">

<link rel="stylesheet" href="profile.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


</head>


<body>


<div class="overlay"></div>


<?php include "includes/sidebar.php"; ?>


<main class="main-content">


<?php include "includes/topbar.php"; ?>



<section class="profile-section">


<div class="profile-card">


<div class="profile-icon">

<i class="fa-solid fa-user"></i>

</div>


<h2>

<?php echo htmlspecialchars($admin["name"]); ?>

</h2>


<p class="admin-role">

Administrator

</p>



<div class="profile-details">


<div>

<strong>Name</strong>

<p>
<?php echo htmlspecialchars($admin["name"]); ?>
</p>

</div>



<div>

<strong>Email</strong>

<p>
<?php echo htmlspecialchars($admin["email"]); ?>
</p>

</div>



<div>

<strong>Account Created</strong>

<p>

<?php echo date("d M Y",strtotime($admin["created_at"])); ?>

</p>

</div>


</div>



<a href="edit-profile.php" class="profile-btn">

Edit Profile

</a>

<a href="change-password.php" class="profile-btn">

Change Password

</a>



</div>


</section>


<?php include "includes/footer.php"; ?>


</main>


</body>

</html>