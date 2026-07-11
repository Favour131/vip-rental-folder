<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


require "../config.php";



if($_SERVER["REQUEST_METHOD"] == "POST"){


    $review_id = intval($_POST["review_id"]);

    $admin_reply = trim($_POST["admin_reply"]);



    $stmt = $conn->prepare("

    UPDATE reviews_table 

    SET admin_reply = ?

    WHERE id = ?

    ");



    $stmt->bind_param("si", $admin_reply, $review_id);



    $stmt->execute();


    $stmt->close();


}



header("Location: manage-reviews.php");

exit();


?>