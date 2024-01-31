<?php

    include_once "header.php";
    require_once '/var/www/dbhInc.php';

?>

<section class="posts">
    <h1>Admin: Hot-takes</h1>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
                    $result_user = mysqli_query($conn, $sql);
                    $user_row = mysqli_fetch_assoc($result_user);
                    $username = $user_row['usersUid'];

                    // Output  username boven de embed
                    echo $username . "<br>";
            

                    if (strpos($row['postsURL'], 'embed') !== true) {
                        $modifiedURL = str_replace('.com/', '.com/embed/', $row['postsURL']);
                    } else {
                        $modifiedURL = $row['postsURL'];
                    }
                    echo '<iframe style="border-radius: 12px" src="' . $modifiedURL . '" width="100%" height="100" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>';


                    // echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
                    
                    // Output de post onder de embed
                    echo htmlspecialchars($row['postsPOST'], ENT_QUOTES, 'UTF-8');
                    // Voeg andere velden toe zoals nodig
                    echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                }
                ?>
            </section>