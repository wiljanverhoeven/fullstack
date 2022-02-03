<?php 

require 'dbconnect.php';

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $password = $_POST["password"];

    require_once 'filelogic.php';
    require_once 'functions.php';

    if (emptyInput($name, $password) !== false) {
        echo "enter all fields";
        exit();
    }
    if (invalidUsername($name) !== false) {
        echo "uwaaa omo. this username is not valid x3";
        exit();
    }

    if (usernameExists($conn, $name) !== false) {
        echo "username already exits";
        exit();
    }

    createUser($conn, $name, $password);

} else {
    echo "sign up succesfull";
    exit();
}
?>