window.addEventListener('load', (event) => {
    // Dit gebeurd nu bij het inladen van de pagina, je kunt dit natuurlijk ook doen met het klikken van een knop
    // hierdoor kun je dus op je pagina informatie inladen, door een knop te gebruiken etc.
    inladenvoorbeeld();
});

function inladenvoorbeeld()
{
    $.ajax({    
        type: "POST",
        url: "assets/php/inladen.php",
        data: {},   
        dataType:"json",           
        success: function(data){
            // Dit is het html object, waarin je de ingeladen data wilt toevoegen
            // Het is handig als dit een flexbox is, maar dat hoeft natuurlijk niet
            // https://css-tricks.com/snippets/css/a-guide-to-flexbox/
            let voorbeeldbox = document.getElementById("inladenbox");

            // Haal de informatie van het template op
            let template = document.getElementById("voorbeeldtemplate").innerHTML;

            // Vervolgens doe je een for loop door de opgehaalde data van de database
            // En voor elk element, voeg je het toe aan de pagina
            data.forEach(dataElement =>{
                // Maak een nieuwe div aan, en zet daarin de inhoud van je template
                let newproduct = document.createElement("div");
                newproduct.innerHTML = template;
                // Pas aan wat je wilt, je kunt de ids van de clone aanpassen
                newproduct.querySelector("#productnaam").innerHTML = dataElement.naam
                newproduct.querySelector("#prijs").innerHTML = dataElement.prijs
                // Je kunt ook bijvoorbeeld dynamisch een knop zijn on click zetten, hierdoor kun je voor elk product een andere functie aanroepen
                newproduct.querySelector("#voorbeeldknop").onclick = function() {
                    console.log("De prijs van dit product is: ", dataElement.prijs);
                };
                // Met deze regel voeg je het gemaakte template toe aan de voorbeeldbox (wat bijvoorbeeld een flexbox is)
                voorbeeldbox.append(newproduct);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Status: ' + textStatus);
            console.log('Error: ' + errorThrown);
            console.log(jqXHR);
        }
    });
}
