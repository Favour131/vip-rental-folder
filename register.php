<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone_number"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, phone_number, password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    // if ($stmt->execute()) {
    //     header("Location: bookride.php");
    //     exit;
    // }
    if ($stmt->execute()) {

    header("Location: user/user-dashboard.php");

    exit;

}

    if ($stmt->errno === 1062) {
        die("An account with this email already exists.");
    }

    die("Error: " . $stmt->error);
}
?>