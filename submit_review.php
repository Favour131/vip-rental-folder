<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require "config.php";


// Check if user is logged in

// 

if(!isset($_SESSION["user_id"])){

    header("Location: login.php?redirect=reviews");

    exit();

}


// Check form submission

if($_SERVER["REQUEST_METHOD"] == "POST"){



    $user_id = $_SESSION["user_id"];

    $rating = $_POST["rating"];

    $review = trim($_POST["review"]);



    // Insert review

    $sql = "

    INSERT INTO reviews_table

    (
        user_id,
        rating,
        review,
        status
    )

    VALUES

    (?,?,?,'Pending')

    ";



    $stmt = mysqli_prepare($conn,$sql);



    mysqli_stmt_bind_param(

        $stmt,

        "iis",

        $user_id,

        $rating,

        $review

    );



    if(mysqli_stmt_execute($stmt)){


        if(mysqli_stmt_execute($stmt)){


    $_SESSION["review_success"] = true;


    header("Location: reviews.php");

    exit();


}

    }else{


        echo "

        <script>

        alert('Could not submit review.');

        window.location.href='reviews.php';

        </script>

        ";


    }



}else{


    header("Location: reviews.php");

    exit();

}


?>