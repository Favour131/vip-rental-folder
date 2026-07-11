<?php
require "config.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Raymond Kadri VIP Rentals</title>

    <link rel="stylesheet" href="signup.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="signup-container">

        <div class="signup-box">

            <h1>Create Account</h1>

            <p class="subtitle">
                Join Raymond Kadri VIP Rentals today
            </p>

            <form id="signupForm" action="register.php" method="POST" autocomplete="off">

                <div class="input-group">
                    <i class="fa-solid fa-user"></i>

                    <input
                    name="name"
                    type="text"
                    placeholder="Full Name"
                    autocomplete="off"
                    required>
                </div>

                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>

                    <input
                    name="email"
                    type="email"
                    placeholder="Email Address"
                    autocomplete="off"
                    required>
                </div>

                <div class="input-group">
                    <i class="fa-solid fa-phone"></i>

                    <input
                    name="phone_number"
                    type="tel"
                    placeholder="Phone Number"
                    autocomplete="off"
                    required>
                </div>

                <div class="input-group">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    name="password"
                    type="password"
                    id="password"
                    placeholder="Password"
                    autocomplete="new-password"
                    required>

                    <i
                    class="fa-solid fa-eye toggle-password"
                    id="togglePassword">
                    </i>

                </div>

                <div class="input-group">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    name="confirm_password"
                    type="password"
                    id="confirmPassword"
                    placeholder="Confirm Password"
                    autocomplete="new-password"
                    required>

                </div>

                <button type="submit">
                    Create Account
                </button>

            </form>

            <p class="login-text">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </div>

    </div>

    <script src="signup.js"></script>

</body>
</html>