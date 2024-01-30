<?php
    date_default_timezone_set('Europe/Amsterdam');
    include 'includes/commentsInc.php';
    include_once "header.php";
    require_once '/var/www/dbhInc.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Comments</title>
<!-- <link rel=stylesheet type="text/css" href="style.css"> -->
</head>

<body>

<!-- space for the post -->
<!-- start comment section -->
<!-- makes sure you have to be logged in to be able to comment -->
<br><br>
<?php
    if (isset($_SESSION['id'])) {
        echo "<form method='POST' action='".setComment($conn)."'>
        <input type='hidden' name='uid' value='anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message'></textarea><br>
        <button type='submit' name='commentDelete'>Comment</button>
    </form>";
    } else {
        echo "You need to be logged in to comment!
        <br><br>";
    }

   

getComments($conn);

?>
</body>
</html>
