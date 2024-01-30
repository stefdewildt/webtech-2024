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
                <li>this</li>
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
                    // echo "Url " . $row['postsURL'] . "<br>";
                    $hottakeid = $row['user_id'];
                    $sql = "SELECT usersUid FROM users WHERE usersId = $hottakeid";
                  //  $result_user = mysqli_query($result, $sql);
                   // $user_row = mysqli_fetch_assoc($result_user);
                    $username = $conn->query($sql);
                    
                    echo $username;

                    if (strpos($row['postsURL'], 'embed') !== true) {
                        $modifiedURL = str_replace('.com/', '.com/embed/', $row['postsURL']);
                    } else {
                        $modifiedURL = $row['postsURL'];
                    }
                    echo '<iframe style="border-radius: 12px" src="' . $modifiedURL . '" width="100%" height="100" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br>';


                    echo "Hot take: " . $row['postsPOST'] . "<br>";
                    // Voeg andere velden toe zoals nodig
                    echo "<hr>"; // Voeg een scheidingsteken toe tussen records
                }
                ?>
            </section>
            <p>Test Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione iste 
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
            <ul>
                <h2>Friends</h2>
                <li>Stef</li>
                <li>Wietske</li>
                <li>Jelle</li>
                <li>Tim</li>
                <li>Isa</li>
            </ul>
        </aside>

    </section>

<?php
    include_once("php_files/footer.php");
?>
