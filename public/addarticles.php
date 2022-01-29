<?php
$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');

 require("adminhead.php");  

if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('	INSERT INTO articles (articleTitle, articleDescription, articleContent, idarticles, articleDate, idcategory VALUES (:articleTitle, :articleDescription, :articleContent, :idarticles, :articleDate, :idcategory');


	$values = [
		'articleTitle' => $_POST['articleTitle'],
		'articleDescription' => $_POST['articleDescription'],
		'articleContent' => $_POST['articleContent'],
		// 'idarticles' => $_POST['idarticles'],
		'articleDate' => $_POST['articleDate'],
		'idcategory' => $_POST['idcategory']
	];

	$stmt->execute($values);
	echo 'Article ' . $_POST['articleTitle'] . ' edited';
}
//If the form has not been submitted, check that a game has been selected to be edited e.g. editgame.php?id=3
else {
?>


<form action="" method="POST">
<label>Article Name</label>
    <input type="text" name="articleTitle">

    <label>Author</label>
    <input type="text" name="articlesAuthor">

    <label>Description </label>
    <input type="text" name="articleDescription">

    <label> Long Content </label>
    <textarea rows="2" cols="25" name="articleContent" placeholder="This is the default text"></textarea>
	<label>Select Category:</label>
	<select name="idcategory">
	<?php

		$stmt = $pdo->prepare('SELECT * FROM categories');
		$stmt->execute();

		foreach ($stmt as $row) {
			echo '<option value="' . $row['id'] . '">' . $row['categoryName'] . '</option>';
		}

	?>
	</select>

	

	<input type="submit" name="submit" value="Add" />
</form>
<?php
}
?>

<?php include("footer.php");  ?>