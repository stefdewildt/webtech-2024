<?php    

include_once('header.php');
require_once '/var/www/dbhInc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST["content"];
    $user_id = $_SESSION['id'];

    // Insert data into the database
    $sql = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')";
    if ($conn->query($sql) === TRUE) {
        $postId = $conn->insert_id;
        header("Location: viewpost.php?id=$postId");
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

