<?php
include "connectdb.php";
if(isset($_SESSION["UserID"])) {
	echo "You are already logged in. You will be redirected in 3 seconds \n";
	  header("refresh: 3; index.php");
}
// Show form only if user is not signed in. Prevent signed in users from seeing form
else if(!(isset($_POST["id"]) && isset($_POST["pass"]))){
?>

<!DOCTYPE html>
<html>
	<style>
body {
  padding-top: 0px;
}
.form-signin {
  max-width: 400px;
  padding: 15px;
  margin:  auto;
}
	</style>
	<body>
		<div class = "container">
			<div class = "row">
				<ul class = "nav nav-tabs">
					<li><a href="index.php">Homepage</a>

				</li>
					<li>
						<a href="profile.php">View Profile</a>
					</li>
					<li>
						<a href="PostEvent_html.php">Post Event</a>
					</li>
					<li>
						<a href="event_veiwer.php">View Event & Sign Up</a>
					</li>
					<li>
						<a href="check_events.php">Check Event</a>
					</li>
					<li>
						<a href="delete.php">Delete Comment</a>
					</li>
					<li>
						<a href="comment.php">Post Comment</a>
					</li>

					<li class ='navbar-right'>
						<a href="register.php">Register</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="container form-signin">
			<h1>
				<p style="text-align: center;">Sign In </p>
			</h1>



			<form method="post" action="login.php">
				<input type="text" class = "form-control" name="id" placeholder="Person ID"  required>
					<input type="password" class = "form-control" name="pass" placeholder="Password" required>
						<p class="remember_me">
							<label>
								<input type="checkbox" name="remember_me">
									<span style="font-weight:normal;"> Remember me on this computer</span>
								</label>
							</p>
							<button type = "submit" class = "btn btn-lg btn-block btn-primary">
									Login
							</button>


						</div>
					</form>
				</body>
				<?php
}  //Finish off the else if above
else if ($stmt = $mysqli->prepare("select pid,fname from person where pid= ? and passwd = ?")) {
	 $UID = $_POST["id"];
	 $UPass = md5($_POST["pass"]);
      $stmt->bind_param("ss", $UID, $UPass);
	  $stmt->execute();
	  $stmt->bind_result($userPID,$userName);
	  if($stmt->fetch()){
		  $_SESSION["UserID"] = $userPID;
		 $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"];

		  echo "You have successfully logged in. You will be redirected in 3 seconds";

			$_SESSION["error"] = 0;
		   header("refresh: 3; index.php");
	  }

	else{
		echo "Either the ID or password was incorrect. Try again";
			$_SESSION["error"] = 1;
	header("refresh: 2; login.php");

	}
	  $stmt->close();
}
	  $mysqli->close();


?>
