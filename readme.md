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
--------

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