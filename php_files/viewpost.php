<?php

include_once('header.php');
require_once '/var/www/dbhInc.php';

// Check if the ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = $_GET['id'];

    // Retrieve post data from the database based on the ID
    $sql = "SELECT * FROM posts WHERE id = $postId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $content = $row['content'];
        $created_at = $row['created_at'];

        // Display the post details
        echo "<h2>$title</h2>";
        echo "<p>Created at: $created_at</p>";
        echo "<p>$content</p>";
    } else {
        echo "Post not found";
    }
} else {
    echo "Invalid or missing post ID";
}

$conn->close();
