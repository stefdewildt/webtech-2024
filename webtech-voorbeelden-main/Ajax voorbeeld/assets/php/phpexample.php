<?php
// maak een bestand aan, met je connectie info dit kun je ook terugvinden op w3schools op de volgende link
// https://www.w3schools.com/php/php_mysql_connect.asp
include("databaseconnectie.php");
// De functie, die de query uiteindlijk uitvoert, dit is een functie, dus hij word niet uitgevoerd als het bestand runt.
// Hij word pas beneden echt uitgevoerd in de if statement van isset
function user_select_query($username, $password){
  // Let op deze variabele komt uit databaseconnectie.php, pas dit dus aan gebasseerd op jouw connectie
  global $conn;
  // Maak hier je query aan, dit kan van alles zijn. Pas hem aan naar wens en zodat die werkt met jouw database
  // Je kunt hier ook ipv een select, een insert gebruiken, zodat je bijv bij registeren data in je database zet
  // Let ook op dat je dit veilig doet, een wachtwoord wil je normaal dus niet zo op deze manier afhandelen (hashen, encrypten/decrypten etc), 
  // dit is echt ALLEEN een voorbeeld
  $query = "SELECT * FROM `webtech`.`user` WHERE username = ? AND password = ?"; // De vraagtekens, stellen je parameters voor

  // maak de query klaar
  $stmt = $conn->prepare($query); 
  // Hiermee geef je de parameters waardes (de vraagtekens in je query, krijgen dus de waardes van username en password)
  // ss staat voor string, string. als je andere datatypes hebt, moet je dit dus aanpassen
  $stmt->bind_param("ss", $username, $password);
  // Uitvoeren van de query
  $stmt->execute();
  // Ophalen van het resultaat van de query
  $result = $stmt->get_result(); 
  // Hiermee haal je het eerste resultaat op, dus als het een array is (meerdere rows, haal je hiermee alleen de eerste row op)
  $data = $result->fetch_assoc();
  // Close je aangemaakte connectie met de database
  $conn->close();
  // Return de data
  if($data){
    return $data;
  }else{
    return [];
  }
}

// Bekijk of de variabelen gezet zijn, in javascript hierdoor voorkom je query errors
// username en password zijn dus gezet in ajaxeample.js op regel 19 en 20
if (isset($_POST['username']) && isset($_POST['password'])) {
  $data = user_select_query($_POST['username'], $_POST['password']);
  // dit ziet er raar uit, maar je echo'd (print) het in php waardoor het in javascript eindigt
  // hiermee geef je dus de data uit user_select_query terug aan javascript
  // Vervolgens kom je in javascript in de success op regel 22 en verder
  print json_encode($data);
}
?>