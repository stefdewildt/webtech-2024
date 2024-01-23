<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php project</title>
    <link rel="stylesheet" href="css_files/reset.css">
    <link rel="stylesheet" href="css_files/header_styles.css">
</head>
<body>
    <h1> Melodies Connected <img src="/img/musicalnote.png" width="2" height="2"/></h1>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="discover.php">About us</a></li>
                <li><a href="blog.php">Find Blogs</a></li>
                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<li><a href='profile.php'>Profile Page</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
                    }
                    else{
                        echo "<li><a href='signup.php'>Sign up</a></li>";
                        echo "<li><a href='login.php'>Log in</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
