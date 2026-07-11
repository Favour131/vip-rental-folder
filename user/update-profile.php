<?php

session_start();

require "../config.php";


if(!isset($_SESSION["user_id"])){

    header("Location: ../login.php");
    exit();

}


$user_id = $_SESSION["user_id"];



if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: myprofile.php");
    exit();

}



/*
GET FORM DATA
*/

$name = trim($_POST["name"]);

$email = trim($_POST["email"]);

$phone_number = trim($_POST["phone_number"]);



/*
GET CURRENT USER DATA
*/

$sql = "SELECT * FROM users WHERE id=?";


$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$user_id);

mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$user = mysqli_fetch_assoc($result);




/*
PROFILE IMAGE UPLOAD
*/


$profile_picture = $user["profile_picture"];



if(isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0){



    $image_name = $_FILES["profile_picture"]["name"];

    $image_tmp = $_FILES["profile_picture"]["tmp_name"];



    $extension = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));



    $allowed = ["jpg","jpeg","png","webp"];



    if(in_array($extension,$allowed)){



        $new_image_name = time().".".$extension;



        $upload_path = "../uploads/profile/".$new_image_name;



        move_uploaded_file($image_tmp,$upload_path);



        $profile_picture = $new_image_name;



    }


}






/*
UPDATE BASIC INFORMATION
*/


$sql = "UPDATE users SET
name=?,
email=?,
phone_number=?,
profile_picture=?
WHERE id=?";



$stmt = mysqli_prepare($conn,$sql);



mysqli_stmt_bind_param(

$stmt,

"ssssi",

$name,
$email,
$phone_number,
$profile_picture,
$user_id

);



mysqli_stmt_execute($stmt);






/*
PASSWORD UPDATE
*/


$current_password = $_POST["current_password"];

$new_password = $_POST["new_password"];

$confirm_password = $_POST["confirm_password"];




if(
!empty($current_password) &&
!empty($new_password) &&
!empty($confirm_password)
){



    if($new_password == $confirm_password){



        if(password_verify($current_password,$user["password"])) {



            $hashed_password = password_hash(
                $new_password,
                PASSWORD_DEFAULT
            );



            $sql = "UPDATE users SET password=? WHERE id=?";



            $stmt = mysqli_prepare($conn,$sql);



            mysqli_stmt_bind_param(

            $stmt,

            "si",

            $hashed_password,

            $user_id

            );



            mysqli_stmt_execute($stmt);



        }


    }


}





header("Location: myprofile.php");

exit();


?>