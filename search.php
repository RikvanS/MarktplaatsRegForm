<?php 

require_once "config.php";

$search = "";
$search_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST['search']))){
        $search_err = "Searchfield cannot be empty";
    } else {
        $new_search = trim($_POST["new_search"]);
    }
    if(empty($search_err)){
        $sql = "SELECT username FROM users WHERE "
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($search_err)) ? 'has-error' : ''; ?>">
            <label>Search here</label>
                <input type="text" name="search" class="form-control" value="<?php echo $search; ?>">
                <span class="help-block"><?php echo $search_err; ?></span>
</body>
</html>

