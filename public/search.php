
<?php include("head.php");  ?>
<?php
// If the form is submitted, search the database
if (isset($_POST['submit'])) {

	if ($_POST['field'] == 'articleTitle') {
		$stmt = $pdo->prepare('SELECT * FROM articles 
							   WHERE ' . $_POST['field'] . ' = :search');


		$values = [
			'search' => $_POST['search']
		];

		$stmt->execute($values);

	}
}
//Otherwise, list all the records
else {
	$stmt = $pdo->prepare('SELECT * FROM articles');
	$stmt->execute();
}
?>

	<form action="search.php" method="POST">

		<label>Search</label>
		<input type="text" name="search" />

		<label>Field</label>
		<select name="field">
			<option value="articleTitle"> Article Title</option>
			<option value="articlesAuthor">Article Author</option>
			<option value="articleContent"> Article Content</option>
		</select>

		<input type="submit" name="submit" value="Search" />

	</form>

	<?php


echo '<ul>';
foreach ($stmt as $row) {
	echo '<li>';
	echo $row['articleTitle'] . ' by ' . $row['articlesAuthor'] . ' ' . $row['articleContent'];
	echo '</li>';
}
echo '</ul>';

?>





<br>
<br>

<?php include("footer.php");  ?>