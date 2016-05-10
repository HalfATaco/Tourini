<?php
include "connectdb.php";
if(isset($_SESSION["username"])) {


$reply=removeFriend($_POST["friend"],$_SESSION["username"],$mysqli);
echo $reply;
header("refresh:3;settings.php");
}

else{echo "Error: You are not logged in. Redirecting...";
header("refresh:3;index.php");}

?>
