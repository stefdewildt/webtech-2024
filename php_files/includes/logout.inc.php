<?php 

    //vernietig de session
    session_start();
    session_unset();
    session_destroy();

    header('location:  https://webtech-bg2.webtech-uva.nl/~stefw/nieuw/webtech-2024/index.php');

