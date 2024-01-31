<?php
 require_once '/var/www/dbhInc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Voeg hier de logica toe om de gebruiker te volgen in de database
    // (bijv. voeg een nieuwe rij toe aan de friends-tabel)

    $query_check_follow = "SELECT * FROM friends WHERE user_ID_1 = $huidige_gebruiker_id AND user_ID_2 = $userId";
    $result_check_follow = $conn->query($query_check_follow);

    if ($result_check_follow->num_rows == 0) {
        // Voeg vrienden toe aan een vriendenlijst
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

