<?php
    include_once "../header.php";
    require_once '/var/www/dbhInc.php';

if (isset($_POST['remove_post'])) {
    $post_id = $_POST['post_id'];

    $sql = "DELETE FROM your_table WHERE id = $post_id";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Add the necessary code to remove the post from the database
    // ...

    // Redirect back to the page after removal
    header("Location: ../admin.php");
    exit();
}
