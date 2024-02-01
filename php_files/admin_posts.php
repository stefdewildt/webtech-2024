<?php

    include_once "header.php";
    require_once '/var/www/dbhInc.php';

    if(isset($_SESSION['admin']) == false || $_SESSION['admin'] !== 1 ){
        header("Location: ../index.php");

    }


?>

<section class="posts">
    <h1>Admin: posts</h1>
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
                    echo $username . "<br>";
                    echo $row['postsURL'];
                    

                    // echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
                    
                    // Output de post onder de embed
                    echo htmlspecialchars($row['postsPOST'], ENT_QUOTES, 'UTF-8');
                    // Voeg andere velden toe zoals nodig

                    echo '<form method="Post" action="includes/removehtInc.php">';
                    echo '<input type="hidden" name="post_id" value="' . $row['postsID'] . '">';
                    echo '<button type="submit" name="remove_post">Remove Post</button>';
                    echo '</form>';

                    echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                }
                ?>
            </section>