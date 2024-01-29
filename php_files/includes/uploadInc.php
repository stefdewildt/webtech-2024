<?php

if (isset($_POST["submit"])){
    
    //$url = $_POST["url"];
    $url = filter_input(INPUT_POST, "url", FILTER_SANITIZE_STRING);

    //$post = $_POST["post"];
    $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_STRING);

    echo "URL: " . $url . "<br>";
    echo "Post: " . $post . "<br>";


    require_once '/var/www/dbhInc.php';
    require_once 'functionsInc.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if (validSpotify($url) !== false) {

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
    createPost($conn, $url, $post, $user_id);
    } else {
        header('location: ../user.php');
    }
}
else{
    header("location: ../user.php");
    exit();
}