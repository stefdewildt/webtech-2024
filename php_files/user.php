<?php
    include_once "header.php";
    require_once '/var/www/dbhInc.php';

    $username = $_SESSION['useruid'];
    $email = $_SESSION['useremail'];
    $name = $_SESSION['username'];
?>
<head>
    <link rel="stylesheet" href="css_files/user_page.css">
</head>

    <div class="pd-row">
        <img src="img/profile.png">
        <div>
            <h3>Name:<?php echo $name?></h3>
            <h3>Username:<?php echo $username?></h3>
            <h3>Email:<?php echo $email?></h3>
            <nav>
                <a href="/html/friends.html">120 friends - 10 mutual </a>
            </nav> 
        </div>        
    </div>

    <div class="profile-posts">
        <ul class="profile-post">
            <li><h2>Your favourites</h2></li>
              <div class="chosen-music">
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/1HAW56e0zz05phUnzuHF9E?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/2ut4BOQSqxLpcX5MtPjzYa?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/37Tmv4NnfQeb0ZgUC4fOJj?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3Um9toULmYFGCpvaIPFw7l?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3MyQn1xBQwPtFJUUP7zB8s?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
              </div>
            <li><h2>Your creations</h2></li>
            <li><h2>Make a post</h2></li>
        </ul>
    </div>

<?php
    include_once("footer.php");
?>

