<?php

$currentPage = "manage-users";

$pageTitle = "Manage Users";

$pageDescription = "View all registered users";

$searchPlaceholder = "Search users...";

require "../config.php";

/*
|--------------------------------------------------------------------------
| FETCH USERS
|--------------------------------------------------------------------------
*/

$sql = "SELECT id, name, email, phone_number
        FROM users
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage Users | VIP Rental</title>

<link
rel="stylesheet"
href="admin.css">

<link
rel="stylesheet"
href="manage-users.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="overlay"></div>

<?php include "includes/sidebar.php"; ?>

<main class="main-content">

<?php include "includes/topbar.php"; ?>

<section class="users-container">

<div class="section-title">

<h2>

<i class="fa-solid fa-users"></i>

Registered Users

</h2>

</div>
<?php

if ($result) {

    if (mysqli_num_rows($result) > 0) {

?>

<div class="table-container">

    <table class="users-table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Phone Number</th>

            </tr>

        </thead>

        <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td><?php echo htmlspecialchars($row['id']); ?></td>

                <td><?php echo htmlspecialchars($row['name']); ?></td>

                <td><?php echo htmlspecialchars($row['email']); ?></td>

                <td><?php echo htmlspecialchars($row['phone_number']); ?></td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

<?php

    } else {

?>

<div class="message-box warning">

    <i class="fa-solid fa-circle-info"></i>

    <h3>No Users Found</h3>

    <p>No registered users were found in the database.</p>

</div>

<?php

    }

} else {

?>

<div class="message-box error">

    <i class="fa-solid fa-triangle-exclamation"></i>

    <h3>Database Error</h3>

    <p><?php echo htmlspecialchars(mysqli_error($conn)); ?></p>

</div>

<?php

}

?>

</section>

<?php include "includes/footer.php"; ?>