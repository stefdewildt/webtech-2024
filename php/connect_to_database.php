<?php
$conn = mysqli_connect("localhost", 'isah', 'PycUNdyahurjWaWBDautaFGcSeUqTISw', "imgupload");
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<?php
    
    
    $sql = "SELECT * users";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $id = $row['userId'];
            $sqlimg = "SELECT * FROM profileimg WHERE userid='$id'";
            $ResultImg = mysqli_query($conn, $sqlimg);

          
            while ($rowImg=mysqli_fetch_assoc($ResultImg)){
                echo "<div>";
                    if($rowImg['status']==0){
                        echo "<img src='uploads/profile".$id.".jpg";
                    } else {
                        echo "<img src='bennie.jpg'>";
                    }
                    echo "<p>"$row['username'];
                echo"</div>";
            }
        }
    } else { 
        echo "there are no users yet";
    }


    if (isset($_SESSION['id'])) {
        if ($_SESSION['id'] == 1) {
            echo "YOU are logged in as user #1";
        }
        echo "<form action ='upload.php' method='POST' enctype='multipart/form-data'>
            <input type='file' name='file'>
            <button type='submit' name='submit'>UPLOAD</button>
        </form> ";
    } else {
        echo "you are not logged in";
        echo "<form action ='login.php' method='POST'>
        <input type ='text' name ='first' placeholder='First name'>
        <input type ='text' name ='last' placeholder='Last name'>
        <input type ='text' name ='uid' placeholder='Username'>
        <input type ='text' name ='pwd' placeholder='Password'>
        <button type='submit' name='submitSignup>Signup</button>
        </form>";
    }
?>

        <p>Login as user!<p>
        <form action="login.php" method="POST">
            <button type="submit" name="submitlogin">Login</button>
        </form>

        <p>Logout as user!<p>
        <form action="logout.php" method="POST">
            <button type="submit" name="submitlogout">Logout</button>
        </form>
    <body>
</html>
