<?php
session_start();
require 'database.php';

$sql="SELECT * FROM bookings WHERE user_id=:uid";

$stmt=$conn->prepare($sql);
$stmt->execute(['uid'=>$_SESSION['user_id']]);

$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Bookings</title>
</head>

<body>

<div class="container">

<h2>Bookings</h2>

<table>

<tr>
<th>ID</th>
<th>Guest</th>
<th>Room</th>
<th>Check In</th>
<th>Check Out</th>
<th>Action</th>
</tr>

<?php foreach($rows as $row){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['guest_name']; ?></td>
<td><?php echo $row['room_type']; ?></td>
<td><?php echo $row['check_in']; ?></td>
<td><?php echo $row['check_out']; ?></td>

<td>

<a class="action-btn edit" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="action-btn delete"
href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete booking?')">Delete</a>

</td>

</tr>

<?php } ?>

</table>

<div class="nav">
<a href="dashboard.php">Back</a>
</div>

</div>

</body>
</html>