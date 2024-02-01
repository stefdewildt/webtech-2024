<?php
    include 'functionsInc.php';

// comment wordt toegevoegd aan de database
function setComment($conn, $postId){
    if (isset($_POST['commentSubmit'.$postId]) && $postId = $_POST['postId'] ){
        $usersId = $_POST['usersId'];
        $date = $_POST['date'];
        // $message = $_POST['message'];
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

        $postId = $_POST['postId'];
        
        // inserting into database
        $sql = "INSERT INTO comments (usersId, date, message, postId) VALUES ('$usersId', '$date', '$message', '$postId')";
        $result = $conn->query($sql);
        redirect('index.php');
    }
}

// comments worden uit de database gehaald en weergegeven in de website, hierbij worden ook de username en datum gepubliceerd
function getComments($conn, $postId) {

    // in de database gaan, al de comments die bij de postid horen verzamelen, en weergeven
    $sql = "SELECT * FROM comments WHERE postId='$postId' ORDER BY date ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $usersId = $row['usersId'];
        $sql2 = "SELECT usersUid FROM users WHERE usersId = $usersId";
        $result2 = $conn->query($sql2);
        if ($row2 = $result2->fetch_assoc()) {
            echo "<div class='comment-section'><p>";
            echo '<div class="username "><a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php?id='.$row2['usersUid'].'">@'.$row2['usersUid'].'</a></div><br>';
            echo "<div class='date'>" . $row['date'] . "</div><br><br>";

            // zorgen dat eventuele new lines er niet voor zorgen dat de structuur wordt aangetast
            echo "<div class='message'>" . nl2br($row['message']) . "</div>";

            // het is alleen mogelijk om je eigen comments te verwijderen
            echo "</p>";
            if (isset($_SESSION['usersId'])) {

                // huidige gebruiker wordt vergeleken met de eigenaar van de comment
                if (($_SESSION['usersId']) == ($usersId)){
                    echo "<form class= 'delete-form' method='POST' action='".deleteComments($conn)."'>
                    <input type='hidden' name='cid' value='".$row['cid']."'>
                    <button type='submit' name='commentDelete'>Delete</button>
                </form>";
                }

        
            }

        // het is alleen mogelijk om een comment te plaatsen als je bent ingelogd
        } else {
            echo "<p class= 'comment-message'>You need to be logged in to reply! </p>";
        }
            echo "</div>";
    } 
} 


// functionaliteit om comments te verwijderen
function deleteComments($conn){
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid='$cid'";
    $result = $conn->query($sql);
    redirect('index.php');
    }
}


ob_flush();
