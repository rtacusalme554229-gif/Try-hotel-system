<?php
require 'database.php';

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if(empty($name) || empty($email) || empty($password)){

$message = "All fields are required";

}else{

$hashed = password_hash($password,PASSWORD_DEFAULT);

$sql = "INSERT INTO users(name,email,password)
VALUES(:name,:email,:password)";

$stmt = $conn->prepare($sql);

$stmt->execute([
'name'=>$name,
'email'=>$email,
'password'=>$hashed
]);

$message = "Registration Successful";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Register</title>
</head>

<body>

<div class="container">

<h2>Register</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="name" placeholder="Name">

<input type="email" name="email" placeholder="Email">

<input type="password" name="password" placeholder="Password">

<button type="submit">Register</button>

</form>

<div class="nav">
<a href="login.php">Go to Login</a>
</div>

</div>

</body>
</html>