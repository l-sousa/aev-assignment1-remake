<?php

$target_dir = "uploads/";
$name = "userfile";
$target_file = $target_dir . $_POST["user"] . "&" . basename($_FILES[$name]["name"]);
//$target_file = $target_dir . $_POST["user"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check file size
if ($_FILES[$name]["size"] > 500000) {
    header('location:profile.php?error=file is too large');
}

if (file_exists($target_file)) unlink($target_file);

foreach (glob("uploads/" . $_POST["user"] . '&*.*') as $filename) {
    unlink($filename);
}

if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
    header('location:profile.php?success=filetype uploaded');
} else {
    header('location:profile.php?error_0=upload failed');
}
