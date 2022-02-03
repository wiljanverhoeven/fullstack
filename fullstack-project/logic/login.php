<?php 

require 'dbconnect.php';
require_once 'filelogic.php';
require_once 'functions.php';

if (isset($_POST["submit"])) {

    $name = $_POST["uid"];
    $pwd = $_POST["password"];

    if (emptyInputLogin($name, $pwd) !== false) {
        echo "please try again";
        exit();
    }

    loginUser($conn, $name, $pwd);
}
else {
    echo "welcome";
    exit();
}

?>