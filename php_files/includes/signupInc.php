<?php

if (isset($_POST["submit"])){
    
    // ophalen van namen uit de form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    // connectie met database en connectie met functies
    require_once '/var/www/dbhInc.php';
    require_once 'functionsInc.php';

    // functies worden aangeroepen, elke functie spreekt voor zich en staat voor een 
    // bepaalde soort error.
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidName($name) !== false) {
        header("location: ../signup.php?error=invalidname");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    createUser($conn, $name, $email, $username, $pwd);

}

else{
    header("location: ../signup.php");
    exit();
}