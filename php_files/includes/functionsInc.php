<?php
// zorgt ervoor dat redirect werkt als de header al is gestuurd,
// inspiratie van Stackoverflow
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

// als een van de signupslots niet gevuld is, wordt false gereturned.
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result; 
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

// functie die checkt bij de username of geldige tekens ingevoerd worden
function invalidUid($username){
    $result; 
    if (!preg_match("/^[a-zA-Z0-9_-]*$/", $username)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

// idem boven, dit ook om injectie van code te voorkomen
function invalidName($name){
    $result; 
    if (!preg_match("/^[a-zA-Z]*$/", $name)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

// functie die door ingebouwde php functie checkt of email valide is
function invalidEmail($email){
    $result; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

// functie overgenomen van internet, om te checken of spotify url valide is
function validSpotify($string) {
    return strpos(strtolower($string), 'spotify.com') !== false;
}

// functie die controleert of de password en de repeated password met elkaar matchen.
function pwdMatch($pwd, $pwdRepeat){
    $result; 
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email){
    // Deze functie controleert of er al een gebruiker in de database bestaat met dezelfde gebruikersnaam of hetzelfde e-mailadres
    //returnt false als die niet bestaat, de row van gevonden user als die wel bestaat. 
    // stmt is om sql injectie te voorkomen
    // gecontroleerd of er geen error komt van dat statement.
    $sql = "SELECT * FROM users WHERE usersUid = ? OR  usersEmail= ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result =false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function createUser($conn, $name, $email, $username, $pwd){
    // functie insert de opgegeven parameters in de database
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    // password wordt hier gehashed, zo is niet duidelijk wat het wachtwoord is uit de database
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

// als een van de twee velden leeg is, geeft deze functie error, anders false
function emptyInputLogin($username, $pwd){
    $result; 
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

// deze functie log de user in
function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    // check of user bestaat
    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    // verificatie van wachtwoord dmv ingebouwde php functie 
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    // de password check
    if($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    // de sessie wordt gestart, sessienamen worden hier gemaakt
    else if($checkPwd === true){
        session_start();
        $_SESSION["admin"] = $uidExists["admin"];
        $_SESSION["usersId"] = $uidExists["usersId"];
        $_SESSION["username"] = $uidExists["usersName"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["useremail"] = $uidExists["usersEmail"];
        $_SESSION["image"] = $uidExists["usersImg"];
        header("location: https://webtech-bg2.webtech-uva.nl/index.php");
        exit();
    }

}

// functie die post maakt, idem aan createUser maar dan voor een post
function createPost($conn, $url, $post, $user_id, $table){
    $sql = "INSERT INTO $table (postsURL, postsPOST, user_id) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssi", $url, $post, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../index.php?error=none");
    exit();  
}