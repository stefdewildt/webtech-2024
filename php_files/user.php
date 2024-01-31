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
            $username = $_SESSION['useruid'];
            $email = $_SESSION['useremail'];
            $name = $_SESSION['username'];
            $image = $_SESSION['image'];
            }
    else {// GEEN ID NIET INGELOGD
            header('location: login.php');
        

    }

    if (isset($_GET['id']) || (isset($_SESSION['useruid']) && $_GET['id'] != $_SESSION['useruid']) ){
        $knownUsersUid = $_GET['id'];
        
        // Use the mysqli real_escape_string function for basic input sanitization
        $escapedUsersUid = $conn->real_escape_string($knownUsersUid);
        
        // Execute the SQL query
        $sql = "SELECT * FROM users WHERE usersUid = '$escapedUsersUid'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['usersUid'];
            $name = $row['usersName'];
            $email = null;
            $image = $row['usersImg'];
        
            // Display the user details
            
        } else {
            $username = null;
            $email = null;
            $name = null;
        }
    } elseif (isset($_SESSION['useruid'])) {
    $username = $_SESSION['useruid'];
    $email = $_SESSION['useremail'];
    $name = $_SESSION['username'];
    $image = $_SESSION['image'];
    }
?>

<head>
    <link rel="stylesheet" href="css_files/user_page.css">
</head>


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

        <div>
        <?php if (isset($_GET['id']) && isset($_SESSION['useruid'])) : ?>
            <?php if ($following) : ?>
                <button onclick="unfollowUser(<?php echo $row['usersId']; ?>)">Unfollow</button> 
            <?php else : ?>
                <button onclick ="followUser(<?php echo $row['usersId']; ?>)">Follow</button>
            <?php endif; ?>
        <?php endif; ?>
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
            <li>
                <h2>Make a post:</h2>
                <form action="includes/uploadInc.php" class ="discussion-input" method="post">
                    <input type="text" name ="url" placeholder ="Paste Spotiy URL here"><br>
                    <input type="text" name ="post" placeholder = "Start a conversation"><br><br>
                    <button type="Submit" name="submit">Submit Hot Take</button>
                </form>
            </li>
        </ul>
    </div>

    <script>
    // JavaScript functie om een gebruiker te volgen
    function followUser(userId) {
        $.ajax({
            type: 'POST',
            url: 'follow_user.php', // Het pad naar je PHP-script voor volgen
            data: { userId: userId },
            success: function(response) {
                // Verwerk de respons indien nodig
                alert(response);
            },
            error: function(error) {
                // Handel fouten af
                console.error('Fout bij het volgen van de gebruiker:', error);
            }
        });
        
        alert("Nu volg je deze gebruiker!");
    }

    // JavaScript functie om een gebruiker te ontvolgen
    function unfollowUser(userId) {
        $.ajax({
            type: 'POST',
            url: 'unfollow_user.php', // Het pad naar je PHP-script voor ontvolgen
            data: { userId: userId },
            success: function(response) {
                // Verwerk de respons indien nodig
                alert(response);
            },
            error: function(error) {
                // Handel fouten af
                console.error('Fout bij het ontvolgen van de gebruiker:', error);
            }
        });
        
        alert("Nu volg je deze gebruiker!");
    }
       
</script>

<?php
    include_once("footer.php");
?>

