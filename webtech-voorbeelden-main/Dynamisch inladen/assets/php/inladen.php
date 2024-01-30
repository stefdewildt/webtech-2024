<?php
// maak een bestand aan, met je connectie info dit kun je ook terugvinden op w3schools op de volgende link
// https://www.w3schools.com/php/php_mysql_connect.asp
include("databaseconnectie.php");

// De functie, die de query uiteindlijk uitvoert, dit is een functie, dus hij word niet uitgevoerd als het bestand runt.
function select_all_products(){
  // Let op deze variabele komt uit databaseconnectie.php, pas dit dus aan gebasseerd op jouw connectie
  global $conn;
  // Maak hier je query aan, dit kan van alles zijn. Pas hem aan naar wens en zodat die werkt met jouw database
  // In dit geval, word elke rij van de tabel product opgehaald (hierdoor haal je dus meerdere producten op)
  $query = "SELECT * FROM `webtech`.`product`";

  // maak de query klaar
  $stmt = $conn->prepare($query); 
  // Uitvoeren van de query
  $stmt->execute();
  // Ophalen van het resultaat van de query
  $result = $stmt->get_result(); 
  // Hiermee zet je het resultaat om naar een array
  $data = [];
  // Haal elke keer een rij op, en voeg die toe aan de data array, tot er niks meer op te halen is
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  // Close je aangemaakte connectie met de database
  $conn->close();
  // Print de data, zodat je ermee kunt werken in de ajax success
  if($data){
    print json_encode($data);
  }else{
    print json_encode([]);
  }
}

select_all_products();
?>