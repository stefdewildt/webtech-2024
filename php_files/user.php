<?php
    include_once "header.php";
    require_once '/var/www/dbhInc.php';

    

    // ingelogd met ID = USERUID
    if (isset($_GET['id']) && isset($_SESSION['useruid']) && $_GET['id'] == $_SESSION['useruid']){
        header('location: user.php');
    }

    // ID ingevoerd
    elseif (isset($_GET['id'])) {
        
        // input sanitization
        $escapedUsersUid = $conn->real_escape_string($_GET['id']);
        
        // Execute the SQL query
        $sql = "SELECT * FROM users WHERE usersUid = '$escapedUsersUid'";
        $result = $conn->query($sql);
        
        // GELDIG ID
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['usersUid'];
            $name = $row['usersName'];
            $email = null;
            $image = $row['usersImg'];  
            $userid = $row['usersId'];
        } 
        // ONGELDIG ID
        else {
            $username = null;
            $email = null;
            $name = null;
            $image = null;
        }
    }    
    // geen id ingevoerd maar wel ingelogd
    elseif (isset($_SESSION['useruid'])){
        $escapedUsersUid = $_SESSION['useruid'];
        $sql = "SELECT * FROM users WHERE usersUid = '$escapedUsersUid'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['usersUid'];
            $name = $row['usersName'];
            $email = $row['usersEmail'];
            $image = $row['usersImg'];  
        } 

    }
    // GEEN ID NIET INGELOGD
    else {
            header('location: login.php');
    }
?>

<head>
    <link rel="stylesheet" href="css_files/user_page.css">
</head>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <div class="pd-row">
        <?php
        if ( $image == null) {
            echo '<img src="img/profile.png">';
            echo '<form action="/includes/uploadImgInc.php" method="post" enctype="multipart/form-data">
            <label for="userImg">Upload Profile Picture:</label>
            <input type="file" name="userImg" id="userImg" accept="image/*">
            <input type="submit" value="Upload">';
        } elseif ($image != null) {
            echo '<img src="'.$image.'">';
        }


        ?>
        <!-- <img src="img/profile.png">
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="profile_picture">Upload Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
        <input type="submit" value="Upload"> -->
</form>

        <div>
            <?php if ( isset($email) ) { ?>

                <h3>Name: <?php echo $name?></h3>
                <h3>Username: <?php echo $username?></h3>
                <h3>Email:<?php echo $email?></h3>
            <?php } elseif (isset($username)) {?>
                <h3>Name: <?php echo $name?></h3>
                <h3>Username: <?php echo $username?></h3>
            <?php } else { ?>
                <h3>User not found</h3>
            <?php } ?>

            <nav>
                <a href="/html/friends.html">120 friends</a>
            </nav> 
        </div>


    <?php
    
    if (isset($_GET['id']) && $_GET['id'] != $_SESSION['useruid']) {
        $knownUsersUid = $_GET['id'];
        $other_user_id_query = "SELECT usersId FROM users WHERE usersUid = '$knownUsersUid'";
        $result_other_user_id = $conn->query($other_user_id_query);

    if ($result_other_user_id && $result_other_user_id->num_rows > 0) {
        $row_other_user_id = $result_other_user_id->fetch_assoc();
        $other_user_id = $row_other_user_id['usersId'];

        $huidige_gebruiker_id = $_SESSION['usersId'];

        // Check of de gebruikers elkaar al volgen
        $query_follow_check = "SELECT * FROM friends WHERE user_ID_1 = $huidige_gebruiker_id AND user_ID_2 = $other_user_id";
        $result_follow_check = $conn->query($query_follow_check);

        $following = $result_follow_check->num_rows > 0;
    } else {
        // Gebruiker niet gevonden met de opgegeven gebruikersnaam
        //echo "Gebruiker niet gevonden.";
    }
    }

    ?>


        <div>

        <?php if (isset($_GET['id']) && isset($username) && $_GET['id'] != $_SESSION['useruid']) { ?>
                <button onclick="toggleFollowUser(<?php echo $other_user_id; ?>, this)"> <?php echo $following ? 'Following' : 'Follow'; ?></button> 
        <?php }?>
            </div>     
    </div>

    <div class="profile-posts">
        <!-- <ul class="profile-post">
            <li><h2>Your favourites</h2></li>
              <div class="chosen-music">
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/1HAW56e0zz05phUnzuHF9E?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/2ut4BOQSqxLpcX5MtPjzYa?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/37Tmv4NnfQeb0ZgUC4fOJj?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3Um9toULmYFGCpvaIPFw7l?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
                  <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3MyQn1xBQwPtFJUUP7zB8s?utm_source=generator" width="100%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>
              </div>
            <li><h2>Your creations</h2></li>
            <li>
                <h2>Make a post:</h2>
                <form action="includes/uploadInc.php" class ="discussion-input" method="post">
                    <input type="text" name ="url" placeholder ="Paste Spotiy URL here"><br>
                    <input type="text" name ="post" placeholder = "Start a conversation"><br><br>
                    <button type="Submit" name="submit">Submit Hot Take</button>
                </form>
            </li> -->
            <section class="posts">
                    <?php
                    if (isset($_GET['id']) ){
                        $userpostid = $userid;
                    } elseif (isset($_SESSION['usersId'])){
                        $userpostid($_SESSION['usersId']);
                    }


                    $sql = "SELECT * FROM big_posts WHERE user_id = $userpostid ORDER BY postsTIMESTAMP DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
                        $result_user = mysqli_query($conn, $sql);
                        $user_row = mysqli_fetch_assoc($result_user);
                        $username = $user_row['usersUid'];

                        // Output  username boven de embed
                        echo "<div class=comment></div>";
                        echo '<a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php?id='.$username.'">@'.$username.'</a><br>';
                        echo '<h3>'.$row['postsURL'] . "</h3><br>";
                        // echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
                        
                        // Output de post onder de embed
                        echo htmlspecialchars($row['postsPOST'], ENT_QUOTES, 'UTF-8');
                        echo "</div";
                        echo "<hr>"; 

                        // Voeg andere velden toe zoals nodig
                        echo"<form method='POST' action='".setComment($conn,$row['postsID'])."'>
                        <input type='hidden' name='usersId' value='".$_SESSION['usersId']."'>
                        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                        <input type='hidden' name='postId' value='".$row['postsID']."'>
                        <textarea name='message'></textarea><br>
                        <button type='submit' name='commentSubmit".$row['postsID']."'>Comment</button>
                        </form>";
                        getComments($conn, $row['postsID']);
                        echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                    }
                    ?>
            </section>


        
        </ul>
    </div>

    <script>

    function toggleFollowUser(userId, buttonElement) {
    // Controleer de huidige status van de gebruiker
    var isFollowing = buttonElement.innerText.toLowerCase() == 'following';

    // Voer de juiste actie uit op basis van de status
    if (isFollowing) {

        // Gebruiker is al aan het volgen, voer de unfollow-functie uit
        unfollowUser(userId, buttonElement);
    } else {
        // Gebruiker volgt nog niet, voer de follow-functie uit
        followUser(userId, buttonElement);
    }
}

    // JavaScript functie om een gebruiker te volgen
    function followUser(userId, buttonElement) {
        $.ajax({
            type: 'POST',
            url: 'follow_user.php', // Het pad naar je PHP-script voor volgen
            data: { userId: userId },
            success: function(response) {
                    buttonElement.innerText = 'Following';
                
            },
            error: function(error) {
                // Handel fouten af
                console.error('Fout bij het volgen van de gebruiker:', error);
            }
        });
        
      //  alert("Nu volg je deze gebruiker!");
    }

    // JavaScript functie om een gebruiker te ontvolgen
    function unfollowUser(userId, buttonElement) {
        $.ajax({
            type: 'POST',
            url: 'unfollow_user.php', // Het pad naar je PHP-script voor ontvolgen
            data: { userId: userId },
            success: function(response) {
                    buttonElement.innerText = 'Follow';

            },
            error: function(error) {
                // Handel fouten af
                console.error('Fout bij het ontvolgen van de gebruiker:', error);
            }
        });
        
       // alert("Nu ontvolg je deze gebruiker!");
    }
       
</script>

<?php
    include_once("footer.php");
?>

