<?php
include "connectdb.php";
$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];
$message = insertUser($username,$firstname,$lastname,$email,$password,$mysqli);
if($message == "This user already exists!") {
	header("refresh: 3; index.php");
}
else {
	$_SESSION["username"] = $username;
	header("refresh: 3; home.php");}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Registration </title>
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
