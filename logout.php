<?php
session_start();
session_unset();
session_destroy();
header("refresh:3;index.php");
?>
