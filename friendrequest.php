<?php
include "connectdb.php";
if(isset($_SESSION["username"])) {
$action = $_POST["action"];

if($action == "accept")
{
$reply=insertFriend($_POST["request"],$_SESSION["username"],$mysqli);
$reply=removeRequest($_POST["request"],$_SESSION["username"],$mysqli);
echo $reply;
header("refresh:3;settings.php");
}
else{

  $reply=removeRequest($_POST["request"],$_SESSION["username"],$mysqli);
  echo $reply;
header("refresh:3;settings.php");
}




}
else{echo "Error: You are not logged in. Redirecting...";
header("refresh:3;index.php");}

?>
