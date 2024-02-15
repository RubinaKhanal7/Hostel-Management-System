
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
    die("Connection Failed");
}
                                                                                 
$sql="CREATE TABLE servicebook(
   service_number INT(6) PRIMARY KEY,
   service_id INT(6) NOT NULL,
   FOREIGN key(service_id) REFERENCES service(service_id),
   student_id INT(6) NOT NULL,
   FOREIGN key(student_id) REFERENCES student(student_id),
   fullname VARCHAR(30) NOT NULL, 
   service_type VARCHAR(30) NOT NULL,
   price INT NOT NULL
 )";
if(mysqli_query($conn,$sql)){
echo "Table servicebook created successfully";
}
else{
    echo "Error creating table";
}

?>