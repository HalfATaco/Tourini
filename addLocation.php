<?php
include "connectdb.php";
$location = $_POST["location"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$reply = insertLocation($location, $latitude, $longitude, $mysqli);
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
				
						<h2><?php echo $reply ?></h2>
						<h3>Please wait 3 seconds while you are redirected</h3>
				</body>
				</html>
				</html>
