<!DOCTYPE html>

<html>

<head>

	<head>
		<link rel="stylesheet" href="styles.css" />
		<title>Northampton News - Home</title>
	</head>

<body>
	<header>
		<section>
			<h1>Northampton News</h1>
		</section>

	</header>

	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="search.php">Search</a></li>
			<?php
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
			// Fetch cat from db



			$li = '';
			$results = $pdo->query('SELECT * FROM categories');
			foreach ($results as $index => $category) {
				$li .= '
						<li><a href="categories.php?cat_id=' . $category['idcategory'] . '&categoryName=' . $category['categoryName'] . '">' . $category['categoryName'] . '</a></li>
					';
			}
			echo $li;



			$tag = '';
			if (isset($_SESSION['name'])) {
				$tag = '<a href="account.php">Welcome ' . $_SESSION['name'] . '</a>';
			}
			if (!isset($_SESSION['name'])) {
				$tag = '
				<a href="/login.php" class="loginbtn">Log in</a>			
			';
			}

			echo $tag;


			?>


		</ul>

	</nav>
	<img src="images/banners/randombanner.php" />




	<main>