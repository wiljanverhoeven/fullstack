<?php 

require '../logic/dbconnect.php';
include '../logic/filelogic.php';

session_start();
if (isset($_SESSION["userid"])) {
    header('location: ../index.php');
    $username=$_SESSION["username"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../style/downloading_style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <title>Download page</title>
</head>
<body>
<header>
</header>
<div class="downloadlist">
  <table class="downloads">
    <tablehead  class="tablehead">
      <th>Filename</th>
      <th>Uploaded by:</th>
      <th>size (in KB)</th>
      <th>Action</th>
    </tablehead>
    <tablebody>
    <?php foreach ($files as $file):?>
      <tr>
        <td><?php echo $file['upload_name']; ?></td>
        <td><?php echo $file["uploader_name"]; ?></td>
        <td class="sizecount"><?php echo ceil($file['upload_size'] / 1000) . ' KB'; ?></td>
        <td class="downloadbtn"><a href="downloading.php?upload_id=<?php echo $file['upload_id'] ?>">Download</a></td>
      </tr>
    <?php endforeach;?>

    </tablebody>
  </table>
</div>
</body>
</html>