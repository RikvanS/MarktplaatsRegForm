<?php

require_once "config.php";

$output = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $q = trim($_POST['q']);
    $query = mysqli_query($link, "SELECT * FROM users WHERE username LIKE '%$q%'");
    $count = mysqli_num_rows($query);
    if ($count == "0") {
        $output = '<h2>No results found!</h2>';
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $su = $row['username'];
            $s = $row['password'];
            $output .= '<h2> '.$su. '<br>' .$s.' </h2><br>';
        }
    }
}
else{ 
      echo  "<p>Please enter a search query</p>"; 
}

?>
<!-- Dit is een basale onbeveiligde search query met front-end. In de volgende versie wordt er meer beveiliging toegevoegd dmv htmlspecialchars en trim commando's
Deze eerste versie is vooral bedoeld als proof of concept van een zoekfunctie en om te testen of ik de functionaliteit werkend krijg.
-->

<!DOCTYPE html>
<html>
	<head>
		<title>Search</title>
	</head>
	<body>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="text" name="q" placeholder="First name here">
			<input type="submit" name="search" value="Search">
		</form>
		<?php echo $output; ?>
	</body>
</html>