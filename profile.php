<?php
include "connectdb.php";
if(isset($_SESSION["username"])) {

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
    <li><a href="home.php">Home</a></li>
  <li class="active"><a href="#">Profile</a></li>
  <li><a href="settings.php">Settings</a></li>
</form>
</div>
    <section id="banner">
      <div class="inner split">
        <section>
          <h2><?php echo $_GET["username"]?>'s Profile</h2>
          <?php if ($_GET["username"] != $_SESSION["username"])
          {?>
            <form action="addFriend.php" method="post">
              <input type="hidden" name="friend" value="<?php echo $_GET["username"] ?>">
              <input type="submit" value="Add friend">
            </form>
            <?php } ?>
        </section>
        <section>
          <?php $row = getUserData($_GET["username"],$mysqli);
          ?>
          <h2><?php echo $row[0]." ".$row[1];?></h2>
          <h3><?php echo $row[2];?></h3>
        </section>
</section>
<section id="banner">
  <div class="inner split">
    <section>
      <h2>Friends:</h2>
      <?php $query = "SELECT friend from friends where user ='".$_GET["username"]."';";
    	if($result = $mysqli->query($query))
    	{
    		$array;
    		while ($row = $result->fetch_array(MYSQLI_NUM)){
    				?><h3><?php echo $row[0]?></h3><?php
    		}}
        ?>
    </section>
    <section>
      <?php $row = getCircles($_GET["username"],$mysqli);?>
      <h2>Circles:</h2>
      <?php $query = "SELECT type from circles where username ='".$_GET["username"]."';";
    	if($result = $mysqli->query($query))
    	{
        $array;
    		while ($row = $result->fetch_array(MYSQLI_NUM)){
    				?><h3><?php echo $row[0]?></h3><?php
    		}}
        ?>
    </section>
</section>
</body>
</html>
<?php }
else{echo "Error: You are not logged in. Redirecting...";
header("refresh:3;index.php");}
	?>
