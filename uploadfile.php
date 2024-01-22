<?php

if(isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName= $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)){
        if ($fileError ===0){
            if($fileSize < 10000000){
                $fileNameNew = iniqid('', true)."."."$fileActualExt";
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploades_file($fileTmpName, $fileDestination);
                header("Location: add_profile_pic_test.php?uploadsuccess");
                echo "your file has been uploaded!";
            } else {
                echo "your file is too big!";
            }
        } else {
            echo "There was an error uploading your file";
        }

    } else {
        echo "you cannot upload files of this type";
    }
}

    session_start();
    include_once 'connect_to_database.php';
?> 
