<?php 

require 'dbconnect.php';

//get file info
$sql = "SELECT * FROM uploads";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

//uploading logic
  if (isset($_POST['uploadbtn'])) { 
    session_start();

    $username=$_COOKIE["username"];

    //get file_name
    $filename = $_FILES['uploadedfile']['name'];

    //directory for the file
    $destination = '../uploads/' . $filename;

    //get file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);


    //direcory gets uploaded in the server
    $file = $_FILES['uploadedfile']['tmp_name'];
    $size = $_FILES['uploadedfile']['size'];

    $extensions = array('zip', 'pdf', 'docx', 'PNG', 'png', 'jpg', 'jpeg', 'exe', 'gif', 'mp3', 'mp4', 'flac', 'wav', 'rar', 'jar', 'JPG');

    if (!in_array($extension, $extensions)) {
        echo "You file extension must be ";
        foreach ($extensions as $extension) {
            echo "$extension, ";
        }
        
    } elseif ($_FILES['uploadedfile']['size'] > 85899345920) { 
        echo "File too large!";
    } else {

        //move files to uploads folder
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO uploads (upload_name, upload_size, uploader_name) VALUES ('$filename', $size, '$username')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload file. <br>";
            echo "error".mysqli_error($conn);

        }
    }
  }

//downloading logic
    if (isset($_GET['upload_id'])) {
        $id = $_GET['upload_id'];
        session_start();
        //get file from database
        $sql = "SELECT * FROM uploads WHERE upload_id=$id";
        $result = mysqli_query($conn, $sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = '../uploads/' . $file['upload_name'];
        
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('uploads/' . $file['upload_name']));
            readfile('uploads/' . $file['upload_name']);
        exit;
        }
    }

?> 