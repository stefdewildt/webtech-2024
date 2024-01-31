<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        button[follow="false"]::before {
            content: "Follow";
        }

        button[follow="true"]::before {
            content: "Unfollow";
        }
    </style>
</head>
<body>

<button id="follow-1" follow="true" onclick="toggleFollow()">Follow</button>

<script>
    function toggleFollow() {
        const button = document.getElementById("follow-1");

        // Simulating an AJAX request using jQuery
        $.ajax({
            url: 'your-server-endpoint',  // Replace 'your-server-endpoint' with the actual server endpoint
            method: 'GET',  // Adjust the HTTP method based on your server's requirements
            dataType: 'json',  // Assuming the server responds with JSON
            success: function(data) {
                const response = data.followed;  // Adjust this based on your actual server response

                // Set the 'follow' attribute based on the response
                button.setAttribute("follow", response);

                // Change the text inside the button based on the 'follow' attribute
                button.textContent = response ? "Unfollow" : "Follow";
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>

</body>
</html>
