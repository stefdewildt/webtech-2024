<?php
    require_once '/var/www/dbhInc.php';
    include 'includes/commentsInc.php';
    ob_start();
    include_once "header.php";



    

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
            $userid = $row['usersId'];
        } 

    }
    // GEEN ID NIET INGELOGD
    else {
            header('location: login.php');
    }
    ob_flush();

?>

<head>
    <link rel="stylesheet" href="https://webtech-bg2.webtech-uva.nl/php_files/css_files/user_page.css">
</head>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <div class="pd-row">
 

        <!-- <div class='personal_info'> -->
            <?php if ( isset($email) ) { ?>

                <h3><?php echo $name."<br>"?></h3>
                <p><?php echo '@'.$username. "<br>"?></p>
                <p><?php echo $email."<br>"?></p>

            <?php } elseif (isset($username)) {?>
                <h3><?php echo $name."<br>"?></h3>
                <p><?php echo '@'.$username. "<br>"?></p>

            <?php } else { ?>
                <h3>User not found<br></h3>
            <?php } ?>

            <nav>
                 <span id ="counter"> Following: 
                    <?php   
                            $usersUid= $username;
                            $usersId = "SELECT usersId FROM users WHERE usersUid = '$usersUid'";
                            $result_usersId = $conn->query($usersId);

                            if ($result_usersId->num_rows>0){
                            $rowUserId = $result_usersId->fetch_assoc();
                            $usersId = $rowUserId['usersId'];

                            $query_find_friends = "SELECT * FROM friends where user_ID_1 = $usersId";
                            $result_find_friends = $conn->query($query_find_friends);

                            $counter = $result_find_friends->num_rows;

        
                            echo $counter;
                        } 
                            else {
        
                                echo 'Could not find following';
                                    } ?> 
    
                                        Followers:   
                    <?php 
                            $usersUid= $username;
                            $usersId = "SELECT usersId FROM users WHERE usersUid = '$usersUid'";
                            $result_usersId = $conn->query($usersId);

                            if ($result_usersId->num_rows>0){
                            $rowUserId = $result_usersId->fetch_assoc();
                            $usersId = $rowUserId['usersId'];

                            $query_find_friends = "SELECT * FROM friends where user_ID_2 = $usersId";
                            $result_find_friends = $conn->query($query_find_friends);

                            $counter = $result_find_friends->num_rows;

                            echo $counter;
                            }
                            else {
        
                                echo 'Could not find following';
                                    } ?> 
                </span>
            </nav> 
    </div>


    <?php
    if ((isset($_GET['id'])) && isset($_SESSION['useruid'])) {
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

    <div class="posts">

            <section class="friends">
                    <?php if (isset($username)){
                        // if (isset($_GET['id']) ){
                        //     $userpostid = $userid;
                        // } else {
                        //     $userpostid($_SESSION['usersId']);
                        // }


                        $sql = "SELECT * FROM big_posts WHERE user_id = $userid ORDER BY postsTIMESTAMP DESC";
                        $result = mysqli_query($conn, $sql);
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['user_id'];
                            $sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
                            $result_user = mysqli_query($conn, $sql);
                            $user_row = mysqli_fetch_assoc($result_user);
                            $username = $user_row['usersUid'];

                            echo "<div class='bigpost'>";
                            // Output  username boven de embed
                            echo "<div class=comment></div>";
                            echo '<a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php?id='.$username.'">@'.$username.'</a><br>';
                            echo '<h3>'.$row['postsURL'] . "</h3><br>";
                            // echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
                            
                            // Output de post onder de embed
                            echo $row['postsPOST'];
                            echo "</div";
                            echo "<hr>"; 
                            
                            getComments($conn, $row['postsID'],'user.php');

                            // Voeg andere velden toe zoals nodig
                            echo"<form method='POST' action='".setComment($conn,$row['postsID'],'user.php')."'>
                            <input type='hidden' name='usersId' value='".$_SESSION['usersId']."'>
                            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                            <input type='hidden' name='postId' value='".$row['postsID']."'>
                            <textarea name='message'></textarea><br>
                            <button type='submit' name='commentSubmit".$row['postsID']."'>Comment</button>
                            </form><br><br>";
                            echo "</div>";
                            echo "<br><br>";
                        }
                    }
                    ?>
            </section>


        
        </ul>
    <!-- </div> -->

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

