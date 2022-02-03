<?php

require 'dbconnect.php';

session_start();
session_unset();
session_destroy();
setcookie('username', $userExists[0][1], -1, '/');
header('location: ../index.php');
?>