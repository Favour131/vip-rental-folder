<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


require "../config.php";



if(isset($_GET["id"]) && isset($_GET["status"])){


    $id = intval($_GET["id"]);

    $status = $_GET["status"];



    $stmt = $conn->prepare("UPDATE reviews_table SET status = ? WHERE id = ?");


    $stmt->bind_param("si", $status, $id);


    $stmt->execute();


    $stmt->close();


}



header("Location: manage-reviews.php");

exit();


?>