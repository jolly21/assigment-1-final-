<?php 
session_start();
require "head.php" ?>

<?php

// Connect to db
$server = 'mysql';
$username = 'student';
$password = 'student';

$schema = 'csy2028';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//End to con
 ?>

<form action="register.php" method="POST">
    <div class="Register">
	
	<label>username</label>
    <input type="text" name="username">
    <label>Email</label>
    <input type="text" name="email">
    <label>Password</label>
    <input type="password" name="password">
	</div>
	<p style="text-align:center; margin-left:-70px">
    <input type="submit" name="submit"  value="Register">
</form>
<?php



if (isset($_POST['submit'])) {
	if(!empty($_POST['email']) && !empty($_POST['password'])  ){
		
		
			$stmt = $pdo->prepare('INSERT INTO users (username,email,password)
			VALUES (:username,:email,:password)');
			$values = [	
			'username' => $_POST['username'],
			'email' => $_POST['email'],
			'password' => $_POST['password']
			];			
			$stmt->execute($values);
	}else{
		echo 'Please enter username and password';
	}
	
}



?>