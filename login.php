<?php
session_start();
require 'database.php';

$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$email=$_POST['email'];
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE email=:email";

$stmt=$conn->prepare($sql);
$stmt->execute(['email'=>$email]);

$user=$stmt->fetch(PDO::FETCH_ASSOC);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['name']=$user['name'];

setcookie("last_login",date("Y-m-d H:i:s"),time()+3600);

header("Location: dashboard.php");
exit();

}else{

$message="Invalid Login";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Login</title>
</head>

<body>

<div class="container">

<h2>Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input type="email" name="email" placeholder="Email">

<input type="password" name="password" placeholder="Password">

<button type="submit">Login</button>

</form>

<div class="nav">
<a href="register.php">Create Account</a>
</div>

</div>

</body>
</html>