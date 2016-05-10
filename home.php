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
    <li class="active"><a href="#">Home</a></li>
  <li><a href="profile.php?username=<?php echo $_SESSION["username"]?>">Profile</a></li>
  <li><a href="profile.php?username=<?php echo $_SESSION["username"]?>">Settings</a></li>

  </div>
</form>
    <section id="banner">
      <div class="inner split">
        <section>
          <h2>Welcome back <?php echo $_SESSION["username"]?></h2>
          <h3>Post a status on the right</h3>
        </section>
        <section>
          <form action="insertMessage.php" method="post" enctype="multipart/form-data"><input type="text" id='textbox' name="message" required>
            <p>Location:<input type="number" id="location-input" name="location">
              <p><input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
              <p>
                <input type="text" list="Circles" name = "circle" required>
                <datalist id="Circles">
                <?php $array = getCircles($_SESSION["username"],$mysqli);
                for ($i = 0; $i < count($array);$i++)
                {
                  ?><option value="<?php echo $array[$i];?>">

                    <?php } ?>
                    <option value="public">
                    <option value = "private">
                </datalist>
              </p>
              <input type = "submit" name="submit"></form>
            </div>
          </section>
      </section>
      <?php $message = "";
      $query1="SELECT DISTINCT post.username,pLink,pCaption,pTime,pLatitude,pLongitude FROM users, post,friends WHERE post.username ='".$_SESSION["username"]."' AND post.pPrivacy = 'public';";
    $query2="SELECT DISTINCT  post.username,pLink,pCaption,pTime,pLatitude,pLongitude FROM users,  post, friends WHERE users.username = post.username AND post.pPrivacy = 'private' AND user.username = '".$_SESSION["username"]."';";
    $query3="SELECT DISTINCT post.username,pLink,pCaption,pTime,pLatitude,pLongitude from post,post_circle,friendtype where post.postID = post_circle.postID AND post.pPrivacy='circle' AND friendtype.friend ='".$_SESSION["username"]."'GROUP BY post.postID;";
    ?>
    <?php
    if($result = $mysqli->query($query1))
    {   while ($row = $result->fetch_array(MYSQLI_NUM)){

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
    <?php }}	if($result2 = $mysqli->query($query2))
      {   while ($row2 = $result->fetch_array(MYSQLI_NUM)){

            $username = $row2[0];
            $pLink = $row2[1];
            $pCaption = $row2[2];
            $pTime = $row2[3];
            $pLatitude = $row2[4];
            $pLongitude = $row2[5];

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
    <?php }} 	if($result3 = $mysqli->query($query3))
      {   while ($row3 = $result->fetch_array(MYSQLI_NUM)){

            $username = $row3[0];
            $pLink = $row3[1];
            $pCaption = $row3[2];
            $pTime = $row3[3];
            $pLatitude = $row3[4];
            $pLongitude = $row3[5];

        ?>
        </div>	<div class="spotlight">
          <div class="image">
            <img src="<?php $pLink ?>" alt="" />
          </div>
          <div class="content">
            <h3><?php $pCaption ?></h3>
            <p><?php echo "Posted on ".$pTime."by ".$username?>  </p>
                    </div>
        </div>
    <?php }} ?>
</html>
<?php }
else{echo "Error: You are not logged in. Redirecting...";
header("refresh:3;index.php");}
	?>
