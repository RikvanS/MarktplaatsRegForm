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

