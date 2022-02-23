<?php
ob_start();
include 'include/common.php';

if (!isset($_SESSION['email']))
    header("location:login.php");

$user_id = $_SESSION['user_id'];

# CSRF Verification - If form token is empty or doesn't match users token
if (empty($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])) {
    header('location:profile.php?error=Invalid CSRF Token');
    exit();
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $query = $con->prepare("UPDATE users SET email=? WHERE id=?");
    $query->bind_param("si", $email, $user_id);
    $query->execute();

    header("location:profile.php");
} else if (isset($_POST['contact'])) {
    $contact = $_POST['contact'];

    $query = $con->prepare("UPDATE users SET contact=? WHERE id=?");
    $query->bind_param("si", $contact, $user_id);
    $query->execute();

    header("location:profile.php");
} else if (isset($_FILES['upload'])) {
    $file_name = $_FILES['upload']['name'];
    $file_type = $_FILES['upload']['type'];
    $file_tmp_name = $_FILES['upload']['tmp_name'];
    $file_size = $_FILES['upload']['size'];

    $target_dir = 'uploads/';

    if (move_uploaded_file($file_tmp_name, $target_dir . $file_name)) {

        $query = $con->prepare("UPDATE users SET images=? WHERE id=?");
        $query->bind_param("si", $file_name, $user_id);
        $query->execute();

        if (!mysqli_affected_rows($con)) {
            header('location:profile.php?error=an erorr occured while uploading your file please try again');
        } else {
            header('location:profile.php');
        }
    }
} else if (isset($_POST['Old_password'])) {

    $password = md5($_POST['Old_password']);
    $new_password = md5($_POST['New_Password']);
    $Rnew_password = md5($_POST['Re_type_new_password']);
    $user_id = $_SESSION['user_id'];

    $query = $con->prepare("SELECT * FROM users WHERE password=? AND id=?");
    $query->bind_param("si", $password, $user_id);
    $query->execute();
    $result = $query->get_result() or die(mysqli_error($con));

    if (mysqli_num_rows($result) == 0) {
        header('location:profile.php?error=Incorrect password');
    } else {
        if ($new_password == $Rnew_password) {

            $query = $con->prepare("UPDATE users SET password = ? WHERE id = ?;");
            $query->bind_param("si", $new_password, $user_id);
            $query->execute();

            header('location:profile.php');
        } else
            header('location:profile.php?error2=Passwords do not match');
    }
} else {
    header('location:profile.php?error=some error occured while processing your request!');
}
