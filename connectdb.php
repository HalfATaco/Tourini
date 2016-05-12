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
function getCircles($username,$mysqli)
{
	$query = "SELECT type from circles where username ='".$username."';";
	if($result = $mysqli->query($query))
	{
		$array;
		while ($row = $result->fetch_array(MYSQLI_NUM)){
	      $array[] = $row[0];
	  }
		return $array;
	}

}
function getFriends($username,$mysqli)
{
	$query = "SELECT friend from friends where user ='".$username."';";
	if($result = $mysqli->query($query))
	{
		$array;
		while ($row = $result->fetch_array(MYSQLI_NUM)){
	      $array[] = $row[0];
	  }
		return $array;
	}

}
function insertPost($username,$message,$link,$location,$privacy,$mysqli)
{
	if($link != null)
	{
$type="photo";
	}
	else{$link = "NULL";}
	if($location == null )
	{
		$location = "NULL";
	}

	else{$type = "post";}
	$reply = "";
	if($privacy =="public" || $privacy=="private")
	{
	$query = "INSERT INTO `post` (`username`, `pTime`, `pLatitude`, `pLongitude`, `pLink`, `pCaption`, `pPrivacy`, `pType`) VALUES ('".$username."',CURRENT_TIME,". $location."," .$location.",'" .$link."','" .$message."','".$privacy."','".$type."');";
	if($mysqli->query($query) === TRUE)
		{
			$reply = "Success!";
		}
		else {
			$reply = $mysqli->error;
		}
}
else{
	$query = "INSERT INTO `post` (`username`, `pTime`, `pLatitude`, `pLongitude`, `pLink`, `pCaption`, `pPrivacy`, `pType`) VALUES ('".$username."',CURRENT_TIME,". $location."," .$location.",'" .$link."','" .$message."','circle','".$type."');";
	$query2= "SELECT circleid from circles where type ='".$privacy."' and username = '".$username."';";
	$query3= "SELECT max(postID) from post";
	if($mysqli->query($query) === TRUE)
		{
			if($result=$mysqli->query($query2))
				{
					  while ($row = $result->fetch_array(MYSQLI_NUM)){
							{$circleId = $row[0];}
							if($result2=$mysqli->query($query3))
								{
										while ($row = $result2->fetch_array(MYSQLI_NUM)){
											{$postId = $row[0];}
											$query4 = "INSERT INTO `post_circle` (`postID`, `circleID`) VALUES ('".$postId."','".$circleId."')";
											if($mysqli->query($query4) === TRUE)
											{$reply ="Success";}
								}}
								else {
									$reply = $mysqli->error;
								}
				}}
				else {
					$reply = $mysqli->error;
				}
		}
		else {
			$reply = $mysqli->error;
		}

}

return $reply;
}
function getUserData($username,$mysqli)
{
	$query = "SELECT firstname,lastname,email from users where username ='".$username."';";
	if($result = $mysqli->query($query))
	{
		$array;
		while ($row = $result->fetch_array(MYSQLI_NUM)){
				return $row;
		}
}
}function insertFriend($friend,$username,$mysqli)
{
	$query = "INSERT INTO `friends` (`user`, `friend`) VALUES ('".$username."','".$friend."')";
	if($mysqli->query($query)==TRUE)
	{
		$reply= "Success";
		}
		else{$reply= "Failure";}
}
function getCircleID($circle, $username, $mysqli)
{
	$query = "SELECT circleid from circles where username = '".$username."' and type = '".$circle."';";
	$reply = "Failure";
	if($result = $mysqli->query($query))
	{
		$row = $result->fetch_array(MYSQLI_NUM);
		return $row[0];
	}
	return "Failure";
}
function getAllCircleID($username, $mysqli)
{
	$query = "SELECT circleid from circles where username = '".$username."';";
	$reply = "Failure";
	if($result = $mysqli->query($query))
	{
		return $result;
	}
	return "Failure";
}
function addCircle($circle, $username, $mysqli)
{
	$query = "INSERT INTO circles (username, type) VALUES ('".$username."','".$circle."');";
	if($mysqli->query($query)==TRUE)
	{
		$reply = "Success";
	}
	else{$reply="Failure";}
	return $reply;
}
function removeCircle($circle, $username, $mysqli)
{
	$circleid = getCircleID($circle, $username, $mysqli);
	if($circleid == "Failure") {$reply = "Failure";}
	else{
		$query = "DELETE FROM circles WHERE circleid = ".$circleid.";";
		if($mysqli->query($query)==TRUE)
		{
			$query = "DELETE FROM friendtype WHERE circleid = ".$circleid.";";
			if($mysqli->query($query)==TRUE)
			{
				$reply="Success";
			}
			else{$reply="Failure";}
		}
		else{$reply="Failure";}
	}
	return $reply;
}
function insertFriendToCircle($friend, $circle, $username, $mysqli)
{
	$circleid = getCircleID($circle, $username, $mysqli);
	if($circleid == "Failure") {$reply = "Failure";}
	else{
		$query = "INSERT INTO friendtype (circleId, friend) VALUES (".$circleid.",'".$friend."')";
		if($mysqli->query($query)==TRUE)
		{
			$reply= "Success";
			}
			else{$reply= "Failure";}
	}
	return $reply;
}
function removeRequest($friend,$username,$mysqli)
{
	$query = "DELETE FROM `friendrequest` WHERE sender='".$friend."'AND reciever='".$username."';";
	if($mysqli->query($query)==TRUE)
	{
	$reply= "Success";
		}
		else{$reply= "Failure";}
		return $reply;
}
function removeFriend($friend,$username,$mysqli)
{
	$query = "DELETE FROM `friends` WHERE friend='".$friend."'AND user='".$username."';";
	if($mysqli->query($query)==TRUE)
	{
		$query = "DELETE FROM `friends` WHERE friend='".$username."'AND user='".$friend."';";
		if($mysqli->query($query)==TRUE)
		{
			$reply = "Success";
			$array = getAllCircleID($username, $friend);
			if($array == "Failure") {$reply = "Failure";}
			else
			{
				for ($i = 0; $i < count($array);$i++) {
					$query = "DELETE FROM friendtype WHERE circleId=".$array[i]." AND friend='".$friend."';";
					if($mysqli->query($query)!=TRUE)
					{
						$reply = "False";
					}
				}
			}
		}
		else{$reply= "Failure";}
	}
	else{$reply= "Failure";}
	
	return $reply;
}

?>
