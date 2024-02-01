<?php
    include_once "header.php";
    require_once '/var/www/dbhInc.php';
    include 'includes/commentsInc.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>




<button attribute="1" onclick="togglePfp()</button> 

<script>
function togglePfp(userId, buttonElement) {
    $.ajax({
        type: 'POST',
        url: 'changepfp.php', // Het pad naar je PHP-script voor volgen
        data: { userId: userId },
        success: function(response) {
                buttonElement.innerText = 'Following';
            
        },
        error: function(error) {
            // Handel fouten af
            console.error('Fout bij het volgen van de gebruiker:', error);
        }
    });


    
}

