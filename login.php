<!doctype html>
<html>
  <head>
    <title>Logging in...</title>
    <meta charset="UTF-8">
<META HTTP-EQUIV="refresh" CONTENT="home.html"><META HTTP-EQUIV="refresh" CONTENT="10,home.php">
  </head>
  <body>
   <?php
   session_start();
   for ($i = 13002; $i < 13011;$i++)
   {
   $socket = stream_socket_client("tcp://localhost:".i, $errno, $errstr, 5);
   if (!$socket) {
      echo $errstr;
      exit(1);
  }
  fwrite($socket,"checkPassword ".$_POST["username"]." ".$_POST["password"]);
  $reply= fread($socket,256);
  if ($reply=="Correct password")
    {
      echo "Welcome ".$_POST["username"];
      $_SESSION["username"]=$_POST["username"];
      header("refresh:5;home.php");
    }
  else
    {
      echo "Incorrect password";
      header("refresh:5;index.html");
    }
  }
  ?>

  </body>
</html>
