<?php
include "connectdb.php";
if(isset($_SESSION["username"])) {
	echo $_SESSION["username"];
  ?>
  <!DOCTYPE HTML>
  <html>
  <head>
    <title>Tourini</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
  </head>
  <body>

    <!-- Banner -->
    <section id="banner">
      <div class="inner split">
        <section>
          <h2>Welcome to Tourini. Please sign in or register an account!</h2>
        </section>
        <section>
          <form action="login.php" method="POST"><p> Username:<input type="text" name="username" required>
            <p> Password:<input type="password" name="password" required >
              <input type = "submit"></form>
              Don't have an account? <a href="register.php">Click here</a> to sign up
            </div>
          </section>
        </div>
      </section>
<?php }
else{echo "Error: You are not logged in. Redirecting...";
header("refresh:3;index.html");}
	?>
