<?php
    include_once('header.php');
?>
<header>
    <link rel="stylesheet" href="https://webtech-bg2.webtech-uva.nl/php_files/css_files/login.css">
</header>
    <section class="login-form">
        <h2>Log in</h2>
        <div class="login-form-form">
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username/Email...">
                <input type="password" name="pwd" placeholder="Password...">
                <br>
                <button type="Submit" name="submit">Log in</button>
            </form>
        </div>
        <?php 
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                }
                else if ($_GET["error"] == "wronglogin"){
                    echo "<p>Incorrect login information!</p>";
                }
            }
        ?>
    </section>

<?php
    include_once('footer.php');
?>
