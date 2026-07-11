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
| GET USER DATA
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


<title>Edit Profile</title>


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

<h1>Edit Profile</h1>

<p>

Update your account information.

</p>

</div>




<form
action="update-profile.php"
method="POST"
enctype="multipart/form-data"
class="edit-profile-form">





<div class="edit-avatar">


<img
id="profilePreview"
src="<?php echo $profileImage; ?>?v=<?php echo $profileImageCache; ?>"
alt="Profile Picture">


<label for="profileInput">

Change Photo

</label>


<input

type="file"

id="profileInput"

name="profile_picture"

accept="image/*"

>


</div>






<div class="profile-grid">


<div class="input-group">

<label>

Full Name

</label>


<input

type="text"

name="name"

value="<?php echo htmlspecialchars($user["name"]); ?>"

required>

</div>




<div class="input-group">


<label>

Email Address

</label>


<input

type="email"

name="email"

value="<?php echo htmlspecialchars($user["email"]); ?>"

required>


</div>





<div class="input-group">


<label>

Phone Number

</label>


<input

type="text"

name="phone_number"

value="<?php echo htmlspecialchars($user["phone_number"]); ?>"

required>


</div>



</div>






<h2>Password Change</h2>


<p class="password-note">

Leave password fields empty if you do not want to change your password.

</p>



<div class="profile-grid">


<div class="input-group">

<label>

Current Password

</label>


<input

type="password"

name="current_password"

>


</div>





<div class="input-group">


<label>

New Password

</label>


<input

type="password"

name="new_password"

>


</div>






<div class="input-group">


<label>

Confirm New Password

</label>


<input

type="password"

name="confirm_password"

>


</div>



</div>





<button

type="submit"

class="save-btn">


Save Changes


</button>





</form>




</section>



<?php include "includes/footer.php"; ?>



</div>


</div>





<script>


const profileInput = document.getElementById("profileInput");

const profilePreview = document.getElementById("profilePreview");



profileInput.addEventListener("change",function(){


if(this.files && this.files[0]){


profilePreview.src = URL.createObjectURL(this.files[0]);


}


});



</script>




</body>


</html>