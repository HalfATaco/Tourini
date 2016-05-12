<?php
include "connectdb.php";
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Tourini</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  </head>
  <body>
  <div class="collapse navbar-collapse">
      <form action="search.php" method="GET"><input type="search" placeholder="Search here" name="searchVal" required><input type="submit" value="Go"/>
  <ul class="nav navbar-nav pull-right ">
    <li class="active"><a href="home.php">Home</a></li>
  <li><a href="profile.php?username=<?php echo $_SESSION["username"]?>">Profile</a></li>
  <li><a href="profile.php?username=<?php echo $_SESSION["username"]?>">Settings</a></li>
  </div>
  </form>
  
  <?php $message = "";
	$query1 = "SELECT post.username, pLink, pCaption, pTime, pLatitude, pLongitude FROM users JOIN post ON users.username = post.username WHERE pPrivacy = 'public' and pCaption LIKE '%".$_GET["searchVal"]."%';";
    
	$query4 = "SELECT username, firstName, lastName FROM users WHERE username like '%".$_GET["searchVal"]."%' OR firstName like '%".$_GET["searchVal"]."%' OR lastName like '%".$_GET["searchVal"]."%';";
    $query5 = "SELECT type FROM users JOIN circles ON users.username = circles.username WHERE users.username = 'allenduncare' AND type like '%".$_GET["searchVal"]."%';";
  ?>
  <h2>Posts</h2>
    <?php
    $array1 = getAllPublicPosts($_GET["searchVal"],$mysqli);
	foreach($array1 as $row)
	{
		$username = $row[0];
		$pLink = $row[1];
		$pCaption = $row[2];
		$pTime = $row[3];
		$pLatitude = $row[4];
		$pLongitude = $row[5];
		?>
		</div>	<div class="spotlight">
		<div class="image">
		  <img src="./uploads/<?php echo $pLink ?>" alt="" />
		</div>
		<div class="content">
		  <h3><?php echo $pCaption ?></h3>
		  <p><?php echo "Posted on ".$pTime." by ".$username?>  </p>
		</div>
		</div>	
		<?php
	}?>
	<?php
	$array2 = getAllPrivatePosts($_SESSION["username"], $_GET["searchVal"],$mysqli);
	foreach($array2 as $row)
	{
		$username = $row[0];
		$pLink = $row[1];
		$pCaption = $row[2];
		$pTime = $row[3];
		$pLatitude = $row[4];
		$pLongitude = $row[5];
		?>
		</div>	<div class="spotlight">
		<div class="image">
		  <img src="./uploads/<?php echo $pLink ?>" alt="" />
		</div>
		<div class="content">
		  <h3><?php echo $pCaption ?></h3>
		  <p><?php echo "Posted on ".$pTime." by ".$username?>  </p>
		</div>
		</div>	
		<?php
	}?>
  <h2>Users</h2>
  <?php
    if($result = $mysqli->query($query4))
	{
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
			$username = $row[0];
			$firstName = $row[1];
			$lastName = $row[2];
			?>
			</div>	<div class="spotlight">
		    <div class="content">
			  <h3><?php echo '<a href="profile.php?username=';
			            echo htmlspecialchars($username);
						echo "\">$username</a>";
				?>
			  </h3>
		      <h3><?php echo " ".$firstName." ".$lastName ?></h3>
		    </div>
		    </div>	
			<?php
		}
	} 
  ?>
  
  <h2>Circles</h2>
  <?php
    if($result = $mysqli->query($query5))
	{
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
			$type = $row[0];
			?>
			</div>	<div class="spotlight">
		    <div class="content">
		      <h3><?php echo $type ?></h3>
		    </div>
		    </div>	
			<?php
		}
	} 
  ?>
  
</html>