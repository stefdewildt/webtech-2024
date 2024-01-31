<?php
    include_once "../header.php";
    require_once '/var/www/dbhInc.php';

if (isset($_POST['remove_user'])) {
    $post_id = $_POST['user_id'];

    $sql = "DELETE FROM users WHERE usersId = $post_id";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Add the necessary code to remove the post from the database
    // ...

    // Redirect back to the page after removal
    header("Location: ../admin_users.php");
    exit();
}
