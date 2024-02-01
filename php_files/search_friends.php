<?php
 
  require_once '/var/www/dbhInc.php';

//voer if-statement uit als er op de knop 'submit-search' wordt gedrukt 
if (isset($_POST['submit-search'])) {

    //Escapen van de zoekterm om SQL-injecties te voorkomen
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    //verstuur locatie naar opgezochte userpagina
    header("Location: user.php?id=$search");
    exit(); 
}

?>