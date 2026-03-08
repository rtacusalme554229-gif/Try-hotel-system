<?php
session_start();
require 'database.php';

$id = $_GET['id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){

$guest = $_POST['guest'];
$room = $_POST['room'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$guests = $_POST['guests'];

$sql = "UPDATE bookings 
SET guest_name=:guest,
room_type=:room,
check_in=:checkin,
check_out=:checkout,
guests=:guests
WHERE id=:id";

$stmt = $conn->prepare($sql);

$stmt->execute([
'guest'=>$guest,
'room'=>$room,
'checkin'=>$checkin,
'checkout'=>$checkout,
'guests'=>$guests,
'id'=>$id
]);

header("Location: read.php");
exit();
}

$sql="SELECT * FROM bookings WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute(['id'=>$id]);
$row=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Booking</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Edit Booking</h2>

<form method="POST">

<label>Guest Name</label>
<input type="text" name="guest" value="<?php echo $row['guest_name']; ?>" required>

<label>Room Type</label>
<select name="room">
<option <?php if($row['room_type']=="Single") echo "selected"; ?>>Single</option>
<option <?php if($row['room_type']=="Double") echo "selected"; ?>>Double</option>
<option <?php if($row['room_type']=="Suite") echo "selected"; ?>>Suite</option>
</select>

<label>Check In</label>
<input type="date" name="checkin" value="<?php echo $row['check_in']; ?>">

<label>Check Out</label>
<input type="date" name="checkout" value="<?php echo $row['check_out']; ?>">

<label>Guests</label>
<input type="number" name="guests" value="<?php echo $row['guests']; ?>">

<button type="submit">Update Booking</button>

</form>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>