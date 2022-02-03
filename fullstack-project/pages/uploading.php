<?php 

require '../logic/dbconnect.php';
include '../logic/filelogic.php';

session_start();
if (isset($_SESSION["userid"])) {
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="../style/uploading_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
 
    <title>Upload page</title>
  </head>
  <body>
    <div class="upload_form">
        <form action="../logic/filelogic.php" method="post" enctype="multipart/form-data" >
          <input type="file" name="uploadedfile">
          <input class="neon-button" type="submit" name="uploadbtn" value="Upload">
        </form>
      </div>
  </body>
</html>