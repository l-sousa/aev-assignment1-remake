<?php
ob_start();
include 'include/common.php';
$user_id = $_SESSION['user_id'];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    mysqli_query($con, "UPDATE users SET name='$name' WHERE id='$user_id'") or die(mysqli_error($con));
    header("location:profile.php");

} else if (isset($_POST['email'])) {
    $email = $_POST['email'];
    mysqli_query($con, "UPDATE users SET email='$email' WHERE id='$user_id'");
    header("location:profile.php");

} else if (isset($_POST['contact'])) {
    $contact = $_POST['contact'];
    mysqli_query($con, "UPDATE users SET contact='$contact' WHERE id='$user_id'");
    header("location:profile.php");

} else if (isset($_FILES['upload'])) {
    $file_name = $_FILES['upload']['name'];
    $file_tmp_name = $_FILES['upload']['tmp_name'];

    $target_dir = 'uploads/';

    if (move_uploaded_file($file_tmp_name, $target_dir . $file_name)) {
        $row = mysqli_query($con, "UPDATE users SET images='$file_name' WHERE id ='$user_id'; ");
        if (!mysqli_affected_rows($con)) {
            header('location:profile.php?error_0=An erorr occured while uploading your file. Please try again.');
        } else {
            header('location:profile.php');
        }
    }

} else if (isset($_POST['Old_password'])) {

    $password = md5($_POST['Old_password']);
    $new_password = md5($_POST['New_Password']);
    $new_password_2 = md5($_POST['Re_type_new_password']);

    $user_id = $_SESSION['user_id'];

    $query = mysqli_query($con, "SELECT * FROM users WHERE password = '$password' AND id = '$user_id'") or die(mysqli_error($con));

    if (mysqli_num_rows($query) == 0) {
        header('location:profile.php?error=Incorrect old password.');
    } else {
        if ($new_password == $new_password_2) {
            mysqli_query($con, "UPDATE users SET password = '$new_password' WHERE id = '$user_id';") or die(mysqli_error($con));
            header('location:profile.php');
        } else
            header('location:profile.php?error=New passwords do not match.');
    }
} else {
    header('location:profile.php?error=Some error occured while processing your request.');
}