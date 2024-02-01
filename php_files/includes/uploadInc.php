<?php

if (isset($_POST["submit"])){
    
    // gesanitizede url
    $url = filter_input(INPUT_POST, "url", FILTER_SANITIZE_STRING);

    // gesanitizede post
    $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_STRING);

    $table = $_POST['table'];

    echo "URL: " . $url . "<br>";
    echo "Post: " . $post . "<br>";


    require_once '/var/www/dbhInc.php';
    require_once 'functionsInc.php';
    session_start();
    $user_id = $_SESSION['usersId'];

    // statement die kijkt of het om een hot take of een big post gaat
    if($table == 'music_posts') {
        if (validSpotify($url) !== false) {
        createPost($conn, $url, $post, $user_id, $table);
        } else {
            header('location: ../../index.php?error=invalidurl');
        }
    } else if($table == 'big_posts') {
        createPost($conn, $url, $post, $user_id, $table);
    }
} else {
    header("location: ../../index.php");
    exit();
}