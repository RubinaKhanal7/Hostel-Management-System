<?php
$user = $_SESSION['staffname'];
$id=$_GET['id'];
$conn=mysqli_connect('localhost','root','','project');

$sql="SELECT * FROM detail where booking_number=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$select_bed=$row['select_bed'];
$room_id=$row['room_id'];

$sql1="SELECT * FROM room where room_id=$room_id";
$res=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($res);
$no_of_bed=$row1['no_of_beds'];




$sql3="UPDATE room SET no_of_beds= $no_of_bed + $select_bed where room_id=$room_id";
mysqli_query($conn,$sql3);

$sql4="UPDATE shift SET status='Approved' where shift_id=$id";
mysqli_query($conn,$sql4);


header('location:manageroom.php');
?>