<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}


require "../config.php";


$currentPage = "profile";

$searchPlaceholder = "Search...";

$pageDescription = "Manage your admin account";

$pageTitle = "Admin Profile";
$admin_id = $_SESSION["admin_id"];


$sql = "SELECT name, email FROM admins WHERE id=? LIMIT 1";


$stmt = mysqli_prepare($conn,$sql);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $admin_id
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$admin = mysqli_fetch_assoc($result);



$message = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $name = trim($_POST["name"]);

    $email = trim($_POST["email"]);



    $update_sql = "

    UPDATE admins

    SET name=?, email=?

    WHERE id=?

    ";


    $update_stmt = mysqli_prepare($conn,$update_sql);



    mysqli_stmt_bind_param(
        $update_stmt,
        "ssi",
        $name,
        $email,
        $admin_id
    );



    if(mysqli_stmt_execute($update_stmt)){


        $_SESSION["admin_name"] = $name;


        $message = "Profile updated successfully.";


        $admin["name"] = $name;

        $admin["email"] = $email;


    }


}



?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Edit Profile</title>


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

<i class="fa-solid fa-user-pen"></i>

Edit Profile

</h2>




<?php if(!empty($message)){ ?>

<p class="success-message">

<?php echo $message; ?>

</p>

<?php } ?>



<form method="POST">


<div class="form-group">


<label>Name</label>


<input

type="text"

name="name"

value="<?php echo htmlspecialchars($admin["name"]); ?>"

required>


</div>



<div class="form-group">


<label>Email</label>


<input

type="email"

name="email"

value="<?php echo htmlspecialchars($admin["email"]); ?>"

required>


</div>



<button type="submit">

Save Changes

</button>



</form>


</div>


</section>



<?php include "includes/footer.php"; ?>


</main>


</body>

</html>