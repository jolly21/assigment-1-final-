<?php
//Only display games if a platform has been selected e.g. viewgames.php?platformId=1

if (isset($_GET['idcategory']))  {

    $pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
	$categoryStmt = $pdo->prepare('SELECT * FROM category WHERE idcategory = :id');
	$articleStmt = $pdo->prepare('SELECT * FROM articles WHERE idarticles = :id');

	$values = [
		'id' => $_GET['idcategory']
	];

	$categoryStmt->execute($values);
	$articleStmt->execute($values);


	$category = $categoryStmt->fetch();

	echo '<h1>' . $category['name'] . ' games</h1>';

	echo '<ul>';
	foreach ($articleStmt as $article) {
		echo '<li><a href="editarticle.php?id=' . $game['id'] . '">' . $game['name'] . '</a></li>';
	}
	echo '</ul>';
}
?>
