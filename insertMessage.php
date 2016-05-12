<?php
include "connectdb.php";
$message = $_POST["message"];
$photo;
$location= $_POST["location"];
$circle = $_POST["circle"];
$target_dir = "uploads/";
switch ($_FILES['fileToUpload']['error']) {
      case UPLOAD_ERR_OK:
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      echo $_FILES["fileToUpload"]["tmp_name"];
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
              $uploadOk = 1;
          } else {
              $uploadOk = 0;
          }
      }

      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 100000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
              $photo=$_FILES["fileToUpload"]["name"];
          } else {
              echo "Sorry, there was an error uploading your file.";
              $photo ="blank.png";
          }
      }
      $reply =insertPost($_SESSION["username"],$message,$photo,$location,$circle,$mysqli);
      	header("refresh: 10; home.php");
          break;
      case UPLOAD_ERR_NO_FILE:
      $reply =insertPost($_SESSION["username"],$message,"blank.png",$location,$circle,$mysqli);
      	header("refresh: 10; home.php");

          break;
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
          throw new RuntimeException('Exceeded filesize limit.');
      default:
          throw new RuntimeException('Unknown errors.');
        }
?>

<!DOCTYPE html>
<html>
<head>
	<title> Posting status... </title>
	<body>
		<html>
		<head>
			<title>Tourini</title>
      <meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<link rel="stylesheet" href="assets/css/main.css" />
		</head>
		<body>
			<section id="banner">
				<div class="inner split">
						<h2><?php echo $reply ?></h2>

				</body>
				</html>
				</html>
