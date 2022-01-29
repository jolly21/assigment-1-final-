<?php
session_start();
// if($_SESSION["login"] !== true){
// 	header("Location: /login.php");
//     die();
// }
// if($_SESSION["usertype"] !== 'admin'){
//     header("Location: /login.php");
//     die();
// }
include("adminhead.php");


// Start conn
$server = 'mysql';
$username = 'student';
$password = 'student';

$schema = 'csy2028';
$pdo = new PDO(
    'mysql:dbname=' . $schema . ';host=' . $server,
    $username,
    $password,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
//End Conn


?>



<?php
include("sidebar.php");  ?>