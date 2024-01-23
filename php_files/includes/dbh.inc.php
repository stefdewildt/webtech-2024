<?php

$serverName ="localhost";
$dBUserName ="stefw";
$dBPassword ="cvttXSqCtrIsIuVRCnAHpyjdCYRVjzZJ";
$dBName ="phpproject01";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
