<?php
session_start();
// Connect to db
$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
//End to con
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Check for user name and password
        $results = $pdo->query('SELECT * FROM users');
        foreach ($results as $index => $user) {
            if (($user['username'] === $_POST['username']) &&
                ($user['password'] === $_POST['password'])
            ) {

                $_SESSION["idusers"] = $user['idusers'];
                $_SESSION["username"] = $user['username'];
                $_SESSION["login"] = true;
                $_SESSION["usertype"] = $user['usertype'];
                // Redirect user
                header("Location: account.php");
                die();
            } else {
                echo 'Wrong username or password';
            }
        }
    } else {
        echo 'Please enter email and password';
    }
}
?>

<?php include("head.php"); ?>
<div style="margin: 50px 400px;">
    <form action="login.php" method="POST">
        <div class="loginForm">
            <label>Username</label>
            <input type="text" name="username">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <p style="text-align:center; margin-left:-55px">
            <input type="submit" name="submit" value="Login">
        </p>
    </form>
</div>

<?php require "footer.php"  ?>