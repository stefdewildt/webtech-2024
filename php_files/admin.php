<?php
    include_once "header.php";
    require_once '/var/www/dbhInc.php';
?>

<head>
    <link rel="stylesheet" href="css_files/admin.css">
</head>


    <div >
        <div class=adminlinks>
            <nav>
                <a href="php_file/admin_hottakes.php">Hot-Takes</a>
                <a href="php_file/admin_users.php">Users</a>
                <a href="php_file/admin_posts.php">Posts</a>                
            </nav> 
        </div>        
    </div>

<?php
    include_once("footer.php");
?>

