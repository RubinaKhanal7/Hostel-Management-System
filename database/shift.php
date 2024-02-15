
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
    die("Connection Failed");
}
                                                                                 
$sql="CREATE TABLE shift(
   shift_id INT(6) PRIMARY KEY,
   student_id INT(6) NOT NULL,
   FOREIGN key(student_id) REFERENCES student(student_id),
   fullname VARCHAR(30) NOT NULL, 
   reason CHAR(60) NOT NULL,
   status VARCHAR(30) 
 )";
if(mysqli_query($conn,$sql)){
echo "Table shift created successfully";
}
else{
    echo "Error creating table";
}

?>