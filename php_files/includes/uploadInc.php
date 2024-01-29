<?php

if (isset($_POST["submit"])){
    
    $url = $_POST["url"];
    $post = $_POST["post"];
    echo "URL: " . $url . "<br>";
    echo "Post: " . $post . "<br>";


    require_once '/var/www/dbhInc.php';
    require_once 'functionsInc.php';

    // if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
    //     header("location: ../signup.php?error=emptyinput");
    //     exit();
    // }
    // if (invalidUid($username) !== false) {
    //     header("location: ../signup.php?error=invaliduid");
    //     exit();
    // }
    // if (invalidEmail($email) !== false) {
    //     header("location: ../signup.php?error=invalidemail");
    //     exit();
    // }
    // if (pwdMatch($pwd, $pwdRepeat) !== false) {
    //     header("location: ../signup.php?error=passwordsdontmatch");
    //     exit();
    // }
    // if (uidExists($conn, $username, $email) !== false) {
    //     header("location: ../signup.php?error=usernametaken");
    //     exit();
    // }
    createPost($conn, $url, $post);

}

else{
    header("location: ../user.php");
    exit();
}