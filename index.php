<?php
    include_once "php_files/header.php";
    require_once '/var/www/dbhInc.php';
    include 'php_files/includes/commentsInc.php';

?>
<head>
    <link rel="stylesheet" href="/php_files/css_files/index_styles.css">
</head>
    
    <section class="scroll-section">


        <div class="scroll-part">
            <?php if (isset($_SESSION["usersId"])) { ?>
                <h2>Post Your Hot Take!</h2>
                <form action="php_files/includes/uploadInc.php" class ="discussion-input" method="post">
                    <input type="text" name ="url" placeholder ="Paste or drag URL here..."><br>
                    <input type="text" name ="post" maxlength="150" placeholder = "Hot Take..."><br><br>
                    <input type="hidden" name="table" value="music_posts">
                    <button type="Submit" name="submit">Submit Hot Take</button>
                </form>
            <?php }?>
            <h2>Hot Takes</h2>
            <section class="posts">
                <?php
                $sql = "SELECT * FROM music_posts ORDER BY postsTIMESTAMP DESC";
                $result = mysqli_query($conn, $sql);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
                    $result_user = mysqli_query($conn, $sql);
                    $user_row = mysqli_fetch_assoc($result_user);
                    $username = $user_row['usersUid'];

                    // Output  username boven de embed
                    echo '@'.$username . "<br>";
            

                    if (strpos($row['postsURL'], 'embed') !== true) {
                        $modifiedURL = str_replace('.com/', '.com/embed/', $row['postsURL']);
                    } else {
                        $modifiedURL = $row['postsURL'];
                    }

             // Voorkomen dat er teveel requests naar spotify gaan

      //              echo '<iframe style="border-radius: 12px" src="' . $modifiedURL . '" width="100%" height="100" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>';


                    // echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
                    
                    // Output de post onder de embed
                    echo htmlspecialchars($row['postsPOST'], ENT_QUOTES, 'UTF-8');
                    // Voeg andere velden toe zoals nodig
                    echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                }
                ?>
            </section>
        </div>

        <aside class="friends">
            
                
            <!-- Big Posts -->
                
            <?php if (isset($_SESSION["usersId"])) { ?>
                <form action="php_files/includes/uploadInc.php" class ="discussion-input" method="post">
                        <input type="text" name ="url" placeholder ="Write a title here..."><br>
                        <input type="text" name ="post" placeholder = "Big post..."><br><br>
                        <input type="hidden" name="table" value="big_posts">
                        <button type="Submit" name="submit">Submit Hot Take</button>
                </form>

                <section class="posts">
                    <?php
                    $sql = "SELECT * FROM big_posts ORDER BY postsTIMESTAMP DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
                        $result_user = mysqli_query($conn, $sql);
                        $user_row = mysqli_fetch_assoc($result_user);
                        $username = $user_row['usersUid'];

                        // Output  username boven de embed
                        echo "<div class=comment></div>";
                        echo '@'.$username ."<br>";
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
                
            <?php } else {?>
            <h3><a href=/php_files/login.php>Log in here to see your friends' posts!</a></h3>


            <?php }?>
            <ul>
            <?php
        if (isset($_SESSION['usersId'])){
            $huidige_gebruiker_id = $_SESSION['usersId'];
            $query = "SELECT user_ID_2 FROM friends WHERE user_ID_1 = $huidige_gebruiker_id";
            $result = $conn->query($query);
            
            // Array om vrienden-ID's op te slaan
            $vrienden_ids = array();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $vrienden_ids[] = $row['user_ID_2'];
                }
            }
            
            // Als er vrienden zijn, haal hun gebruikersnaam, naam en profielfoto op
            if (!empty($vrienden_ids)) {
                $vrienden_ids_string = implode(",", $vrienden_ids);
                $query_vrienden_info = "SELECT usersName, usersUid FROM users WHERE usersId IN ($vrienden_ids_string)";
                $result_vrienden_info = $conn->query($query_vrienden_info);
            
            if (!empty($vrienden_ids) && $result_vrienden_info->num_rows > 0) {
                    while ($row_vriend = $result_vrienden_info->fetch_assoc()) {
                        echo "<div>";
                        echo "<p>Gebruikersnaam: <a href='profile_friend.php?id=" . $row_vriend['usersUid'] . "'>".$row_vriend['usersUid'] . "</a></p>";
                        echo "<p>Naam: " . $row_vriend['usersName'] . "</p>";
                        echo "</div>";
                        }
                    } else {
                    echo "<div>";
                    echo "Je hebt nog geen vrienden.";
                    echo "<div>";
                }  
            }
        }
        ?>
            </ul>
        </aside>

    </section>

<?php
    include_once("php_files/footer.php");
?>
