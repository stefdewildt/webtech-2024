<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melodies connected</title>
    <link rel="stylesheet" href="https://webtech-bg2.webtech-uva.nl/php_files/css_files/header_styles.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,400&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="upper-bar">
            <div class="header-left">
                <h1> Melodies Connected <img src="/img/musicalnote.png" width="2" height="2"/></h1>
            </div>
            <div class="header-right"> 
                <div class="Home"><a href="https://webtech-bg2.webtech-uva.nl/index.php">Home</a></div>
            </div>
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo '<div class="header-right"> 
                            <div class="Logout"><a href="https://webtech-bg2.webtech-uva.nl/php_files/includes/logoutInc.php">Log out</a></div>
                        </div>';                    
                }
                else{
                    echo '<div class="header-right"> 
                            <div class="Login"><a href="https://webtech-bg2.webtech-uva.nl/php_files/login.php">Log in</a></div>
                        </div>';
                    echo '<div class="header-right"> 
                            <div class="Signup"><a href="https://webtech-bg2.webtech-uva.nl/php_files/signup.php">Sign up</a></div>
                        </div>';
                }
            ?>

        </div>
        <nav class="menu-bar">
            <ul>
            <?php
            if (isset($_SESSION["useruid"])) { 
                echo '<li><a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php">Profile</a></li>';                                
                }
            ?> 
                <li><a href="/html/discover.html">Discover</a></li>
                <li><a href="https://webtech-bg2.webtech-uva.nl/php_files/friends.php">Friends</a></li>
                <li>
                    <form class="search-form">
                        <input type="text" placeholder="Search friends, genres, artists...">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
