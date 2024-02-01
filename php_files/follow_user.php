<?php
    include_once "header.php";
    require_once '/var/www/dbhInc.php';

    //Haal opgestuurde gegevens op 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //maak variabele $userid voor de user die bekeken wordt
    //maak variabele $huidige_gebruiker_id voor user die ingelogd is
    $userId = $_POST['userId'];
    $huidige_gebruiker_id = $_SESSION['usersId'];

    //maak query die beide userids op dezelfde rij opzoekt in friends
    $query_check_follow = "SELECT * FROM friends WHERE user_ID_1 = $huidige_gebruiker_id AND user_ID_2 = $userId";
    $result_check_follow = $conn->query($query_check_follow);

    //als de de huidige gebruiker ($huidige_gebruiker_id) nog geen volger is van de opgezochte gebruiker ($userId) wordt if-statements uitgevoerd
    if ($result_check_follow->num_rows == 0) {
        // insert $huidige_gebruiker_id op plek user_ID_1 en $userId op plek user_ID_2
        $query_follow_user = "INSERT INTO friends (user_ID_1, user_ID_2) VALUES ($huidige_gebruiker_id, $userId)";
        
        if ($conn->query($query_follow_user) === TRUE) {
            echo 'Gebruiker is nu gevolgd!';
        } else {
            echo 'Fout bij het volgen van de gebruiker: ' . $conn->error;
        }
    } else {
        echo 'Je volgt deze gebruiker al.';
    }
} else {
    // Onjuist verzoeksmethode
    http_response_code(405);
    echo 'Onjuiste verzoeksmethode';
}

?>