<?php
    include_once "header.php";
    require_once '/var/www/dbhInc.php';
    include 'includes/commentsInc.php';

$sql = "SELECT usersImg FROM users WHERE usersId = $userid ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row["usersImg"] > 0){
    $imgnumber = $row["usersImg"];
    if ($imgnumber < 3){
    ++$imgnumber;
    } else {
        $imgnumber = 1;
    }
} else {
    $imgnumber = 1;
}
