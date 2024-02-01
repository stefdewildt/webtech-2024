
<?php
    include_once "../header.php";
    require_once '/var/www/dbhInc.php';




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["userImg"])) {
    $target_dir = "https://webtech-bg2.webtech-uva.nl/php_files/img/";  // create a folder named "uploads" to store profile pictures
    $target_file = $target_dir . basename($_FILES["userImg"]["name"]);
    $uploadvalid = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["userImg"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadvalid = 0;
    }


    // Check file size (adjust as needed)
    if ($_FILES["userImg"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadvalid = 0;
    }

    // Allow certain file formats (you can add more formats)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadvalid = 0;
    }

    if ($uploadvalid == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move the uploaded file to the designated folder
        if (move_uploaded_file($_FILES["userImg"]["tmp_name"], $target_file)) {
            // Update the database with the file path

            $user_id = $_SESSION['usersId'];  // Assuming you have a user_id stored in the session
            $file_path = $target_file;

            $query = "UPDATE users SET usersImg = '$file_path' WHERE id = $user_id";
            $db->query($query);
            $db->close();

            echo "The file " . basename($_FILES["userImg"]["name"]) . " has been uploaded and set as your profile picture.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Invalid request.";
} 