<?php
    include 'include/common.php';
    $_SESSION['email'] = $_GET['email'];
    $_SESSION['user_id'] = $_GET['user_id'];
    $_SESSION['name'] = $_GET['name'];
    exit();
?>