<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
	die("Connection Failed");
}
$sql1="CREATE TABLE room(
   room_id INT PRIMARY KEY, 
   no_of_beds INT NOT NULL,
   floor_number INT NOT NULL,
   price INT NOT NULL,
   status  VARCHAR(30) NOT NULL
 )";
if(mysqli_query($conn,$sql1)){
echo "Table room  created successfully";
}
else{
	echo "Error creating table";
}
?>