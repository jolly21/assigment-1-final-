<?php
session_start();

if ($_SESSION["login"] !== true) {
    header("Location: /login.php");
    die();
}

$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
//End to con

if ($_SESSION["username"] == 'admin'){
    header('Location: /admin.php');
  }



?>
<?php
require "head.php";
?> 

<title>Account</title>

 <p>Welcome to Northampton News.... </p>

 <ul>
	<li><a href="addplatform.php">Add Platform</a></li>
	<li><a href="addgame.php">Add Game</a></li>
</ul>

<h2>Select platform:</h2>
<ul>
<?php
    $pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
	$stmt = $pdo->prepare('SELECT * FROM categories');

	$stmt->execute();

	foreach ($stmt as $row) {
		echo '<li><a href="viewgames.php?idcategory=' . $row['id'] . '">' . $row['name'] . '</a></li>';
	}
?>
</ul>





 <a href="logout.php" class="logoutBtn">Logout</a>


