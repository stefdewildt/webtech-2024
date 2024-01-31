<?php
    date_default_timezone_set('Europe/Amsterdam');
    include 'includes/commentsInc.php';
    include_once "header.php";
    require_once '/var/www/dbhInc.php';
?>

<!-- space for the post -->
<!-- start comment section -->
<!-- makes sure you have to be logged in to be able to comment -->
<br><br>
<?php
    if (isset($_SESSION['usersId'])) {
        echo "<form method='POST' action='".setComment($conn)."'>
        <input type='hidden' name='usersId' value='".$_SESSION['id']."'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message'></textarea><br>
        <button type='submit' name='commentSubmit'>Comment</button>
    </form>";
    } else {
        echo "You need to be logged in to comment!
        <br><br>";
    }

   

getComments($conn);

?>
</body>
</html>
