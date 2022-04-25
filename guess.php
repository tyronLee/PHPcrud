<?php
session_start();
if (isset($_POST['guess'])) {
	$guess = $_POST['guess'];
	$comp_guess = rand(0, 99);
	$target = rand(0, 99);
	$guess_diff = $guess - $target;
	$comp_diff = $comp_guess - $target;

	if (abs($guess_diff) < abs($comp_diff)) {
		$_SESSION['message'] = "You won {$guess}. The target was {$target} and the computer's guess was {$comp_guess}";
	}
	elseif (abs($guess_diff) > abs($comp_diff)) {
		$_SESSION['message'] = "You lost {$guess}. The target was {$target} and the computer's guess was {$comp_guess}";
	}
	else{
		$_SESSION['message'] = "Draw. The target was {$target} and the computer's guess was {$comp_guess}";	
	}
	header("Location: guess.php");
	return;

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Guessing game</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Guessing game</h1>
<?php

if ( isset($_SESSION['message']) ) {
	
	$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    echo("<p style='color: red;''><h3>".$message."</h3></p>\n");
}
?>
<form method="post" value="Add">
<p>Enter a value
<input type="text" name="guess" size="60"/></p>
<input type="submit" value="Add">
</form>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>