<?php
ob_start();
$id = $_GET['id'];


if (!is_numeric($id)) {
    header('location:product_detail.php?error=Invalid ID');
    exit();
} else {
    header('Content-Type: application/octet-stream');
    readfile("products_brochures/" . $id. ".pdf");

}

?>