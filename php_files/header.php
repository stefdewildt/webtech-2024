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
    <link rel="stylesheet" href="https://webtech-bg2.webtech-uva.nl/php_files/css_files/cookies_styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img/musicalnote.png">
    <script src="https://kit.fontawesome.com/876e2e2682.js" crossorigin="anonymous"></script>
    <div id="cookie-consent">
        <div id="cookie-consent-content">
            <p>"When you visit our website, we store small text files called cookies on your device. 
                These cookies help us remember your preferences and activities on our website.
                This way, we can provide you with a more personalized experience when you visit our website again.
                Please note that some of these cookies may be temporary and will be deleted when you close your browser,
                while others may be permanent and will stay on your device until they expire or you delete them manually. 
                Some of these cookies may also be set by other websites that you visit while on our website.
                We value your privacy and we want to be transparent about our use of cookies.
                By using our website, you consent to our use of cookies as described above."</p>
            <button id="cookie-consent-agree">Agree</button>
        </div>
    </div>
    <style>
    </style>
    <script>
    // In je bestaande JavaScript-code
    $(document).ready(function() {
        // Controleer of de 'cookieConsent' cookie bestaat
        if (document.cookie.indexOf("cookieConsent=accepted") === -1) {
            // Als de cookie niet bestaat, toon het cookie consent
            $("#cookie-consent").show();
        }

        // Wanneer de gebruiker op 'Agree' klikt, stel de cookie in en verberg het consent
        $("#cookie-consent-agree").on("click", function() {
            document.cookie = "cookieConsent=accepted; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            $("#cookie-consent").hide();
        });
    });
    </script>
</head>

<body>
    <a href="#" id="to-top">
        <i" class="fas fa-chevron-up"></i>
    </a>
    <script>
        const toTop = document.getElementById("to-top");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
                toTop.classList.add("active");
            } else {
                toTop.classList.remove("active");
            }
        });        
    </script>
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
                <li><a href="https://webtech-bg2.webtech-uva.nl/php_files/friends.php">Friends</a></li>
                <li>
                    <form class="search-form" method="POST" action="https://webtech-bg2.webtech-uva.nl/php_files/search_friends.php">
                        <input type="text" name="search" placeholder="Search friends, genres, artists...">
                        <button type="submit" name="submit-search">Search</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    

    <div class=content>
