<?php
$id=$_GET['id'];
$conn=mysqli_connect('localhost','root','','project');
$sql="DELETE from room where room_id=$id";
mysqli_query($conn,$sql);
header('location:manageroom.php');
?>