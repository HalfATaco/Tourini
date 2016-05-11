<?php
include "connectdb.php";
$username = $_POST["username"];
$password = $_POST["password"];
$message = checkUser($username,$password,$mysqli);
if($message == "Either user does not exist or wrong password") {
	echo $message;
	header("refresh: 3; index.php");
}
else {
	$_SESSION["username"] = $username;
?>	<!DOCTYPE html>
	<html>
	<head>
		<title> Welcome back </title>
		<body>
			<html>
			<head>
				<title>Tourini</title>
				<meta charset="utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1" />
				<link rel="stylesheet" href="assets/css/main.css" />
			</head>
			<body>

				<section id="banner">
					<div class="inner split">
							<h2><?php echo $message ?></h2>

					</body>
					</html>
					</html>
<?php
	header("refresh: 3; home.php");}
?>
