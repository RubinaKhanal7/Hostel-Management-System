 <?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
	die("Connection Failed");
}

$sql1="CREATE TABLE roombook(
   booking_number INT PRIMARY KEY,
   start_date DATE NOT NULL,
   end_date DATE NOT NULL,
   student_id INT(6) NOT NULL,
   FOREIGN key(student_id) REFERENCES student(student_id),
   fullname VARCHAR(30) NOT NULL,
   room_id INT NOT NULL,
   FOREIGN key(room_id) REFERENCES room(room_id),
   floor_number INT NOT NULL,
   no_of_beds INT NOT NULL,
   select_bed INT NOT NULL,
   price INT NOT NULL 
 )";
if(mysqli_query($conn,$sql1)){
echo "Table room book  created successfully";
}
else{
	echo "Error creating table";
}

 ?>