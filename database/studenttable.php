<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
	die("Connection Failed");
}

$sql1="CREATE TABLE student(
   student_id INT(6) PRIMARY KEY, 
   fullname VARCHAR(30) NOT NULL,
   phone CHAR (15) NOT NULL,
   date_of_birth date NOT NULL,
   gender VARCHAR(10) NOT NULL,
   class INT NOT NULL,
   address  VARCHAR(30) NOT NULL,
   guardian_name  VARCHAR(30) NOT NULL,
   guardian_phone CHAR (15) NOT NULL,
   username VARCHAR(30) NOT NULL,
   password VARCHAR(60) NOT NULL,
   confirm_password  VARCHAR(60) NOT NULL
 )";
if(mysqli_query($conn,$sql1)){
echo "Table student  created successfully";
}
else{
	echo "Error creating table";
}