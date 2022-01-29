<?php
session_start();
// // Connect to db
$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
//End to con

?>
<?php include "head.php" ?>

<title>Home of The Latest News</title>

<div class="container">
    <div class="content">

        <?php
        try {
            $stmt = $pdo->query('SELECT idarticles, articleTitle, articleDescription, articleDate FROM articles ORDER BY idarticles DESC');

            while ($row = $stmt->fetch()) {

                echo '<div>';
                echo '<h1><a href="show.php?id=' . $row['idarticles'] . '">' . $row['articleTitle'] . '</a></h1>';
                echo '<hr>';
                //Display the date 
                echo '<p>Posted on ' . date('jS M Y', strtotime($row['articleDate'])) . '</p>';


                echo '<p>' . $row['articleDescription'] . '</p>';

                echo '<p><button class="readbtn"><a href="show.php?id=' . $row['idarticles'] . '">Read More</a></button></p>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>


    </div>

</div>


<?php include "footer.php" ?>