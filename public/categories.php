<?php
session_start();
if($_SESSION["login"] !== true){
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


if (isset($_GET['delcat'])) {

    $stmt = $pdo->prepare('DELETE FROM categories WHERE idcategory = :idcategory');
    $stmt->execute(array(':idcategory' => $_GET['delcat']));

    header('Location: categories.php?action=deleted');
    exit;
}
?>

<?php require("adminhead.php");  ?>

<main>
    <title>Categories</title>
    <script language="JavaScript" type="text/javascript">
        function delcat(id, title) {
            if (confirm("Are you sure you want to delete '" + title + "'")) {
                window.location.href = 'categories.php?delcat=' + id;
            }
        }
    </script>


    <div class="content">
        <?php

        if (isset($_GET['action'])) {
            echo '<h3>Category ' . $_GET['action'] . '.</h3>';
        }
        ?>

        <table>
            <tr>
                <th>Title</th>
                <th>Operation</th>
            </tr>
            <?php
            try {

                $stmt = $pdo->query('SELECT idcategory, categoryName, categoryPoint FROM categories ORDER BY categoryName DESC');
                while ($row = $stmt->fetch()) {

                    echo '<tr>';
                    echo '<td>' . $row['categoryName'] . '</td>';
            ?>

                    <td>
                        <button class="editbtn"> <a href="editcategories.php?id=<?php echo $row['idcategory']; ?>">Edit</a> </button>
                        <button class="delbtn"> <a href="javascript:delcat('<?php echo $row['idcategory']; ?>','<?php echo $row['categoryPoint']; ?>')">Delete</a></button>
                    </td>

            <?php
                    echo '</tr>';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </table>

        <p><button class="editbtn"><a href='addcategories.php'>Add New Category</a></button></p>
    </div>
</main>
<?php
include("sidebar.php");  ?>