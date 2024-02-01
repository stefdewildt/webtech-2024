<?php
  include_once "header.php";
  require_once '/var/www/dbhInc.php';

    $usersUid= $_GET['id'];
    $usersId = "SELECT usersId FROM users WHERE usersUid = '$usersUid'";
   
    $query_find_friends = "SELECT * FROM friends where user_ID_1 = $usersId";
    $result_find_friends = $conn->query($query_find_friends);

    $counter = $result_find_friends->num_rows 

    echo $counter

  ?>
