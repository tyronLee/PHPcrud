<?php
session_start();

if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
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
<?php
if ( isset($_SESSION['success']) ) {
  echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
  unset($_SESSION['success']);
}

?>
<h2>Welcome to the Automobiles Database</h2>
<p>
<?php
if ( isset($_SESSION['error']) ) {
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);
}

if (isset($_SESSION['account'])) {
	require_once('pdo.php');

	$sql = "SELECT * FROM autos";
	$result = $pdo->prepare($sql);
	$result->execute([$sql]);
	if ($result->fetchColumn() == 0) {
		echo "No rows found";
	}else{ 
		echo "<table border='1'>";
		echo "<thead><tr>";
		echo "<th>Make</th>";
		echo "<th>Model</th>";
		echo "<th>Year</th>";
		echo "<th>Mileage</th>";
		echo "<th>Action</th>";
		echo "</tr></thead>";

		$stmt = $pdo->query("SELECT * FROM autos");
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo("<tr>");
			echo("<td>" . $row['make'] . "</td> ");
			echo("<td>" . $row['model'] . "</td> ");
			echo("<td>" . $row['year'] . "</td> ");
			echo("<td>" . $row['mileage'] . "</td> ");
			echo("<td><a href='edit.php?user_id=" . $row['auto_id'] ."'>Edit</a> / <a href='delete.php?user_id=" . $row['auto_id'] ."'>Delete</a></td>");
			echo("</tr>");
		}
	echo("</table>");
	
	}
	
	echo("</p><p><a href='add.php'>Add New Entry</a></p>");
	echo("<p><a href='logout.php'>Logout</a></p>");
}else{
	echo("<a href='login.php'>Please log in </a>");
}
?>
<p>Attempt to <a href="add.php">add data</a> without logging in</p>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>