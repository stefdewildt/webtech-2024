<?php
    date_default_timezone_set('Europe/Amsterdam');
    include 'includes/commentsInc.php';
    // include 'dbh.inc.php'; connection to database
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
<?php
echo "<form method='POST' action='".setComment($conn)."'>
    <input type='hidden' name='uid' value='anonymous'>
    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
    <textarea name='message'></textarea><br>
    <button type='submit' name='commentDelete'>Comment</button>
</form>";

getComments($conn);

?>
</body>
</html>
