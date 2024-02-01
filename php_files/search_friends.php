<?php
  include_once "header.php";
  require_once '/var/www/dbh.inc.php';

//profielen zoeken die overeenkomen met gegeven zoekterm 
if (isset($_POST['submit-search'])){
    $search = mysql_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM users WHERE usersUid = $search";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);
}
//profielen weergeven in vorm van link die overeenkomen met zoekterm 
    if($queryResult > 0 ){

        $row = mysqli_fetch_assoc($result);
        
        header("Location: user.php?id={$row['userUid']}");
        exit();
    } else {
        echo "There are no results matching your search";
    }
?>   