<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}


require "../config.php";


$currentPage = "profile";

$searchPlaceholder = "Search...";

$pageTitle = "Change Password";

$pageDescription = "Update your admin password";


$admin_id = $_SESSION["admin_id"];


$message = "";

$error = "";



if($_SERVER["REQUEST_METHOD"] == "POST"){


    $current_password = $_POST["current_password"];

    $new_password = $_POST["new_password"];

    $confirm_password = $_POST["confirm_password"];



    $sql = "SELECT password FROM admins WHERE id=? LIMIT 1";


    $stmt = mysqli_prepare($conn,$sql);


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $admin_id
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);


    $admin = mysqli_fetch_assoc($result);



    if(password_verify($current_password,$admin["password"])){


        if($new_password === $confirm_password){


            $hashed_password = password_hash(
                $new_password,
                PASSWORD_DEFAULT
            );



            $update_sql = "UPDATE admins SET password=? WHERE id=?";


            $update_stmt = mysqli_prepare($conn,$update_sql);



            mysqli_stmt_bind_param(
                $update_stmt,
                "si",
                $hashed_password,
                $admin_id
            );



            if(mysqli_stmt_execute($update_stmt)){


                $message = "Password changed successfully.";


            }


        }else{


            $error = "New passwords do not match.";

        }



    }else{


        $error = "Current password is incorrect.";

    }


}


?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Change Password</title>


<link rel="stylesheet" href="admin.css">

<link rel="stylesheet" href="profile.css">

<link rel="stylesheet" href="edit-profile.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


</head>


<body>


<div class="overlay"></div>


<?php include "includes/sidebar.php"; ?>


<main class="main-content">


<?php include "includes/topbar.php"; ?>



<section class="edit-profile-section">


<div class="edit-profile-card">


<h2>

<i class="fa-solid fa-lock"></i>

Change Password

</h2>



<?php if(!empty($message)){ ?>

<p class="success-message">

<?php echo $message; ?>

</p>

<?php } ?>



<?php if(!empty($error)){ ?>

<p class="error-message">

<?php echo $error; ?>

</p>

<?php } ?>



<form method="POST">


<div class="form-group">

<label>
Current Password
</label>

<input 
type="password"
name="current_password"
required>

</div>



<div class="form-group">

<label>
New Password
</label>

<input 
type="password"
name="new_password"
required>

</div>



<div class="form-group">

<label>
Confirm New Password
</label>

<input 
type="password"
name="confirm_password"
required>

</div>



<button type="submit">

Update Password

</button>



</form>


</div>


</section>



<?php include "includes/footer.php"; ?>


</main>


</body>

</html>