
// Dit gebeurd wanneer de pagina geladen is, je kunt dus oook ipv dit bijvoorbeeld de functie op een button zetten, zodat alles gebeurd dmv een button press ipv een pagina inladen
// Tips voor alles laten werken dmv een button vind je op https://www.w3schools.com/jsref/event_onclick.asp
// Dan zet je dus haalinformatieop() etc op die button.
window.addEventListener('load', (event) => {
    // Dit zou welke functie dan ook kunnen zijn, die uitgevoerd word wanner je de pagina opkomt
    // Hierin wil je dus bijvoorbeeld, bepaalde informatie van de database ophalen voor op je pagina
    // Ik gebruik hier de paramater "username" en "password", dit kan ook bijvoorbeeld een userid zijn of wat je ook mee wilt geven aan de database
    // Deze informatie kun je dus ook uit je pagina halen door bijv
    // gebruikersnaam = document.getElementById("naamInput").value;
    haalinformatieop("gebruikersnaam", "wachtwoord");
});

function haalinformatieop(username, password)
{
    // Hierin willen jullie gewooon type POST gebruiken
    // de url refereert naar het php script die je wilt gebruiken
    // data kan van alles zijn, dit is een json. Dus je kan het zien als een soort dicionary, het is alle data die jij nodig hebt in php
    // je kan daarin voor een login dus bijvoorbeeld, de username en het wachtwoord meegeven
    $.ajax({    
        type: "POST",
        url: "assets/php/phpexample.php",
        data: { "username": username,
                "password": password},   
        dataType:"json",           
        success: function(data){ // Success betekent dat het php script gelukt is, je komt dus hier wanneer alles goed gegaan is
            // data is hierin de informatie die je uit de database gehaald hebt
            // Dit is in php ge encode naar een json, je kunt data dus aanspreken met de namen van je database query
            // Dus alle kolommen die je uit je tabel gehaald hebt, kun je dmv data aanspreken
            // Je kunt in deze functie dan bijvoorbeeld een attribuut zijn innerhtml aanpassen naar de database data, zodat je bijv een profiel zijn info kunt inladen en laten zien
            console.log(data) // Gebruik dit om te kijken wat je terugkrijgt

            // Vaak om het juiste eruit te halen wil je iets zoals dit doen
            console.log(data.username) //kijk dus eerst goed in je console, wat data bevat om dit passend te maken

            // Een voorbeeld om je pagina aan te passen met de info die je uit de database haalt is als volgt
            // document.getElementById("gebruikersprofielnaam").innerHTML = data.username;
        },
        // Error is wanneer het mis is gegaan
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Status: ' + textStatus);
            console.log('Error: ' + errorThrown);
            console.log(jqXHR);
        }
    });
}
