<?php
$mysqli = new mysqli("localhost", "root", "password", "tourini");
/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
// start session, check session IP with client IP, if no match start a new session
session_start();
if(isset($SESSION["REMOTE_ADDR"]) && $SESSION["REMOTE_ADDR"] != $SERVER["REMOTE_ADDR"]) {
	session_destroy();
	session_start();
}

function insertUser($username,$firstname,$lastname,$email,$password,$mysqli)
{
	$message = "";
	$query = "INSERT INTO `users` (`username`, `firstName`, `lastName`, `email`, `password`) VALUES ('".$username."','". $firstname."','" .$lastname."','" .$email."','" .$password."')";
	if($mysqli->query($query) === TRUE)
	{
		$message = "Your account has been created!";
	}
	else {
		$message = "This user already exists!";
	}
	return $message;

}
function checkUser($username,$password,$mysqli)
{
	$message = "";
	$query = "SELECT * FROM `users` WHERE username ='".$username."' and password = '".$password."';";
	if($result = $mysqli->query($query))
	{
		$row_cnt = $result->num_rows;
		if ($row_cnt > 0)
		{$message = "Welcome back ".$username;}
		else{$message = "Either user does not exist or wrong password";}
	}
	return $message;

}

?>
