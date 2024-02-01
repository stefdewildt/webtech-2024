<?php
include_once "header.php";
require_once '/var/www/dbhInc.php';
include_once 'includes/functionsInc.php';

//controleer of gebruiker is ingelogd

if (isset($_SESSION['usersId'])){
	//eigen id opvragen
	$user_ID_1 = $_SESSION['usersId'];
} else{
//keer terug naar inlogpagina
	redirect("login.php");
	exit();
}
?>
<head>
    <link rel="stylesheet" href="https://webtech-bg2.webtech-uva.nl/php_files/css_files/friends_styles.css">
</head>


<div class='followings'>
<h3> Following </h3>

	<?php

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
	}
	?>
</div>



<div class='followings'>
<h3> Followers </h3>
<?php
$sql = "SELECT user_ID_1 FROM friends WHERE user_ID_2 = $user_ID_1";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	$user_id = $row['user_ID_1'];
	$sql = "SELECT usersUid FROM users WHERE usersId = $user_id";
	$result_user = mysqli_query($conn, $sql);
	$user_row = mysqli_fetch_assoc($result_user);
	$username = $user_row['usersUid'];

	// Output  username boven de embed
	echo "<div class=comment></div>";
	echo '<a href="https://webtech-bg2.webtech-uva.nl/php_files/user.php?id='.$username.'">@'.$username.'</a><br>';
} 
?>
</div>

<?php
    include_once("footer.php");
?>
