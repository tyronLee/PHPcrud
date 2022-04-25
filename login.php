<?php

session_start();

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}


if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        $_SESSION['error'] = "User name and password are required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "{$_POST['email']} is not a valid email";
        error_log(time() ." {$_POST['email']} is not a valid email \n", 3, "error_log.txt");
    }
     else {
        if ( $_POST['pass'] == "php123" ) {
            error_log(time() ." {$_POST['email']}: Successful login \n", 3, "error_log.txt");
            $_SESSION["account"] = $_POST['email'];
            $_SESSION['success'] = "Logged in";
            header("Location: index.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log(time() ." {$_POST['email']} : Incorrect password \n", 3, "error_log.txt");
            header('Location: login.php');
            return;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>tyron ncube</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php

if ( isset($_SESSION['error']) ) {
    echo("<p style='color: red;''>".$_SESSION['error']."</p>\n");
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo("<p style='color: green;''>".$_SESSION['success']."</p>\n");
    unset($_SESSION['success']);
}
?>
<form method="POST" value="Log In">
<label for="name">User Name</label>
<input type="text" name="email" id="email"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
</p>
</div>
</body>