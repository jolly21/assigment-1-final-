<?php include "head.php" ?>

<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	$stmt = $pdo->prepare('DELETE FROM category WHERE idcat = :idcat');
	$stmt->execute(['id' => $_POST['idcat']]);


	header('location: categories.php');
}


?>