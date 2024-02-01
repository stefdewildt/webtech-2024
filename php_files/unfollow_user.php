
<?php
    
    include_once "header.php";
    require_once '/var/www/dbhInc.php';

    //Haal opgestuurde gegevens op 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //maak variabele $userid voor de user die bekeken wordt
    //maak variabele $huidige_gebruiker_id voor user die ingelogd is
    $userId = $_POST['userId'];
    $huidige_gebruiker_id = $_SESSION['usersId'];

    //verwijder de rij uit tabel friends waar $huidige_gebruiker_id $userId volgt  
    $query_unfollow_user = "DELETE FROM friends WHERE (user_ID_1 = $huidige_gebruiker_id AND user_ID_2 = $userId)";
    $result_unfollow_user = $conn->query($query_unfollow_user);
        
        if ($result_unfollow_user === TRUE) {
            echo 'Gebruiker is nu ontvolgd!';
        } else {
            echo 'Fout bij het volgen van de gebruiker: ' . $conn->error;
        }
    } else {
    // Onjuist verzoeksmethode
    http_response_code(405);
    echo 'Onjuiste verzoeksmethode';
}

?>
