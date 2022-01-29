<?php
session_start();
include "head.php";  ?>
<?php


if ($_SESSION["login"] !== true) {
	header("Location: /login.php");
	die();
}
// Connect to db
$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
//End to con
?>
<title>Category Page</title>

<div class="content">
	<h2>Add Category</h2>

	<?php
	if (isset($_POST['submit'])) {
		if (!empty($_POST['categoryName'])) {

			$stmt = $pdo->prepare('INSERT INTO categories (categoryName)
			VALUES (:categoryName)');
			$values = [
				'categoryName' => $_POST['categoryName'],
			];
			$stmt->execute($values);
		} else {
			echo 'Please enter put some value';
		}
	}
	?>

	<form action="" method="POST">
		<label>Add a category</label>
		<input type="text" name="categoryName">
		<input type="submit" name="submit" value="Submit">
	</form>




	<?php
	include("footer.php");  ?>
	<?php
	include("sidebar.php");  ?>