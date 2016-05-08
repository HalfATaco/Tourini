<?php
include "connectdb.php";
if(isset($_SESSION["username"])) {
	echo "You are already logged in. You will be redirected in 3 seconds \n";
	  header("refresh: 3; index.php");
}
else if(!(isset($_POST["username"]) && isset($_POST["pass"]))){
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Register Page </title>
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
								<section>
									<h2>Welcome to Tourini. Please sign in or register an account!</h2>
								</section>

			<form action = "insertUser.php" method = "POST">
				<div class = "col">Username<input type="text" name="username" required></div>
				<div class = "col">First Name<input type="text" name="firstname" required></div>
				<div class = "col">Last Name<input type="text" name="lastname" required></div>
				<div class = "col">Email<input type="email" name="email" required></div>
				<div class = "col">Password<input type="password" name="password" required></div>
				<input type="submit">
					</form>
		</body>
			</html>
			</html>
<?php } ?>
