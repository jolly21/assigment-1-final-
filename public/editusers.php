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
//End conn 

if (isset($_POST['submit'])) {

    //collect form data
    extract($_POST);

    //very basic validation
    if ($username == '') {
        $error[] = 'Please enter the username.';
    }

    if (strlen($password) > 0) {

        if ($password == '') {
            $error[] = 'Please enter the password.';
        }

        if ($passwordConfirm == '') {
            $error[] = 'Please confirm the password.';
        }

        if ($password != $passwordConfirm) {
            $error[] = 'Passwords do not match.';
        }
    }


    if ($email == '') {
        $error[] = 'Please enter the email address.';
    }

    if (!isset($error)) {

        try {

            if (isset($password)) {



                //update into database
                $stmt = $pdo->prepare('UPDATE users SET username = :username, password = :password, email = :email WHERE idusers = :idusers');
                $stmt->execute(array(
                    ':username' => $username,
                    ':password' => $password,
                    ':email' => $email,
                    ':idusers' => $idusers
                ));
            } else {

                //update database
                $stmt = $pdo->prepare('UPDATE users SET username = :username, email = :email WHERE idusers = :idusers');
                $stmt->execute(array(
                    ':username' => $username,
                    ':email' => $email,
                    ':idusers' => $idusers
                ));
            }


            //redirect to users page
            header('Location: users.php?action=updated');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>

<?php include("head.php");?>
<title>Edit User- Techno Smarter Blog</title>


<div class="content">

    <h2>Edit User</h2>



    <?php
    //check for any errors
    if (isset($error)) {
        foreach ($error as $error) {
            echo $error . '<br>';
        }
    }

    try {

        $stmt = $pdo->prepare('SELECT idusers, username, email FROM users WHERE idusers = :idusers');
        $stmt->execute(array(':idusers' => $_GET['id']));
        $row = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>

    <form action="" method="post">
        <input type="hidden" name="idusers" value="<?php echo $row['idusers']; ?>">

        <p><label>Username</label><br>
            <input type="text" name="username" value="<?php echo $row['username']; ?>">
        </p>

        <p><label>Password (only to change)</label><br>
            <input type="password" name="password" value="">
        </p>

        <p><label>Confirm Password</label><br>
            <input type="password" name="passwordConfirm" value="">
        </p>

        <p><label>Email</label><br>
            <input type="text" name="email" value="<?php echo $row['email']; ?>">
        </p>

        <p><input type="submit" name="submit" value="Update"></p>

    </form>

</div>



<?php include("footer.php");  ?>