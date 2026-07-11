<?php

session_start();

require "../config.php";


if(isset($_SESSION["admin_id"])){

    header("Location: dashboard.php");
    exit();

}



$error = "";



if($_SERVER["REQUEST_METHOD"] == "POST"){


    $email = trim($_POST["email"]);

    $password = $_POST["password"];



    $sql = "SELECT * FROM admins WHERE email=?";


    $stmt = mysqli_prepare($conn,$sql);


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );


    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);



    if(mysqli_num_rows($result) == 1){


        $admin = mysqli_fetch_assoc($result);



        if(password_verify($password,$admin["password"])){


            $_SESSION["admin_id"] = $admin["id"];

            $_SESSION["admin_name"] = $admin["name"];


            header("Location: dashboard.php");

            exit();


        }else{

            $error = "Invalid password.";

        }



    }else{


        $error = "Admin account not found.";

    }


}



?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Admin Login</title>


<link rel="stylesheet" href="admin2.css">


</head>


<body>


<div class="admin-login-container">


<div class="admin-login-box">


<h1>
Admin Login
</h1>



<?php if(!empty($error)){ ?>

<p class="error">

<?php echo $error; ?>

</p>

<?php } ?>



<form method="POST" autocomplete="off">



<div class="input-group">

<label>Email</label>

<input 
type="email"
name="email"
autocomplete="new-email"
required>

</div>



<div class="input-group">

<label>Password</label>

<input 
type="password"
name="password"
autocomplete="new-password"
required>

</div>



<button type="submit">

Login

</button>



</form>



</div>


</div>



</body>

</html>