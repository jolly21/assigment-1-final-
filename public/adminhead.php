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
            ?>


            <li><a href='admin.php'>Dashboard</a></li>
            <li><a href='users.php'>Users</a></li>
            <li><a href="articles.php">Articles </a></li>
            <li><a href='logout.php'><font color="red">Logout</font></a></li>



        </ul>

    </nav>
    <img src="images/banners/randombanner.php" />




    <main>

