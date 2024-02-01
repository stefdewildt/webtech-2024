<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Like Button Example</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<button class= 'likebutton'> Like </button> 
<span class ='like-count'>0</span> 
</body> 
    </html>


<?php

//posts laden (wordt al gedaan maar ik snap niks van die code dus nu maar even zo)
foreach($posts as $post)

// id van de post vaststellen 
$post_id = $post["id"]

$query= "SELECT COUNT(*) AS likes FROM ratings WHERE $post_id AND status = 'like'"
$result = mysqli_query($conn, $query)
$likes_count = mysqli_fetch_assoc($result)['likes']

$status = mysqli_query($conn, "SELECT status FROM ratings WHERE post_id = $post_id AND user_id = $user_id");
if(mysqli_num_rows($status)>0){
    $status = mysqli_fetch_assoc($status)['status'];

}else{
    $status = 0;
}
?>























<!-- 
<script> 
    $(document).ready(function() {
        $(".likebutton").on("click", function() {

            var postId = $(this).closest("'.post").data("post-id");

            $.ajax({ 
                type: 'POST'
                url: 'like_button.php'
            })
        

            
            // Voeg hier je like-logica toe, bijvoorbeeld een AJAX-oproep naar de server
            alert("Bedankt voor het liken!");
        });
    });


</script>
<script> 
function unfollowUser(userId, buttonElement) {
        $.ajax({
            type: 'POST',
            url: 'unfollow_user.php', // Het pad naar je PHP-script voor ontvolgen
            data: { userId: userId },
            success: function(response) {
                    buttonElement.innerText = 'Follow';

            },
            error: function(error) {
                // Handel fouten af
                console.error('Fout bij het ontvolgen van de gebruiker:', error);
            }
        });
        
       // alert("Nu ontvolg je deze gebruiker!");
    }
    </script> -->