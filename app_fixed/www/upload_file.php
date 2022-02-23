<?php

$target_dir = "uploads/";
$name = "userfile";
$imageFileType = strtolower(pathinfo(basename($_FILES[$name]["name"]), PATHINFO_EXTENSION));

$target_file = $target_dir . md5($_POST["user"]) . "." . $imageFileType;
//$target_file = $target_dir . $_POST["user"];
$uploadOk = 1;
// Limit allowed file formats

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    header('location:profile.php?error=filetype not allowed only jpg jpeg png gif');
    exit();
}
// Check file size
if ($_FILES[$name]["size"] > 500000) {
    header('location:profile.php?error=file is too large');
    exit();
}

if (file_exists($target_file)) unlink($target_file);

foreach (glob("uploads/" . $_POST["user"] . '&*.*') as $filename) {
    unlink($filename);
}

if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
    header('location:profile.php?success=filetype uploaded');
    exit();
} else {
    header('location:profile.php?error=upload failed');
    exit();
}
