<?php
  include_once "header.php";
  require_once '/var/www/dbh.inc.php';

// Gebruikersgegevens ophalen op basis van de gebruikers-ID uit de URL
$usersId = $_GET['usersUid'];
$sql = "SELECT * FROM users WHERE usersId";
$result = mysqli_num_rows($conn, $sql);

// Profielgegevens weergeven
echo 'Gebruikersnaam: ' . $user['usersName'] . '<br>';
echo 'E-mail: ' . $user['usersEmail'] . '<br>';

// Knop "Volgen" toevoegen
echo '<form method="post" action="link_vrienden.php">';
echo '<input type="hidden" name="volg_id" value="' . $user['usersId'] . '">';
echo '<input type="submit" value="Volgen">';
echo '</

?>phalen op basis van de gebruikers-ID uit de URL
$usersId = $_GET['usersId'];
$sql = "SELECT * FROM users WHERE usersId";
$result = mysqli_num_rows($conn, $sql);



// Profielgegevens weergeven
echo 'Gebruikersnaam: ' . $user['usersName'] . '<br>';
echo 'E-mail: ' . $user['usersEmail'] . '<br>';

// Knop "Volgen" toevoegen
echo '<form method="post" action="link_vrienden.php">';
echo '<input type="hidden" name="volg_id" value="' . $user['usersId'] . '">';
echo '<input type="submit" value="Volgen">';
echo '</

?>