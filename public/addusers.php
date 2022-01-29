<?php
session_start();
// if ($_SESSION["login"] !== true) {
//     header("Location: /login.php");
//     die();
// }
// Connect to db

$pdo = new PDO('mysql:dbname=csy2028;host=mysql', 'student', 'student');
//End to con


include("adminhead.php");

//if form has been submitted process it
if (isset($_POST['submit'])) {

    if (!isset($error)) {

       

        try {

            //insert into database
            $stmt = $pdo->prepare('INSERT INTO users (username, password, email, usertype) VALUES (:username, :password, :email, :usertype)');
            $stmt->execute(array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'usertype' => $_POST['usertype']
            ));

            //redirect to user page 
            header('Location: users.php?action=added');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //collect form data
    extract($_POST);

    //very basic validation
    if ($username == '') {
        $error[] = 'Please enter the username.';
    }

    if ($password == '') {
        $error[] = 'Please enter the password.';
    }


    if ($email == '') {
        $error[] = 'Please enter the email address.';
    }

    if ($usertype == '') {
        $error[] = 'Please select usertype.';
    }

    
}

//check for any errors
if (isset($error)) {
    foreach ($error as $error) {
        echo '<p class="message">' . $error . '</p>';
    }
}
?>



<title>Northampton News</title>


<div class="content">


    <h2>Add User</h2>




    <form action="" method="post">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="">
        </div>
        <div class="input-group">
            <label>User type</label>
            <select name="usertype" id="usertype">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="submit"> + Create user</button>
        </div>
    </form>




</div>




<?php include("footer.php");  ?>