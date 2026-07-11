<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "vip_car_rental";

$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($conn, $database)) {
    $createDbSql = "CREATE DATABASE IF NOT EXISTS $database";
    if (!mysqli_query($conn, $createDbSql)) {
        die("Database creation failed: " . mysqli_error($conn));
    }

    if (!mysqli_select_db($conn, $database)) {
        die("Failed to select database: " . mysqli_error($conn));
    }
}

mysqli_set_charset($conn, "utf8");

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
    die("Table creation failed: " . mysqli_error($conn));
}
?>