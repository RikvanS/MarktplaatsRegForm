Gebruikers registratie systeem. Ten eerste, creeër een tabel users in je database met volgende command.

ID is de primary key met auto increment, username met variabel aantal karakters max 50 moet ingevuld en moet uniek zijn.
Wachtwoord wederom variabele hoeveelheid karakters met max 255, moet ingevuld.
Laatste entry is een timestamp die aangeeft wanneer de account is aangemaakt.

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

Hierna een config file aanmaken om de connectie met de mysql database te leggen:

Eerste segment voer je de gegevens in van de database waaraan het gekoppeld moet worden. Daarna leg je de link via het $link commando, als de link niet tot stand komt
return je een error, anders kun je verder.

<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

Volgende stap is het daadwerkelijk creeeren van een registratie formulier.
Mijn project begint hier, het maken van een registratie formulier.

Gebruikte tutorials/bronnen:

https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

Informatie re: password hashing:
https://auth0.com/blog/hashing-passwords-one-way-road-to-security/

Uitleg over de veelvuldig gebruikte mysqli class:
http://php.net/manual/en/book.mysqli.php en http://php.net/manual/en/class.mysqli.php

----------

15:50 review/debug moment:

Local host controle geeft een werkend, gestyled registratie formulier.
Proberen een lege invoer te submitten geeft correcte fouten weer op de juiste plek.
Echter komt een error naar voren : Notice: Undefined variable: link in C:\xampp\htdocs\Registration form\register.php on line 92

De $link var die voor problemen zorgt wordt gedefinieerd in de config.php, die is echter voor testdoeleinden momenteel weg gecomment in de register.php

Voor verdere controle/debug en om product mooier op te leveren, volgende stap is aanmaken van een lokale DB en koppeling te leggen.

config.php include comment weer verwijderd voor verdere test. Returnde hierna een boolean error op 2 lijnen, om uit te kunnen zoeken wat error precies was in config.php de lijn mysqli report toegevoegd. (zie https://phpdelusions.net/mysqli/error_reporting)
Error bleek te gaan om een verwijzing op lijn 19, probleem met de link legging tussen db en form. Verwijzingen gecheckt en correct gelegd.

Naar login.php wordt doorverwezen bij succesvolle aanmelding, pagina aangemaakt met een simpele echo om aan te tonen dat het werkt.

-----------

23/10 11:29

Toegevoegd: Login pagina. Code wederom van https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
Eigen notities toegevoegd aan code om begrip/beheersing van code te tonen.
Momenteel verwijst de welcome pagina nog naar een placeholder pagina. Na voltooiing login page daarmee bezig.

Op het moment van schrijven is er nog geen log uit functie/mogelijkheid, zolang de sessie behouden blijft verwijst de login knop dus de facto naar de placeholder welcome pagina. Dit wordt later verholpen dmv een logout pagina met een session destroy commando.

---------
11:50
Linkdump van aanpassingen en notities bij login pagina volgt hieronder.

Uitleg over sessions: http://php.net/manual/en/session.examples.basic.php
login start met session_start(), dit is vereist om een sessie te starten om login functionaliteit te realiseren. 

login functionaliteit hergebruikt een deel van de registratie code: de checks om te zien of info correct is ingevuld en of er überhaupt iets is ingevuld.

Daaronder bij validate credentials wordt er gekeken of username error en password error allebei leeg zijn (geen fouten bij invoer). Zo ja, zijn ze beide correct ingevuld. Hierna wordt via een $sql commando een query gedraaid op de gekoppelde database.

(Note: gebruik van de mysqli statements en parameters in het volgende blok code gaat momenteel nog iets aan mijn kennis voorbij. Ik begrijp dat het data uit de database op een manier oppakt dat de verdere scripts kunnen draaien, echter is dit een punt waar ik nog meer over moet leren om volledig begrip te garanderen. Leerdoel voor deze week)

Als de ingevoerde gegevens kloppen met de gegevens in de database wordt er een nieuwe sessie gestart met loggedin = true en wordt de gebruiker doorverwezen naar de welcome.php pagina. Als de gegevens niet kloppen wordt er een error weergegeven.

---------

13:10:
Welcome pagina toegevoegd. Wederom code van tutorialspoint gebruikt. Sessie wordt wederom gestart bovenin, als de sessie geen loggedin true heeft wordt gebruiker doorverwezen naar login.php.
De pagina zelf bestaat uit een verlkoming die de in de sessie actieve gebruikersnaam echo'd (Afgevangen met htmlspecialchars tegen scripting risico) met daaronder een button die linkt naar de reset password pagina en de logout pagina. Deze bestaan beide momenteel nog niet, dit wordt de volgende stap.
Login.php en welcome.php zijn beide deprecated, placeholder files die niet langer nodig zijn door aanmaken van correcte pagina's. Voor volledigheid niet uit repo verwijderd.

--------

13:17:
Logout pagina toegevoegd. Logout bestaat slechts uit een $_session = array() (Dit unset alles wat er in de $_session array staat) commando en een session destroy (Zoals naam doet vermoeden, vernietig huidige sessie.) en verwijst daarna door naar de login pagina.
Sluit af met een exit, zie http://php.net/manual/en/function.exit.php voor verdere uitleg over exit.

Vereist verder geen uitleg, volgende stap volgt hieronder

-------

13:21:
Reset password pagina toegevoegd.
Hier komt veel eerder gebruikte code terug:
Session start weer als begin, zoals vereist. Daarna een check of de gebruiker ingelogd is en zo niet wordt deze doorverwezen naar de login.php pagina.

Het config.php bestand wordt hierna aangeroepen, om de link met de database te leggen.
Variabelen worden leeg gestart.

Hierna volgt de validatie van het nieuwe password. Als het veld leeg is wordt gevraagd om het nieuwe password. Als de string length minder dan 6 is wordt de error dat er minstens 6 karakters nodig zijn gegeven en anders wordt het nieuwe password opgeslagen in de $new_password variabele.

Hierna wordt de confirm van het nieuwe password aangeroepen, wederom moet het veld niet leeg zijn. Als het veld niet leeg is wordt het opgeslagen in de $confirm_password variabele.
Daarna wordt gekeken of newpassworderror leeg is EN new_password niet overeenkomt met confirm password. In dat geval (er is wel iets ingevuld maar het komt niet overeen) wordt er een error weergegeven dat de passwords niet overeen komen.

Hierna volgt de check op fouten voordat er iets aan de database wordt gewijzigd. Als new_password_err en confirm_password_err leeg zijn (Wat enkel gebeurt als er geen fouten zijn) wordt er een $sql commando ingevoerd. De database wordt geupdatet, het password wordt overschreven.
Hier wordt weer gebruik gemaakt van de $stmt (statement) en $param, zoals eerder vermeld is hiervan mijn kennis nog niet voldoende om te kunnen reproduceren/volledig uit te leggen, echter begrijp ik dat dit de daadwerkelijke aanpassing van de database is.

Voor de oefening zal ik hieronder zo goed mogelijk proberen te extrapoleren wat er precies gebeurt:

$stmt wordt ingesteld met een mysqli_prepare (zie http://php.net/manual/en/mysqli.prepare.php) met de link en sql variabelen. De link variabele wordt ingesteld in ons config bestand 
(/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);) 
en de $sql variabele is verder terug in de code ingesteld, in dit geval als 
($sql = "UPDATE users SET password = ? WHERE id = ?";)

Kort gezegd: $stmt bevat het voorbereidend werk voor de link met de database.

Hierna, op lijn 46 en 47, worden variabelen aan de statement verbonden. 
(http://php.net/manual/en/mysqli-stmt.bind-param.php)

De "si" kan ik op dit moment nog niet plaatsen, hier kom ik later op terug!

De param_password en param_id variabelen zijn op dit moment in de code nog niet gedefinieerd, hier worden ze slechts verbonden aan de mysqli statement.

Gelijk hierna worden de parameters vastgesteld:
$param_password is een password_hash (Beveiligs voorzorg, zie eerdere uitleg in readme) die bestaat uit het eerder ingevulde $new_password. De password_default slaat op het soort hash dat gebruikt wordt, zie 
(http://php.net/manual/en/function.password-hash.php)

De param_id is de session_id. De param_id wordt aangeroepen in de $sql statement en moet dus een waarde krijgen.
zie (http://php.net/manual/en/function.session-id.php)

Hierna probeert het script de hierboven aangemaakte statement uit te voeren. Als alles goed is ingevuld en werkt wordt het password in de database aangepast, de sessie vernietigd (aangezien er op dat moment ingelogd is met een ander password) en de gebruiker doorverwezen naar de login pagina. Daarna sluit dmv exit(); het script.

-----------------

15:04
https://www.tutorialrepublic.com/php-tutorial/php-mysql-prepared-statements.php

Extra uitleg over prepared statements

---------------

16:15 - finish:
Begin gemaakt met welkomstpagina. Topnavs verwijzen naar de php pagina's.

To-do voor volgende keer:
main page afmaken. Styling overeen laten komen met log-in/registreer pagina's voor uniformiteit.

------------

24-10 mini update:

Voor betere styling over de verschillende pagina's is het wenselijk om op elke pagina dezelfde topnav te plaatsen, al dan niet met dezelfde links (Link naar login/registreer vanaf login en registreer pagina's is overbodig, de link naar home daarentegen essentieel.)
Dit effect heb ik in mijn portfolio ook al met succes gebruikt, kan ik dus gemakkelijk kopieren en overbrengen. Zorgt voor een meer uniform aanvoelend geheel, in de huidige vorm voelen de signup/login pagina's als willekeurige losstaande pagina's.

Main page is momenteel nog erg kaal, voor presenteer doeleinden is het wellicht wenselijk om een grid met afbeeldingen te plaatsen voor een impressie van hoe een final product eruit komt te zien. Tevens goede oefening met grids.

Beginnend onderzoek gedaan naar een zoekfunctie, na het opleveren van een presentabele splash pagina is dit de volgende stap. De gekoppelde database bestaat momenteel alleen nog maar uit een inlog database, voor presenteren van een werkende zoekfunctie is het wellicht wenselijk om een vooraf gepopuleerde mini DB aan te maken met producten oid. 

Re: de gisteren genoemde "si" die ik niet kon plaatsen: Refereert aan wat er in de parameter is ingevuld. In het geval van si gaat het om een string en een integer, ging het om meerdere strings werd per string een s gebruikt (bijv wijzigen van naam adres woonplaats ipv password zou in de mysqli statement bind parameter een $stmt, "sss", etc gebruikt worden)

------------

26/10 13:10:
Topnavs toegevoegd aan registratie, login en welkom pagina. Momenteel zit er nog redundancy in de navs, in een final version moet als de user ingelogd is de log-in vervangen worden door een logout. Bij de welkomstpagina de login en registratie links verwijderd, als gebruiker al ingelogd is is het niet logisch om deze nog weer te geven.
Tevens zou in een final version als de gebruiker ingelogd is de login knop op de splash page vervangen kunnen/moeten worden door een "mijn persoonlijke omgeving" knop. Aangezien deze functionaliteit (de mijn persoonlijke omgeving) nog niet bestaat en mijns inziens het beste met toegevoegde javascript functionaliteit kan worden gerealiseerd (Hiden danwel displayen van inhoud afhankelijk van een staat) wordt dit gepostponed tot een latere versie.

13:50:

Footer toegevoegd aan main page en sub-pages. Styling levert enigszins een probleem, de footer fixen aan de onderkant van de pagina dmv position absolute bottom 0 werkt op de kleinere sub-pagina's echter op de main page plakt dit de footer vast midden in de tekst. Makkelijkste oplossing is waarschijnlijk de footer een andere class meegeven op de subpagina's, en zo stylen naar de pagina, echter zou dit waarschijnlijk mooier/eleganter moeten kunnen. Gezien de tijdsdruk nu eerst de quick fix pushen en een note maken om later opnieuw naar te kijken.

14:20:
Topnav en footers correct gestyled toegevoegd aan alle pagina's, inclusief de reset pass pagina (bijna gemist). Hierdoor is in ieder geval het aangeleverde product een coherent, kloppend geheel.

Tot oplevertijd (15:00) staat de zoekfunctie op het programma. Product zoals het nu is is presentabel en uniform, meeste toegevoegde waarde komt door een werkende zoekfunctie.

29/10 begin van de dag toevoeging:

Het initiele plan voor vandaag is om de styling iets meer te verbeteren (Grid op de splash page is al toegevoegd met placeholder afbeeldingen van auto's van Pexels.) en te kijken naar de zoekfunctie. Vanaf morgen gaan we herschrijven in correcte OOP stijl

11:25
Eerste opzet van een simpele zoekfunctie is live. Momenteel nog onbeveiligd en kaal/simplistisch, maar functioneel.
Volgende stappen zijn het verbeteren van de code van de zoekfunctie en met name beveiliging inbouwen.
Huidige versie gepusht.

14:00
Search verder uitgebouwd, trims toegevoegd, htmlspecialchars aan de invoer gekoppeld.

------------------

30/10: Begonnen met lessen OOP. Enkele kleine tests met classes gedaan.

12:00 Begonnen met herschrijven van marktplaats project in OOP. Config.php als beginpunt gepakt, aparte folder gegeven, wanneer het compleet is wordt het gehele project in een aparte github repo gezet.
Stappen, uitleg e.d. van het OOP project worden in een bijbehorende aparte readme gezet.