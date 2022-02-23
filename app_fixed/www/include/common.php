<?php
    // $con = mysqli_connect("localhost","store","donald","store");
    error_reporting(0);
    $con = new mysqli("database-fixed", $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
    session_start();
?>