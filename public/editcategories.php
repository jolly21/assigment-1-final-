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


if (isset($_POST['submit'])) {

    $_POST = array_map('stripslashes', $_POST);


    extract($_POST);


    if ($idcategory == '') {
        $error[] = 'This is the wrong id, so you better try again.';
    }

    if ($CategoryName == '') {
        $error[] = 'Please enter the Category Title .';
    }
    if (!isset($error)) {

        try {



            //insert into database
            $stmt = $pdo->prepare('UPDATE categories SET CategoryName = :CategoryName, categoryPoint = :categoryPoint WHERE idcategory = :idcategory');
            $stmt->execute(array(
                ':CategoryName' => $CategoryName,
                ':categoryPoint' => $categoryPoint,
                ':idcategory' => $idcategory
            ));

            //redirect to categories  page
            // header('Location: categories.php?action=updated');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

include "head.php"
?>

<?php
//check for any errors
if (isset($error)) {
    foreach ($error as $error) {
        echo $error . '<br>';
    }
}

try {

    $stmt = $pdo->prepare('SELECT idcategory, CategoryName FROM categories WHERE idcategory = :idcategory');
    $stmt->execute(array('idcategory' => $_GET['id']));
    $row = $stmt->fetch();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<form action="" method="post">

    <p><label>Category Title</label><br>
        <input type='text' name='CategoryName' value=''>

    </p>
    <p><input type="submit" name="submit" value="Update"></p>

</form>


</div>

<?php
include("footer.php");  ?>