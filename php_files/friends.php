<?php
include_once "header.php";
require_once '/var/www/dbhInc.php';

//controleer of gebruiker is ingelogd

if (isset($_SESSION['usersId'])){
	//eigen id opvragen
	$user_ID_1 = $_SESSION['usersId'];
} else{
//keer terug naar inlogpagina
	header("Location: login.php");
	exit();
}


echo '<h3> Following </h3>';
$sql = "SELECT user_ID_2 FROM friends WHERE user_ID_1 = $user_ID_1";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$user_id = $row['user_ID_2'];
	$sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
	$result_user = mysqli_query($conn, $sql);
	$user_row = mysqli_fetch_assoc($result_user);
	$username = $user_row['usersUid'];

	// Output  username boven de embed
	echo "<div class=comment></div>";
	echo '<a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php?id='.$username.'">@'.$username.'</a><br>';
	// echo '<h3>'.$row['postsURL'] . "</h3><br>";
	// echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
	
	// Output de post onder de embed
	// echo htmlspecialchars($row['postsPOST'], ENT_QUOTES, 'UTF-8');
	// echo "</div";
	// echo "<hr>"; 

	// // Voeg andere velden toe zoals nodig
	// echo"<form method='POST' action='".setComment($conn,$row['postsID'])."'>
	// <input type='hidden' name='usersId' value='".$_SESSION['usersId']."'>
	// <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
	// <input type='hidden' name='postId' value='".$row['postsID']."'>
	// <textarea name='message'></textarea><br>
	// <button type='submit' name='commentSubmit".$row['postsID']."'>Comment</button>
	// </form>";
	// getComments($conn, $row['postsID']);
	echo "<hr>"; // Voeg een scheidingsteken toe tussen records
}

echo '<h3> Followers </h3>';
$sql = "SELECT user_ID_1 FROM friends WHERE user_ID_2 = $user_ID_1";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$user_id = $row['user_id'];
	$sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
	$result_user = mysqli_query($conn, $sql);
	$user_row = mysqli_fetch_assoc($result_user);
	$username = $user_row['usersUid'];

	// Output  username boven de embed
	echo "<div class=comment></div>";
	echo '<a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php?id='.$username.'">@'.$username.'</a><br>';
	// echo '<h3>'.$row['postsURL'] . "</h3><br>";
	// echo $row['username'] . ": " . $row['postsPOST'] . "<br>";
	
	// Output de post onder de embed
	// echo htmlspecialchars($row['postsPOST'], ENT_QUOTES, 'UTF-8');
	// echo "</div";
	// echo "<hr>"; 

	// // Voeg andere velden toe zoals nodig
	// echo"<form method='POST' action='".setComment($conn,$row['postsID'])."'>
	// <input type='hidden' name='usersId' value='".$_SESSION['usersId']."'>
	// <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
	// <input type='hidden' name='postId' value='".$row['postsID']."'>
	// <textarea name='message'></textarea><br>
	// <button type='submit' name='commentSubmit".$row['postsID']."'>Comment</button>
	// </form>";
	// getComments($conn, $row['postsID']);
	echo "<hr>"; // Voeg een scheidingsteken toe tussen records
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

include_once "footer.php";
?>