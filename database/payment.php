<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
	die("Connection Failed");
}
$sql="CREATE TABLE payments(
   payment_id INT PRIMARY KEY, 
   fullname VARCHAR(30) NOT NULL,
   room_id INT NOT NULL,
   FOREIGN key(room_id) REFERENCES room(room_id),
   payment_date date NOT NULL,
   price INT NOT NULL
 )";
if(mysqli_query($conn,$sql)){
echo "Table payment created successfully";
}
else{
	echo "Error creating table";
}
?>


