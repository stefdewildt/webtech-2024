<?php
  // include_once "header.php";
  require_once '/var/www/dbhInc.php';


if (isset($_POST['submit-search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    header("Location: user.php?id=$search");
    exit(); // Zorg ervoor dat het script stopt na het doorsturen
}

//   if (isset($_POST['submit-search'])){
//     header("location: $_POST['search']");

//   }
// profielen zoeken die overeenkomen met gegeven zoekterm 
// if (isset($_POST['submit-search'])){
//     $se
//     $search = mysql_real_escape_string($conn, $_POST['search']);
//     $sql = "SELECT * FROM users WHERE usersUid = $search";
//     $result = mysqli_query($conn, $sql);
//     $queryResult = mysqli_num_rows($result);
// }
// //profielen weergeven in vorm van link die overeenkomen met zoekterm 
//     if($queryResult > 0 ){

//         $row = mysqli_fetch_assoc($result);
        
//         header("Location: user.php?id={$row['userUid']}");
//         exit();
//     } else {
//         echo "There are no results matching your search";
//     }
// ?>   