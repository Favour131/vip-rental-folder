<?php
session_start();
$vehicle_id = $_GET["vehicle_id"] ?? "";
$redirect = $_GET["redirect"] ?? "";
require "config.php";
$error = "";

if (isset($_POST["login"])){
    
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    if ($stmt === false) {
        $error = "Unable to process login right now.";
    } else {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            // header("Location: bookride.php");
            // header("Location: bookride.php?vehicle_id=" . $vehicle_id);
            // exit;
            if(!empty($vehicle_id)){

    // User came from booking
    header("Location: bookride.php?vehicle_id=" . $vehicle_id);

}
// elseif($redirect == "dashboard"){

//     // User came from dashboard
//     header("Location: user/user-dashboard.php");

// }
// else{

//     // Default login destination
//     header("Location: user/user-dashboard.php");

// }
elseif($redirect == "dashboard"){

    // User came from dashboard
    header("Location: user/user-dashboard.php");

}
elseif($redirect == "reviews"){

    // User came from reviews
    header("Location: reviews.php");

}
else{

    // Default login destination
    header("Location: user/user-dashboard.php");

}

exit;
        }

        $error = "Invalid email or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Raymond Kadri VIP Rentals</title>

    <link rel="stylesheet" href="login.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="login-container">

        <div class="login-box">

            <h1>Welcome Back</h1>

            <p class="subtitle">
                Sign in to access your account
            </p>

            <?php
            if(!empty($error)){
                echo "<p style='color: red; text-align: center;'>$error</p>";
            }
            ?>
            <!-- <form id="loginForm" action="login.php" method="POST">
                 -->
                 <!-- <form id="loginForm"action="login.php?vehicle_id=<?php echo $vehicle_id; ?>"method="POST"> -->
            <form id="loginForm" action="login.php?vehicle_id=<?php echo $vehicle_id; ?>&redirect=<?php echo $redirect; ?>" method="POST">
                <div class="input-group">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                    name="email"
                    autocomplete="off"
                    type="email"
                    placeholder="Email Address"
                    required>

                </div>

                <div class="input-group">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    id="password"
                    placeholder="Password"
                    required>

                    <!-- <i
                    class="fa-solid fa-eye toggle-password"
                    id="togglePassword">
                    </i> -->

                </div>

                <button type="submit" name="login">
                    Login
                </button>

            </form>

            <p class="register-text">
                Don't have an account with us?
                <a href="signup.php">Sign Up</a>
            </p>

        </div>

    </div>

    <script src="login.js"></script>

</body>
</html>