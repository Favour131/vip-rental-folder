<?php

session_start();

require "../config.php";


if(!isset($_SESSION["user_id"])){

    header("Location: ../login.php");
    exit();

}


$user_id = $_SESSION["user_id"];


/*
|--------------------------------------------------------------------------
| GET USER INFORMATION
|--------------------------------------------------------------------------
*/

$sql = "SELECT * FROM users WHERE id=?";


$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);



/*
|--------------------------------------------------------------------------
| PROFILE IMAGE
|--------------------------------------------------------------------------
*/


if(
    !empty($user["profile_picture"]) &&
    file_exists("../uploads/profile/".$user["profile_picture"])
){

    $profileImage = "../uploads/profile/".$user["profile_picture"];
    $profileImageCache = filemtime($profileImage);

}else{

    $profileImage = "../images/default-avatar.png";
    $profileImageCache = time();

}


?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>My Profile</title>


<link rel="stylesheet" href="./dashboard.css?v=1">


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


<h1>My Profile</h1>


<p>

View your account information.

</p>


</div>




<div class="profile-card">



<div class="profile-avatar">


<img
src="<?php echo $profileImage; ?>?v=<?php echo $profileImageCache; ?>"
alt="Profile Picture">


</div>




<div class="profile-information">


<h2>

<?php echo htmlspecialchars($user["name"]); ?>

</h2>


<div class="profile-details">


<p>

<i class="fa-solid fa-envelope"></i>

<?php echo htmlspecialchars($user["email"]); ?>

</p>



<p>

<i class="fa-solid fa-phone"></i>

<?php echo htmlspecialchars($user["phone_number"]); ?>

</p>



<p>

<i class="fa-solid fa-calendar"></i>

Joined:

<?php echo date("d M Y",strtotime($user["createdat"])); ?>

</p>


</div>



<a href="edit-profile.php" class="edit-profile-btn">

<i class="fa-solid fa-pen"></i>

Edit Profile

</a>


</div>



</div>



</section>



<?php include "includes/footer.php"; ?>


</div>


</div>



</body>


</html>