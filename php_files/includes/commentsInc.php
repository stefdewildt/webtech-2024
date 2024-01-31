<?php

// adding comments to database
function setComment($conn){
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        // inserting into database
        $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
        $result = $conn->query();
    }
}

// getting comments from database to be able to show on website 
function getComments($conn) {
    $sql = "SELECT * FROM comments";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div class='comment-section'><p>";
            echo $row['uid']. "<br><br>";
            echo $row['date']. "<br><br>";

            // checking for new line tags and make it into line breaks
            echo nl2br($row['message']);

        // able to delete a comment
        echo "<form class= 'delete-form' method='POST' action='".deleteComments($conn)."'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <button type='submit' name='commentDelete'>Delete</button>
            </form>
        </div>";
    }
}

// how to make sure you can't delete other people's comments im not sure........ this only makes sure you can delete comments
function deleteComments($conn){
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid='$cid'";
    $result = $conn->query($sql);
    header("Location: index.php");
    }
}

function getLogin($conn) {
    if (isset($_POST['loginSubmit'])){

        // initializing variables
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$pwd'";
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


