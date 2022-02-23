<?php
    $con = mysqli_connect("database-vulnerable", $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
    session_start();  
    error_reporting(0);
?>