<?php
//Only display games if a platform has been selected e.g. viewgames.php?platformId=1

if (isset($_GET['idcategory'])) {

	$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
	$categoryStmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');
	$articlesStmt = $pdo->prepare('SELECT * FROM articles WHERE idcategory = :id');

	$values = [
		'id' => $_GET['idcategory']
	];

	$categoryStmt->execute($values);
	$articlesStmt->execute($values);


	$category = $categoryStmt->fetch();

	echo '<h1>' . $category['name'] . ' articles</h1>';

	echo '<ul>';
	foreach ($articlesStmt as $article) {
		echo '<li><a href="editarticles.php?id=' . $article['id'] . '">' . $article['name'] . '</a></li>';
	}
	echo '</ul>';
}
?>

<?php require "footer.php"  ?>
<?php require "sidebar.php"  ?>