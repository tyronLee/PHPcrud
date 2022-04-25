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
	header("Location: edit.php");
	return;
}
	if (is_numeric($_POST['year']) && is_numeric($_POST['mileage'])){
			$sql = "UPDATE autos SET make = :make,
			model = :model, year = :year,
			mileage = :mileage
			WHERE auto_id = :user_id";
			
			$insert = $pdo->prepare($sql);
			$insert->execute(array(
				':make' => htmlentities($_POST['make']),
				':model' => htmlentities($_POST['model']),
				':year' => $_POST['year'],
				':mileage' => $_POST['mileage'],
				':user_id' => $_POST['user_id']));
			$_SESSION['success'] = "Record edited";
			header("Location: index.php");
			return;
		}
		else{
			$_SESSION['error'] = "Mileage and year must be numeric";
			header("Location: edit.php?user_id=". $_GET['user_id']);
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
$stmt = $pdo->prepare("SELECT * FROM autos WHERE auto_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
	$_SESSION['error'] = "Bad value for user_id";
	header('Location: index.php');
	return;
}
$make = htmlentities($row['make']);
$model = htmlentities($row['model']);
$year = htmlentities($row['year']);
$mileage = htmlentities($row['mileage']);
$user_id = $row['auto_id'];
?>
<form method="post">
<p>Make:

<input type="text" name="make" size="40" value="<?= $make ?>" /></p>
<p>Model:

<input type="text" name="model" size="40" value="<?= $model ?>" /></p>
<p>Year:

<input type="text" name="year" size="10" value="<?= $year ?>" /></p>
<p>Mileage:

<input type="text" name="mileage" size="10" value="<?= $mileage ?>" /></p>
<input type="hidden" name="user_id" value="<?= $user_id ?>" >
<input type="submit" name='update' value="Save">
<input type="submit" name="cancel" value="Cancel">
</form>

</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
