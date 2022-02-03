<?php 

$username=$_COOKIE['username'];

//get file from database
$sql = "SELECT * FROM uploads WHERE uploader_name='$username'";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['upload_id'])) {
        $id = $_GET['upload_id'];
        session_start();

        $username=$_COOKIE["username"];
        $filepath = '../uploads/' . $files['upload_name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('uploads/' . $files['upload_name']));
            readfile('uploads/' . $files['upload_name']);
        exit;
        }
    }

?>