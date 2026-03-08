<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Dashboard</title>
</head>

<body>

<div class="container">

<h2>Dashboard</h2>

<p>Welcome <?php echo $_SESSION['name']; ?></p>

<?php
if(isset($_COOKIE['last_login'])){
echo "<p>Last Login: ".$_COOKIE['last_login']."</p>";
}
?>

<div class="nav">

<a href="create.php">Create Booking</a>
<br><br>

<a href="read.php">View Bookings</a>
<br><br>

<a href="logout.php">Logout</a>

</div>

</div>

</body>
</html>