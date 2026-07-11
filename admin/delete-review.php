<?php

session_start();


if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


require "../config.php";



if(isset($_GET["id"])){


    $id = intval($_GET["id"]);



    $stmt = $conn->prepare("DELETE FROM reviews_table WHERE id = ?");


    $stmt->bind_param("i", $id);


    $stmt->execute();


    $stmt->close();


}



header("Location: manage-reviews.php");

exit();


?>