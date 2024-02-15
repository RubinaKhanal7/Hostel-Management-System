<?php
//SET FOREIGN_KEY_CHECKS=0;
$id=$_GET['id'];
$conn=mysqli_connect('localhost','root','','project');
$sql="DELETE from student where student_id=$id";
mysqli_query($conn,$sql);
header('location:managestudent.php');
//SET FOREIGN_KEY_CHECKS=1;
?>