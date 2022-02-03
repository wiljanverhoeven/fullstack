<?php 

require 'logic/dbconnect.php';
include 'logic/filelogic.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/homepage_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <title>home page</title>
</head>
<body>

<?php 

    if(isset($_COOKIE['username'])) {
        echo '<a href="pages/myfiles.php" class="neon-button">my uploads</a>';
        echo '<a href="pages/uploading.php" class="neon-button">upload</a>';
        echo '<a href="pages/downloading.php" class="neon-button">all uploads</a>';
        echo '<a href="logic/logout.php" class="neon-button">log out</a>';

    }
    else {
        echo '<a href="pages/signupindex.php" class="neon-button">signup</a> ';
        echo '<a href="pages/loginindex.php" class="neon-button">login</a>';
    }

?>

</body>
</html>