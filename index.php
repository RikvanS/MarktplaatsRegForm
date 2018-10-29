<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    
</head>
<body>
    <div class="navcontainer">
        <nav>
            <a href="login2.php">Log in</a>
            <a href="register.php">Register</a>
            <a class="site-logo" href="index.php"><span class="logo"></span>MarketPlace</span></a>
        </nav>
    </div>

    <h1>Welcome to MarketPlace</h1>
    <h2>Let us help you find your value today</h2>

<?php

require_once "config.php";

$output = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $q = trim($_POST['q']);
    $query = mysqli_query($link, "SELECT * FROM advertenties WHERE naam LIKE '%$q%'");
    $count = mysqli_num_rows($query);
    if ($count == "0") {
        $output = '<h2>No results found!</h2>';
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $su = $row['naam'];
            $s = $row['prijs'];
            $output .= '<h2> '.$su. '<br>' .$s.' </h2><br>';
        }
    }
}


?>
        <div class="main-search">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="text" name="q" placeholder="Search for your treasure!">
			<input type="submit" name="search" value="Search">
		</form>
		<?php echo $output; ?>
        </div>


        <div class="main">
            <div class="grid-container">
                <div>
                    <img src="images/car3.jpeg" alt="car3" class="grid-image">
                    Previously owned by an old lady who only took it out once a month for church visits. Asking price $2500 or best offer
                </div>
                <div>
                    <img src="images/car1.jpeg" alt="car1" class="grid-image">
                    Ever wanted to feel the wind blowing through your hair as you cruise through the local woods? For only $15.000 you can, in your very own convertible.
                    For $35.000 however, you could buy this car instead and be the talk of the town. And let's be honest, who doesn't want to be the talk of the town?
                </div>
                <div>
                    <img src="images/car2.jpeg" alt="car2" class="grid-image">
                    I'm moving to New Brunnswick and don't need my Audi anymore. I'm letting my faithful chariot go for a pittance: $10.000
                </div>
                <div>
                    <img src="images/car4.jpeg" alt="car4" class="grid-image">
                    Car. Working condition. No damage. $8.000, first come first serve
                </div>
            </div>
        </div>
        <footer>
            <a href="#">About</a>
            <a href="#">Our team</a>
            <a href="#">Work with us</a>
            <a href="#">Become a partner</a>
            <a href="#">F.A.Q.</a>
            <a href="#">Contact us</a>
        </footer>        
</body>
</html>