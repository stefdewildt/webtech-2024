
<head>
    <link rel="stylesheet" href="/~wietskeb/webtech-2024/php_files/css_files/index_styles.css">
</head>
<?php

// adding comments to database
function setComment($conn, $postId){
    if (isset($_POST['commentSubmit'.$postId]) && $postId = $_POST['postId'] ){
        $usersId = $_POST['usersId'];
        $date = $_POST['date'];
        $message = $_POST['message'];
        $postId = $_POST['postId'];

        // inserting into database
        $sql = "INSERT INTO comments (usersId, date, message, postId) VALUES ('$usersId', '$date', '$message', '$postId')";
        $result = $conn->query($sql);
    }
}

// getting comments from database to be able to show on website 
function getComments($conn, $postId) {

    // go into database , get all the comments, run the query and show them (result)
    $sql = "SELECT * FROM comments WHERE postId='$postId' ORDER BY date ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $usersId = $row['usersId'];
        $sql2 = "SELECT usersUid FROM users WHERE usersId = $usersId";
        $result2 = $conn->query($sql2);
        if ($row2 = $result2->fetch_assoc()) {
            echo "<div class='comment-section'><p>";
            echo "<div class='username'>@" . $row2['usersUid'] . "</div>";
            echo "<div class='date'>" . $row['date'] . "</div><br><br>";

            // checking for new line tags and make it into line breaks
            echo "<div class='message'>" . nl2br($row['message']) . "</div>";

            // able to delete your own comments
            echo "</p>";
            if (isset($_SESSION['usersId'])) {

                // current user comparing to user who made the comment
                if (($_SESSION['usersId']) == ($usersId)){
                    echo "<form class= 'delete-form' method='POST' action='".deleteComments($conn)."'>
                    <input type='hidden' name='cid' value='".$row['cid']."'>
                    <button type='submit' name='commentDelete'>Delete</button>
                </form>";
                }

            } else {
                echo "<form class= 'reply-form' method='POST' action='".deleteComments($conn)."'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                    <button type='submit' name='commentDelete'>Reply</button>
                </form>";
            }

        } else {
            echo "<p class= 'comment-message'>You need to be logged in to reply! </p>";
        }
            echo "</div>";
    } 
} 


// how to make sure you can't delete other people's comments im not sure........ this only makes sure you can delete comments
function deleteComments($conn){
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid='$cid'";
    $result = $conn->query($sql);
    //header("Location: index.php");
    redirect('index.php');
    }
}

function getLogin($conn) {
    if (isset($_POST['loginSubmit'])){

        // initializing variables
        $usersId = $_POST['usersId'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM user WHERE usersId='$usersId' AND pwd='$pwd'";
        $result = $conn->query($sql);

        // counts the amount of comments
        if (mysqli_num_rows($result) > 0){

            // if there's data it will be stored inside variable 'row'
            if ($row = $result->fetch_assoc()) {
                $_SESSION['id'] = $row['id'];
                
                // tells status of what just happened...?
                header("Location: index.php?loginsuccess");
                exit();
            }
        } else{
            header("Location: index.php?loginfailed");
            exit();
        }
    }      
}


