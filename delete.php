<?php
session_start();
require 'database.php';

$id=$_GET['id'];

$sql="DELETE FROM bookings WHERE id=:id";

$stmt=$conn->prepare($sql);
$stmt->execute(['id'=>$id]);

header("Location: read.php");
?>