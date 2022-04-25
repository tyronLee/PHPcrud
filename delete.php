<?php
session_start();
require_once "pdo.php";


if (isset($_POST['delete']) && isset($_POST['auto_id'])) {
	$sql = "DELETE FROM autos WHERE auto_id = :zip";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":zip" => $_GET['user_id']));
	$_SESSION['success'] = "Record deleted";
	header('Location: index.php');
	return;
}

if (!isset($_GET['user_id'])) {
	$_SESSION['error'] = "Missing user_id";
	header('Location: index.php');
	return;
}
?>
<html>
<head>
<title>Deleting...</title>

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

</head>
<?php
$stmt = $pdo->prepare("SELECT make, auto_id FROM autos WHERE auto_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
	$_SESSION['error'] = "Bad value for user_id";
	header('Location: index.php');
	return;
}
?>

<p>Confirm: Deleting <?= htmlentities($row['make']) ?> </p>

<form method="post">
	<input type="hidden" name="auto_id" value="<? = $row['auto_id'] ?>">
	<input type="submit" name="delete" value="Delete">
	<a href="index.php">Cancel</a>
</form>