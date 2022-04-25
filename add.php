<?php
session_start();

if ( ! isset($_SESSION['account'])) {
    die('ACCESS DENIED');
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}

require_once('pdo.php');



if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])){
	if ($_POST['make'] == "" && $_POST['model'] == ""){
	$_SESSION['error'] = 'All fields are required';
	header("Location: add.php");
	return;
}
	if (is_numeric($_POST['year']) && is_numeric($_POST['mileage'])){
			$sql = "INSERT INTO autos (make, model, year, mileage) VALUES (:make, :model, :year, :mileage)";
			
			$insert = $pdo->prepare($sql);
			$insert->execute(array(
				':make' => htmlentities($_POST['make']),
				':model' => htmlentities($_POST['model']),
				':year' => $_POST['year'],
				':mileage' => $_POST['mileage']));
			$_SESSION['success'] = "Record added";
			header("Location: index.php");
			return;
		}
		else{
			$_SESSION['error'] = "Mileage and year must be numeric";
			header("Location: add.php");
			return;
		} 
}




?>

<!DOCTYPE html>
<html>
<head>
<title>tyron ncube</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo ($_SESSION['account']); ?></h1>
<?php
if ( isset($_SESSION['error']) ) {
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);
}
?>
<form method="post">
<p>Make:

<input type="text" name="make" size="40"/></p>
<p>Model:

<input type="text" name="model" size="40"/></p>
<p>Year:

<input type="text" name="year" size="10"/></p>
<p>Mileage:

<input type="text" name="mileage" size="10"/></p>
<input type="submit" name='add' value="Add">
<input type="submit" name="cancel" value="Cancel">
</form>

</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
