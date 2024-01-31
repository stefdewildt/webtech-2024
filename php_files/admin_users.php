<?php

    include_once "header.php";
    require_once '/var/www/dbhInc.php';

    if($_SESSION['admin'] == false){
        header("Location: ../index.php");
        echo 'not admin';

    }

?>

<section class="posts">
    <h1>Admin: Friends</h1>
                <?php
                $sql = "SELECT * FROM users ORDER BY usersId DESC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo 'User Uid:  ' . $row['usersUid'] . '<br>';
                    echo 'Users Name:  ' . $row['usersName'] . '<br>';
                    echo 'Users Email: ' . $row['usersEmail'] . '<br><br>';



                    // Output  username boven de embed
                    echo '<form method="Post" action="includes/removeuserInc.php">';
                    echo '<input type="hidden" name="user_id" value="' . $row['usersId'] . '">';
                    echo '<button type="submit" name="remove_user">Remove User</button>';
                    echo '</form>';

                    echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                }
                ?>
            </section>