<?php
ob_start();
include 'include/common.php';
$con = mysqli_connect("database-fixed", $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
libxml_disable_entity_loader(true);
$xmlfile = file_get_contents('php://input');
$dom = new DOMDocument();
$dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
$creds = simplexml_import_dom($dom);

$query = $con->prepare("SELECT * FROM users WHERE email=? AND password=?");

$email = $creds->email;
$password = md5($creds->password);
$query->bind_param("ss", $email, $password);
$query->execute();
$result = $query->get_result();

if (mysqli_num_rows($result) == 0) {
   echo 401;
   echo 'Incorrect email or password';
   echo "\n Oops! \n $email";
} else {
   $row = mysqli_fetch_array($result);
   $arr =  array($row['email'], $row['id'], $row['name']);
   echo 200;
   echo implode("&", $arr);
}