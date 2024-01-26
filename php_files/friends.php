<?php
    include_once "header.php";
?>

<?php

require_once '/var/www/dbh.inc.php';

//controleer of gebruiker is ingelogd

if (isset($_SESSION['usersId'])){
	//eigen id opvragen
	$user_ID_1 = $_SESSION['usersId'];
} else{
//keer terug naar inlogpagina
	header("Location: login.php");
	exit();
}


//haal de vriend-ID op uit het formulier 
//het zou kunnen dat regel 19 nog niet werkt 
if (!empty($_POST['volg_id'])) {
	$user_ID_2 = 'volg_id';
	//voeg vrienden toe aan een vriendenlijst
	$sql = "INSERT INTO friends (user_ID_1, user_ID_2) VALUES ('$user_ID_1', '$user_ID_2')";
}
if ($conn->query($sql) === TRUE) {
    echo "Vrienden succesvol gelinkt!";
} else {
    echo "Fout bij het linken van vrienden: " . $conn->error;
}

?>




<?php
    include_once "footer.php";
?>