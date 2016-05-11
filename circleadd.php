<?php
include "connectdb.php";
$circle = $_POST["circname"];

$reply =addCircle($circle, $_SESSION["username"], $mysqli);
	header("refresh: 3; settings.php");
?>



<!DOCTYPE html>
<html>
<head>
	<title> Adding to Circle </title>
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
						<h2><?php echo $reply?></h2>
						<h3>Please wait 3 seconds while being redirected"</h3>
				</body>
				</html>
				</html>
