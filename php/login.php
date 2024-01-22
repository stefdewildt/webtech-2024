<?php
    include_once('header.php');
?>

    <section class="login-form">
        <h2>Log in</h2>
        <div class="login-form-form">
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username/Email...">
                <input type="password" name="pwd" placeholder="Password...">
                / ik heb hier een line toegevoegd voor het toevoegen van een profielfoto dit lijkt me niet de uiteindelijke locatie maar voor nu doe ik t ff zo 
                <input type="file" name="photo" placeholder="Add profile picture...">
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
