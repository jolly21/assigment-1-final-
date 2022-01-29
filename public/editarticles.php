<?php
session_start();
if ($_SESSION["login"] !== true) {
    header("Location: /login.php");
    die();
}

// Connect to db
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
//End to con

require("adminhead.php");


$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');

if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('UPDATE articles 
    SET articleTitle = :articleTitle,  articleDescription = :articleDescription, articleContent = :articleContent 
    WHERE idarticles = :idarticles');



    $values = [
        'articleTitle' => $_POST['articleTitle'],
        'Description' => $_POST['Description'],
        'articleContent' => $_POST['articleContent'],
        'category' => $_POST['category'],
        'idcategory' => $_POST['idcategory']
    ];

    $stmt->execute($values);
    echo 'Article ' . $_POST['articleTitle'] . ' edited';
}
//If the form has not been submitted, check that a game has been selected to be edited 
else if (isset($_GET['id'])) {

    $stmt = $pdo->prepare('SELECT idarticles, articleTitle, articleDescription, articleContent, articlesAuthor, idcategory FROM articles WHERE idarticles = :idarticles');


    $values = [
        'id' => $_GET['id']
    ];

    $stmt->execute(array(':idarticles' => $_GET['id']));

    $row = $stmt->fetch();
?>
    <form action="editarticle.php" method="POST">
        <input type='hidden' name='idarticles' value="<?php echo $row['idarticles']; ?>">

        <h2><label>Article Title</label><br>
            <input type='text' name='articleTitle' style="width:100%;height:40px" value="<?php echo $row['articleTitle']; ?>">
        </h2>

        <h2><label>Description </label><br>
            <textarea name='articleDescription' cols='120' rows='6'><?php echo $row['articleDescription']; ?></textarea>
        </h2>

        <h2><label>Long Content</label><br>
            <textarea name='articleContent' id='textarea1' class='mceEditor' cols='120' rows='20'><?php echo $row['articleContent']; ?></textarea>
        </h2>

        <label>Select category:</label>
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


include("sidebar.php");  ?>