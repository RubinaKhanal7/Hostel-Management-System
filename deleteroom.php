<?php

$id=$_GET['id'];
$conn=mysqli_connect('localhost','root','','project');
$sql="DELETE from roombook where booking_number=$id";
mysqli_query($conn,$sql);
header('location:managebookroom.php');

?>

