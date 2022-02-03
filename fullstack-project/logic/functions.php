<?php

require 'dbconnect.php';

function emptyInput($name, $password){
    $result = false;

    if( empty($name) || empty($password) ) $result = true;

    return $result;
}

function invalidUsername($name, $result = false){
    $result = false;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)) $result = true;

    return $result;
}

function usernameExists($conn, $name){
    $query = "SELECT * FROM users WHERE username = ?;";
    $stmt = $conn->prepare($query) or die ("prepare failed.");

    $stmt->bind_param('s', $name);

    $stmt->execute() or die ('username exists failed');
    
    $resultSet = $stmt->get_result();

    if ($row = $resultSet->fetch_all()) {
        return $row;

    }
    else {
        return false;
    }

    $conn = null;
    $stmt = null;
}

function createUser($conn, $name, $password){
    $query = "INSERT INTO users (username, password) VALUES (?, ?);";
    $stmt = $conn->prepare($query) or die ("prepare failed.");

    $hashedpwd = hash('sha512', $password);

    $stmt->bind_param('ss', $name, $hashedpwd);
    
    session_start();
    setcookie('username', $userExists[0][1], 0, '/');
    header('location: ../index.php');

    $stmt->execute() or die ('execution failed.');
    $conn = null;
    $stmt = null;
}


function emptyInputLogin($name, $pwd){
    $result = false;

    if( empty($name) || empty($pwd) ) $result = true;

    return $result;
}

function loginUser($conn, $name, $pwd) {
    $userExists = usernameExists($conn, $name, $name);

    if ($userExists === false) {
        echo "user doesnt exist";
        exit();
    }

    $DBPwd = $userExists[0][2];
    $hashedPwd = hash('sha512', $pwd);

    if ($hashedPwd == $DBPwd) $checkPwd = true;
    else $checkPwd = false;

    if ($checkPwd === false) {
        echo "password is incorrect";
        exit();
    }
    else if ($checkPwd) {
        session_start();
        setcookie('username', $userExists[0][1], 0, '/');
        header('location: ../index.php');
        exit();
    }
}
?>