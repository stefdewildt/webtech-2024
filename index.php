<?php
    include_once "php_files/header.php";
    require_once '/var/www/dbhInc.php';
    $sql = "SELECT * FROM music_posts ORDER BY postsTIMESTAMP DESC";
    $result = mysqli_query($conn, $sql);
?>
<head>
    <link rel="stylesheet" href="https://webtech-bg2.webtech-uva.nl/php_files/css_files/index_styles.css">
</head>
    
    <section class="scroll-section">
        <aside class="random-shi">
            <ul>
                <h3></h3>
                <li>hier zie ik dat hij iets heeft aangepast</li>
                <li>is</li>
                <li>just</li>
                <li>some</li>
                <li>random</li>
                <li>bs</li>
            </ul>
        </aside>

        <div class="scroll-part">
            <h2>Friends Listening</h2>
            <section class="posts">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Url " . $row['postsURL'] . "<br>";
                    echo "Hot take: " . $row['postsPOST'] . "<br>";
                    // Voeg andere velden toe zoals nodig
                    echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                }
                ?>
            </section>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
            cumque beatae inventore, exercitationem facilis, neque placeat minima atque 
            id nobis incidunt maiores temporibus maxime iure reprehenderit vitae saepe quod.</p>
            <p> Hallo</p>
        </div>

        <aside class="friends">
        <?php
        if (isset($_SESSION['usersId'])){
            $huidige_gebruiker_id = $_SESSION['usersId'];
            $query = "SELECT user_ID_2 FROM friends WHERE user_ID_1 = $huidige_gebruiker_id";
            $result = $conn->query($query);
            
            // Array om vrienden-ID's op te slaan
            $vrienden_ids = array();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $vrienden_ids[] = $row['user_ID_2'];
                }
            }
            
            // Als er vrienden zijn, haal hun gebruikersnaam, naam en profielfoto op
            if (!empty($vrienden_ids)) {
                $vrienden_ids_string = implode(",", $vrienden_ids);
                $query_vrienden_info = "SELECT usersName, usersUid FROM users WHERE usersId IN ($vrienden_ids_string)";
                $result_vrienden_info = $conn->query($query_vrienden_info);
            
            if (!empty($vrienden_ids) && $result_vrienden_info->num_rows > 0) {
                    while ($row_vriend = $result_vrienden_info->fetch_assoc()) {
                        echo "<div>";
                        echo "<p>Gebruikersnaam: " . $row_vriend['usersUid'] . "</p>";
                        echo "<p>Naam: " . $row_vriend['usersName'] . "</p>";
                        echo "</div>";
                        }
                    } else {
                    echo "Je hebt nog geen vrienden.";
                }  
            }
        }
        ?>

        </aside>

    </section>

<?php
    include_once("php_files/footer.php");
?>
