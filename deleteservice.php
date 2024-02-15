<?php

$id=$_GET['id'];
$conn=mysqli_connect('localhost','root','','project');
$sql="DELETE from service where service_id=$id";
mysqli_query($conn,$sql);
header('location:service.php');

?>