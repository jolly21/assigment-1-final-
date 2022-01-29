<?php
include("head.php");

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
$stmt = $pdo->prepare('SELECT idarticles,articleDescription,articleTitle, articleContent, articleDate, articlesAuthor FROM articles WHERE idarticles = :idarticles');
$stmt->execute(array(':idarticles' => $_GET['id']));
$row = $stmt->fetch();

$stmt = $pdo->prepare('SELECT idarticles,articleDescription,articleTitle, articleContent, articleDate, articlesAuthor FROM articles WHERE idarticles = :idarticles');
$stmt->execute(array(':idarticles' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if ($row['idarticles'] == '') {
  header('Location: ./');
  exit;
}

?>



<title><?php echo $row['articleTitle']; ?>-Northampton News</title>
<meta name="description" content="<?php echo $row['articleDescription']; ?>">
<meta name="keywords" content="Article Keywords">


<div class="container">
  <div class="content">


    <?php
    echo '<div>';
    echo '<h1>' . $row['articleTitle'] . '</h1>';

    echo '<p>Posted on ' . date('jS M Y H:i:s', strtotime($row['articleDate']));


    $stmt2 = $pdo->prepare('SELECT categoryName, categoryPoint FROM categories, cat_links WHERE categories.idcategory = cat_links.idcategory AND cat_links.idarticles = :idarticles');
    // $stmt2->execute(array('idarticles' => $row['idarticles']));

    $catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $links = array();
    foreach ($catRow as $cat) {
      $links[] = "<a href='category/" . $cat['categoryPoint'] . "'>" . $cat['categoryName'] . "</a>";
    }
    echo implode(", ", $links);

    echo '</p>';
    echo '<hr>';

    echo '<p>' . $row['articleContent'] . '</p>';
    echo '<p>Author:  ' . $row['articlesAuthor'] . '</p>';

    echo '</div>';
    ?>

  </div>
</div>