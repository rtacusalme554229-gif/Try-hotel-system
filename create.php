<?php
session_start();
require 'database.php';

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}

$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$guest=$_POST['guest'];
$room=$_POST['room'];
$checkin=$_POST['checkin'];
$checkout=$_POST['checkout'];
$guests=$_POST['guests'];

if(empty($guest) || empty($room)){

$message="Fill all fields";

}else{

$sql="INSERT INTO bookings
(user_id,guest_name,room_type,check_in,check_out,guests)
VALUES(:uid,:guest,:room,:cin,:cout,:guests)";

$stmt=$conn->prepare($sql);

$stmt->execute([
'uid'=>$_SESSION['user_id'],
'guest'=>$guest,
'room'=>$room,
'cin'=>$checkin,
'cout'=>$checkout,
'guests'=>$guests
]);

$message="Booking Created";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Create Booking</title>
</head>

<body>

<div class="container">

<h2>Create Booking</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="guest" placeholder="Guest Name">

<select name="room">
<option>Single</option>
<option>Double</option>
<option>Suite</option>
</select>

<label>Check In</label>
<input type="date" name="checkin">

<label>Check Out</label>
<input type="date" name="checkout">

<input type="number" name="guests" placeholder="Number of Guests">

<button type="submit">Save Booking</button>

</form>

<div class="nav">
<a href="dashboard.php">Back</a>
</div>

</div>

</body>
</html>